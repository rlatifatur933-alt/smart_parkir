@extends('layouts.main')

@section('content')
    <!-- Konten Struk Kamu -->
    <div class="struk-container">
        <div class="center header">
            SMART PARKIR<br>
            Surabaya, Jawa Timur
        </div>
        <div class="line"></div>
        <div>
            <p>Plat: {{ $transaksi->kendaraan->plat_nomor }}</p>
            <p>Jenis: {{ $transaksi->kendaraan->jenis_kendaraan }}</p>
            <p>Masuk: {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</p>
        </div>
        <div class="line"></div>
        <div class="center">
            Terima Kasih<br>
            Simpan struk ini!
        </div>
        
        <!-- Tombol cetak manual kalau perlu -->
        <button class="btn btn-primary mt-3" onclick="window.print()">Cetak Sekarang</button>
    </div>

    <!-- CSS untuk menyembunyikan elemen dashboard saat cetak -->
    <style>
        @media print {
            /* Sembunyikan sidebar, navbar, footer, dan tombol cetak */
            .main-sidebar, .main-header, .main-footer, .btn {
                display: none !important;
            }
            /* Pastikan struk tampil penuh */
            .struk-container {
                width: 100%;
                font-family: 'Courier New', monospace;
            }
        }
    </style>
@endsection