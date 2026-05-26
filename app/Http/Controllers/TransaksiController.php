<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\AreaParkir;
use App\Models\Tarif;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // 1. LOGIKA KENDARAAN MASUK
    public $parkirMasuk = [
        
        'function' => function (Request $request) {
            $request->validate([
                'plat_nomor' => 'required',
                'jenis_kendaraan' => 'required', // mobil / motor
                'id_area' => 'required',
            ]);

            // Cek apakah area parkir masih ada slot kosong
            $area = AreaParkir::find($request->id_area);
            if ($area->terisi >= $area->kapasitas) {
                return response()->json(['message' => 'Area parkir sudah penuh!'], 400);
            }

            // Simpan atau cari data kendaraan
            $kendaraan = Kendaraan::firstOrCreate(
                ['plat_nomor' => $request->plat_nomor],
                ['jenis_kendaraan' => $request->jenis_kendaraan, 'id_user' => auth()->id() ?? 1]
            );

            // Cari ID Tarif berdasarkan jenis kendaraan
            $tarif = Tarif::where('jenis_kendaraan', $request->jenis_kendaraan)->first();

            // Buat transaksi parkir baru
            $transaksi = Transaksi::create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'waktu_masuk' => Carbon::now(),
                'id_tarif' => $tarif ? $tarif->id_tarif : 1,
                'status' => 'masuk',
                'id_area' => $request->id_area,
                'id_user' => auth()->id() ?? 1 // Default ke ID 1 jika belum login
            ]);

            // Tambah jumlah kendaraan yang terisi di area tersebut
            $area->increment('terisi');

            return response()->json(['message' => 'Kendaraan berhasil masuk!', 'data' => $transaksi]);
        }
    ];

    // 2. LOGIKA KENDARAAN KELUAR & HITUNG BIAYA
    public $parkirKeluar = [
        'function' => function ($id_parkir) {
            $transaksi = Transaksi::find($id_parkir);

            if (!$transaksi || $transaksi->status == 'keluar') {
                return response()->json(['message' => 'Transaksi tidak ditemukan atau sudah keluar'], 400);
            }

            $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
            $waktuKeluar = Carbon::now();
            
            // Hitung durasi jam (minimal 1 jam)
            $durasiJam = $waktuMasuk->diffInHours($waktuKeluar);
            if ($durasiJam == 0) { $durasiJam = 1; }

            // Ambil tarif per jam
            $tarifPerJam = $transaksi->tarif->tarif_per_jam ?? 2000; // default 2000 jika tarif kosong
            $biayaTotal = $durasiJam * $tarifPerJam;

            // Update data transaksi
            $transaksi->update([
                'waktu_keluar' => $waktuKeluar,
                'durasi_jam' => $durasiJam,
                'biaya_total' => $biayaTotal,
                'status' => 'keluar'
            ]);

            // Kurangi jumlah kendaraan terisi di area parkir
            $area = AreaParkir::find($transaksi->id_area);
            if ($area && $area->terisi > 0) {
                $area->decrement('terisi');
            }

            \App\Models\LogAktivitas::create([
                'id_user'   => auth()->id(), 
                'aktivitas' => 'Memproses kendaraan keluar dengan ID Transaksi: ' . $id_parkir,
                'waktu'     => now(),
            ]);

            return response()->json(['message' => 'Kendaraan berhasil keluar!', 'total_biaya' => $biayaTotal]);
        }
    ];
}