@extends('layouts.main')

@section('title', 'Struk Parkir')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif;">
    
    <!-- Tombol Aksi -->
    <div style="max-width: 400px; margin: 0 auto 20px auto; display: flex; gap: 10px;">
        <a href="{{ route('petugas.dashboard') }}" 
           style="flex: 1; background: #95a5a6; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; font-size: 10pt;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" 
                style="flex: 1; background: #0284c7; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 10pt;">
            <i class="bi bi-printer"></i> Cetak Struk
        </button>
    </div>
    
    <!-- Struk Container -->
    <div class="struk-container" style="max-width: 400px; margin: 0 auto; background: white; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px; font-family: 'Courier New', monospace;">
        
        <!-- Header -->
        <div style="text-align: center; border-bottom: 2px dashed #333; padding-bottom: 15px; margin-bottom: 15px;">
            <h2 style="margin: 0; font-size: 18pt; color: #1e293b;">SMART PARKIR</h2>
            <p style="margin: 5px 0 0 0; font-size: 9pt; color: #64748b;">Surabaya, Jawa Timur</p>
            <p style="margin: 5px 0 0 0; font-size: 9pt; color: #64748b;">{{ now()->format('d/m/Y H:i') }}</p>
        </div>
        
        <!-- Info Transaksi -->
        <div style="margin-bottom: 15px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">No. Transaksi</span>
                <span style="font-weight: bold;">#{{ $transaksi->id_parkir }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Plat Nomor</span>
                <span style="font-weight: bold;">{{ $transaksi->kendaraan->plat_nomor }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Jenis Kendaraan</span>
                <span style="font-weight: bold; text-transform: capitalize;">{{ $transaksi->kendaraan->jenis_kendaraan }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Area Parkir</span>
                <span style="font-weight: bold;">{{ $transaksi->area->nama_area ?? '-' }}</span>
            </div>
        </div>
        
        <!-- Garis Pemisah -->
        <div style="border-top: 2px dashed #333; margin: 15px 0;"></div>
        
        <!-- Waktu -->
        <div style="margin-bottom: 15px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Waktu Masuk</span>
                <span style="font-weight: bold;">{{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Waktu Keluar</span>
                <span style="font-weight: bold;">{{ \Carbon\Carbon::parse($transaksi->waktu_keluar)->format('d/m/Y H:i') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Durasi</span>
                <span style="font-weight: bold;">{{ $transaksi->durasi_jam }} Jam</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 10pt;">
                <span style="color: #64748b;">Tarif/Jam</span>
                <span style="font-weight: bold;">Rp {{ number_format($transaksi->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <!-- Garis Pemisah -->
        <div style="border-top: 2px dashed #333; margin: 15px 0;"></div>
        
        <!-- Total -->
        <div style="display: flex; justify-content: space-between; font-size: 14pt; font-weight: bold; margin-bottom: 15px; padding: 10px; background: #f0f9ff; border-radius: 8px;">
            <span>TOTAL BIAYA</span>
            <span style="color: #059669;">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</span>
        </div>
        
        <!-- Footer -->
        <div style="text-align: center; border-top: 2px dashed #333; padding-top: 15px; font-size: 9pt; color: #64748b;">
            <p style="margin: 0;">Terima kasih telah menggunakan layanan kami</p>
            <p style="margin: 5px 0 0 0;">Petugas: {{ $transaksi->user->nama_lengkap ?? '-' }}</p>
            <p style="margin: 5px 0 0 0; font-weight: bold;">Simpan struk ini!</p>
        </div>
    </div>
</div>

<style>
    @media print {
        /* Sembunyikan semua elemen layout */
        .main-sidebar, .main-header, .main-footer, .top-navbar, .content-wrapper, nav, header, footer {
            display: none !important;
        }
        
        body {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        /* Tampilkan hanya struk */
        .struk-container {
            box-shadow: none !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 10px !important;
        }
        
        /* Sembunyikan tombol */
        button, a[href*="dashboard"] {
            display: none !important;
        }
        
        /* Reset padding container */
        div[style*="padding: 20px"] {
            padding: 0 !important;
        }
    }
</style>
@endsection@extends('layouts.main')

@section('title', 'Struk Parkir - ' . $transaksi->kendaraan->plat_nomor)

@section('styles')
<style>
    .struk-wrapper {
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .struk-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-family: 'Courier New', monospace;
    }
    
    .struk-header {
        text-align: center;
        border-bottom: 2px dashed #333;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    
    .struk-header h2 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #1e293b;
    }
    
    .struk-header p {
        font-size: 11px;
        color: #64748b;
        margin: 3px 0;
    }
    
    .struk-content {
        margin-bottom: 15px;
    }
    
    .struk-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 11px;
    }
    
    .struk-row .label {
        color: #64748b;
    }
    
    .struk-row .value {
        font-weight: bold;
        text-align: right;
        color: #1e293b;
    }
    
    .struk-divider {
        border-top: 2px dashed #333;
        margin: 15px 0;
    }
    
    .struk-total {
        text-align: center;
        margin: 15px 0;
    }
    
    .struk-total .label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 5px;
    }
    
    .struk-total .amount {
        font-size: 20px;
        font-weight: bold;
        color: #059669;
    }
    
    .struk-footer {
        text-align: center;
        border-top: 2px dashed #333;
        padding-top: 15px;
        font-size: 10px;
        color: #64748b;
    }
    
    .struk-buttons {
        text-align: center;
        margin-top: 20px;
        padding: 20px;
    }
    
    .btn-struk {
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-primary {
        background: #0284c7;
        color: white;
    }
    
    .btn-secondary {
        background: #95a5a6;
        color: white;
    }
    
    .btn-struk:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    
    @media print {
        /* Sembunyikan semua elemen layout */
        .main-sidebar,
        .main-header,
        .main-footer,
        .top-navbar,
        .content-wrapper > .container-fluid,
        nav,
        header,
        footer,
        .struk-buttons {
            display: none !important;
        }
        
        body {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .struk-wrapper {
            padding: 0 !important;
            max-width: 100% !important;
        }
        
        .struk-container {
            box-shadow: none !important;
            padding: 15px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="struk-wrapper">
    <!-- Tombol Aksi -->
    <div class="struk-buttons">
        <a href="{{ route('petugas.dashboard') }}" class="btn-struk btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn-struk btn-primary">
            <i class="bi bi-printer"></i> Cetak Struk
        </button>
    </div>
    
    <!-- Struk Container -->
    <div class="struk-container">
        <div class="struk-header">
            <h2>🅿️ SMART PARKIR</h2>
            <p>STRUK PEMBAYARAN PARKIR</p>
            <p>{{ now()->format('d M Y, H:i') }}</p>
        </div>
        
        <div class="struk-content">
            <div class="struk-row">
                <span class="label">Plat Nomor</span>
                <span class="value">: {{ $transaksi->kendaraan->plat_nomor }}</span>
            </div>
            <div class="struk-row">
                <span class="label">Jenis Kendaraan</span>
                <span class="value">: {{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</span>
            </div>
            <div class="struk-row">
                <span class="label">Area Parkir</span>
                <span class="value">: {{ $transaksi->area->nama_area ?? '-' }}</span>
            </div>
            
            <div class="struk-divider"></div>
            
            <div class="struk-row">
                <span class="label">Waktu Masuk</span>
                <span class="value">: {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="struk-row">
                <span class="label">Waktu Keluar</span>
                <span class="value">: {{ \Carbon\Carbon::parse($transaksi->waktu_keluar)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="struk-row">
                <span class="label">Durasi Parkir</span>
                <span class="value">: {{ $transaksi->durasi_jam }} Jam</span>
            </div>
            <div class="struk-row">
                <span class="label">Tarif</span>
                <span class="value">: Rp {{ number_format($transaksi->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}/jam</span>
            </div>
            
            <div class="struk-divider"></div>
            
            <div class="struk-total">
                <div class="label">TOTAL BAYAR</div>
                <div class="amount">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="struk-footer">
            <p>Terima kasih telah menggunakan layanan Smart Parkir</p>
            <p>Petugas: {{ $transaksi->user->nama_lengkap ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection