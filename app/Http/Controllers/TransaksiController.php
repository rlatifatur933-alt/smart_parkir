<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\LogAktivitas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{

    public function index()
    {
        $areas = \App\Models\AreaParkir::all();
        $transaksiAktif = \App\Models\Transaksi::with(['kendaraan', 'area', 'tarif'])
            ->where('status', 'masuk')
            ->orderBy('waktu_masuk', 'desc')
            ->get();

        return view('parkir.index', compact('areas', 'transaksiAktif'));
    }
    public function parkirMasuk(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'id_area' => 'required|exists:tb_area_parkir,id_area',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'nullable|string|max:100'
        ]);

        DB::beginTransaction();
        try {
            $area = AreaParkir::findOrFail($request->id_area);
            if ($area->terisi >= $area->kapasitas) {
                return response()->json(['success' => false, 'message' => 'Area parkir penuh!'], 400);
            }

            $kendaraan = Kendaraan::firstOrCreate(
                ['plat_nomor' => strtoupper($request->plat_nomor)],
                [
                    'jenis_kendaraan' => $request->jenis_kendaraan,
                    'warna' => $request->warna ?? 'Tidak diketahui',
                    'pemilik' => $request->pemilik ?? 'Umum',
                    'id_user' => auth()->id() ?? 1
                ]
            );

            $tarif = Tarif::where('jenis_kendaraan', $request->jenis_kendaraan)->first();
            if (!$tarif) {
                return response()->json(['success' => false, 'message' => 'Tarif belum diatur!'], 400);
            }

            $transaksi = Transaksi::create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'waktu_masuk' => Carbon::now(),
                'id_tarif' => $tarif->id_tarif,
                'status' => 'masuk',
                'id_area' => $request->id_area,
                'id_user' => auth()->id() ?? 1,
                'biaya_total' => 0
            ]);

            $area->increment('terisi');

            LogAktivitas::create([
                'id_user' => auth()->id() ?? 1,
                'aktivitas' => 'Kendaraan masuk: ' . $kendaraan->plat_nomor,
                'waktu_aktivitas' => Carbon::now()
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Berhasil masuk!', 'data' => $transaksi], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function parkirKeluar($id_parkir)
    {
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::with(['kendaraan', 'tarif', 'area'])->findOrFail($id_parkir);

            if ($transaksi->status === 'keluar') {
                return response()->json(['success' => false, 'message' => 'Kendaraan sudah keluar!'], 400);
            }

            $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
            $waktuKeluar = Carbon::now();
            
            // Hitung durasi (minimal 1 jam)
            $durasiJam = ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60);
            $durasiJam = max(1, $durasiJam); 

            $biayaTotal = $durasiJam * ($transaksi->tarif->tarif_per_jam ?? 0);

            $transaksi->update([
                'waktu_keluar' => $waktuKeluar,
                'durasi_jam' => $durasiJam,
                'biaya_total' => $biayaTotal,
                'status' => 'keluar'
            ]);

            if ($transaksi->area && $transaksi->area->terisi > 0) {
                $transaksi->area->decrement('terisi');
            }

            LogAktivitas::create([
                'id_user' => auth()->id() ?? 1,
                'aktivitas' => 'Kendaraan keluar: ' . $transaksi->kendaraan->plat_nomor . ' (Biaya: Rp ' . number_format($biayaTotal, 0, ',', '.') . ')',
                'waktu_aktivitas' => $waktuKeluar
            ]);

            DB::commit();
            return response()->json([
                'success' => true, 
                'message' => 'Berhasil keluar!', 
                'data' => [
                    'plat_nomor' => $transaksi->kendaraan->plat_nomor,
                    'durasi_jam' => $durasiJam,
                    'biaya_total' => $biayaTotal,
                    'formatted_biaya' => 'Rp ' . number_format($biayaTotal, 0, ',', '.')
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}