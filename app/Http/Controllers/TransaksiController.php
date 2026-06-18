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
        $areas = AreaParkir::all();
        $transaksiAktif = Transaksi::with(['kendaraan', 'area', 'tarif'])
            ->where('status', 'masuk')
            ->orderBy('waktu_masuk', 'desc')
            ->get();

        return view('parkir.index', compact('areas', 'transaksiAktif'));
    }
    public function parkirMasuk(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya',
            'id_area' => 'required|exists:tb_area_parkir,id_area',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'nullable|string|max:100',
        ]);

        // ✅ CEK PLAT NOMOR SUDAH TERSEDIA (SEDANG PARKIR)
        $platSudahAda = Kendaraan::where('plat_nomor', strtoupper($validated['plat_nomor']))
            ->whereHas('transaksiAktif', function($query) {
                $query->where('status', 'masuk');
            })
            ->exists();

        if ($platSudahAda) {
            return response()->json([
                'success' => false,
                'message' => 'Plat nomor sudah tersedia (kendaraan sedang parkir)!'
            ], 422);
        }

        // Cek kapasitas area
        $area = AreaParkir::find($validated['id_area']);
        if ($area->terisi >= $area->kapasitas) {
            return response()->json([
                'success' => false,
                'message' => 'Area parkir sudah penuh!'
            ], 422);
        }

        // Cari atau buat kendaraan
        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomor' => strtoupper($validated['plat_nomor'])],
            [
                'jenis_kendaraan' => $validated['jenis_kendaraan'],
                'warna' => $validated['warna'] ?? 'Tidak diketahui',
                'pemilik' => $validated['pemilik'] ?? 'Umum',
                'id_user' => auth()->id(),
            ]
        );

        // Ambil tarif
        $tarif = Tarif::where('jenis_kendaraan', $validated['jenis_kendaraan'])->first();
        if (!$tarif) {
            return response()->json([
                'success' => false,
                'message' => 'Tarif untuk jenis kendaraan ini belum diatur!'
            ], 422);
        }

        // Buat transaksi
        $transaksi = Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'id_area' => $validated['id_area'],
            'id_tarif' => $tarif->id_tarif,
            'id_user' => auth()->id(),
            'waktu_masuk' => now(),
            'status' => 'masuk',
            'biaya_total' => 0,
        ]);

        // Update area terisi
        $area->increment('terisi');

        // Catat log aktivitas
        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Kendaraan masuk: ' . $kendaraan->plat_nomor,
            'waktu_aktivitas' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil masuk!',
            'data' => $transaksi
        ]);
    }

    public function parkirKeluar($id_parkir)
    {
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::with(['kendaraan', 'tarif', 'area', 'user'])->findOrFail($id_parkir);

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
                    'id_parkir' => $transaksi->id_parkir, // ✅ TAMBAHKAN INI
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