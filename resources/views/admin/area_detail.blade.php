@extends('layouts.main')

@section('title', 'Detail Area: ' . $area->nama_area)
@section('page-title', 'Detail Area Parkir')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif;">
    
    <!-- Header dengan Tombol Kembali -->
    <div style="margin-bottom: 25px;">
        <a href="{{ route('admin.area.index') }}" 
           style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #0284c7; font-size: 10pt; margin-bottom: 12px; font-weight: 600; padding: 8px 16px; background: #e0f2fe; border-radius: 8px; transition: all 0.2s;">
            <i class="bi bi-arrow-left" style="font-size: 12pt;"></i>
            <span>Kembali ke Daftar Area</span>
        </a>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
            <div>
                <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
                    <i class="bi bi-geo-alt-fill" style="color: #8b5cf6; margin-right: 8px;"></i> {{ $area->nama_area }}
                </h2>
                <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Detail aktivitas dan pendapatan area parkir</p>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <p style="margin: 0; font-size: 10pt; opacity: 0.9; margin-bottom: 8px;">Kendaraan Masuk</p>
                    <h3 style="margin: 0; font-size: 32pt; font-weight: 700;">{{ $masuk }}</h3>
                </div>
                <div style="font-size: 48pt; opacity: 0.3;">
                    <i class="bi bi-arrow-down-circle"></i>
                </div>
            </div>
        </div>
        
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <p style="margin: 0; font-size: 10pt; opacity: 0.9; margin-bottom: 8px;">Kendaraan Keluar</p>
                    <h3 style="margin: 0; font-size: 32pt; font-weight: 700;">{{ $keluar }}</h3>
                </div>
                <div style="font-size: 48pt; opacity: 0.3;">
                    <i class="bi bi-arrow-up-circle"></i>
                </div>
            </div>
        </div>
        
        <div style="background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <p style="margin: 0; font-size: 10pt; opacity: 0.9; margin-bottom: 8px;">Total Pendapatan</p>
                    <h3 style="margin: 0; font-size: 28pt; font-weight: 700;">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                </div>
                <div style="font-size: 48pt; opacity: 0.3;">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <!-- Tabel Kendaraan Masuk -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f1f5f9;">
                <h5 style="margin: 0; font-weight: 600; color: #1e293b; font-size: 12pt;">
                    <i class="bi bi-arrow-down-circle" style="color: #10b981;"></i> Kendaraan Sedang Parkir
                </h5>
                <span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 20px; font-size: 9pt; font-weight: 600;">
                    {{ $kendaraanMasuk->count() }}
                </span>
            </div>
            
            @if($kendaraanMasuk->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 9.5pt;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Plat Nomor</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Jenis</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Waktu Masuk</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kendaraanMasuk as $k)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px; font-weight: 600; color: #1e293b;">{{ $k->kendaraan->plat_nomor }}</td>
                            <td style="padding: 12px; text-transform: capitalize; color: #64748b;">{{ $k->kendaraan->jenis_kendaraan }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ \Carbon\Carbon::parse($k->waktu_masuk)->format('d/m/Y H:i') }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ $k->user->nama_lengkap ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="text-align: center; padding: 40px; color: #94a3b8;">
                <i class="bi bi-inbox" style="font-size: 48pt; margin-bottom: 10px; display: block; opacity: 0.3;"></i>
                <p style="margin: 0;">Tidak ada kendaraan sedang parkir</p>
            </div>
            @endif
        </div>

        <!-- Tabel Kendaraan Keluar -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f1f5f9;">
                <h5 style="margin: 0; font-weight: 600; color: #1e293b; font-size: 12pt;">
                    <i class="bi bi-arrow-up-circle" style="color: #f59e0b;"></i> Riwayat Kendaraan Keluar
                </h5>
                <span style="background: #f59e0b; color: white; padding: 4px 12px; border-radius: 20px; font-size: 9pt; font-weight: 600;">
                    {{ $kendaraanKeluar->count() }}
                </span>
            </div>
            
            @if($kendaraanKeluar->count() > 0)
            <div style="overflow-x: auto; max-height: 500px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 9.5pt;">
                    <thead>
                        <tr style="background: #f8fafc; position: sticky; top: 0;">
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Plat Nomor</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Jenis</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Waktu Masuk</th>
                            <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Waktu Keluar</th>
                            <th style="padding: 12px; text-align: right; color: #475569; font-weight: 600;">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kendaraanKeluar as $k)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px; font-weight: 600; color: #1e293b;">{{ $k->kendaraan->plat_nomor }}</td>
                            <td style="padding: 12px; text-transform: capitalize; color: #64748b;">{{ $k->kendaraan->jenis_kendaraan }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ \Carbon\Carbon::parse($k->waktu_masuk)->format('d/m/Y H:i') }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ \Carbon\Carbon::parse($k->waktu_keluar)->format('d/m/Y H:i') }}</td>
                            <td style="padding: 12px; text-align: right; font-weight: 700; color: #059669;">Rp {{ number_format($k->biaya_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="text-align: center; padding: 40px; color: #94a3b8;">
                <i class="bi bi-inbox" style="font-size: 48pt; margin-bottom: 10px; display: block; opacity: 0.3;"></i>
                <p style="margin: 0;">Belum ada kendaraan keluar</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    button:hover, a:hover { 
        opacity: 0.9; 
        transform: translateY(-1px); 
        transition: all 0.2s; 
    }
    
    /* Hover effect untuk tombol kembali */
    a[href="{{ route('admin.area.index') }}"]:hover {
        background: #bae6fd;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
    }
</style>
@endsection