@extends('layouts.main')

@section('title', 'Detail Area: ' . $area->nama_area)
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Header dengan Tombol Kembali -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('petugas.dashboard') }}" 
               class="btn btn-sm mb-3" 
               style="background: #e0f2fe; color: #0284c7; border: none; font-weight: 600; border-radius: 8px; padding: 8px 16px; transition: all 0.2s;">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
            
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-map-marker-alt me-2" style="color: #11998e;"></i>{{ $area->nama_area }}
                    </h2>
                    <p class="text-muted mb-0">Detail aktivitas area parkir</p>
                </div>
                <div class="text-muted">
                    <i class="far fa-clock me-1"></i>{{ now()->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Kendaraan Masuk</p>
                            <h2 class="mb-0 fw-bold">{{ $masuk }}</h2>
                        </div>
                        <div class="fs-1 opacity-25">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Kendaraan Keluar</p>
                            <h2 class="mb-0 fw-bold">{{ $keluar }}</h2>
                        </div>
                        <div class="fs-1 opacity-25">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Total Pendapatan</p>
                            <h3 class="mb-0 fw-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="fs-1 opacity-25">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tabel Kendaraan Masuk -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-down-circle me-2" style="color: #10b981;"></i>Kendaraan Sedang Parkir
                        <span class="badge bg-success ms-2">{{ $kendaraanMasuk->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($kendaraanMasuk->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4">Plat Nomor</th>
                                    <th class="py-3 px-4">Jenis</th>
                                    <th class="py-3 px-4">Waktu Masuk</th>
                                    <th class="py-3 px-4">Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraanMasuk as $k)
                                <tr>
                                    <td class="px-4 py-3 fw-bold">{{ $k->kendaraan->plat_nomor }}</td>
                                    <td class="px-4 py-3 text-capitalize">{{ $k->kendaraan->jenis_kendaraan }}</td>
                                    <td class="px-4 py-3 text-muted">{{ \Carbon\Carbon::parse($k->waktu_masuk)->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-muted">{{ $k->user->nama_lengkap ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                        <p>Tidak ada kendaraan sedang parkir</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Kendaraan Keluar -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-up-circle me-2" style="color: #f59e0b;"></i>Riwayat Kendaraan Keluar
                        <span class="badge bg-warning ms-2">{{ $kendaraanKeluar->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($kendaraanKeluar->count() > 0)
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4">Plat Nomor</th>
                                    <th class="py-3 px-4">Jenis</th>
                                    <th class="py-3 px-4">Waktu Masuk</th>
                                    <th class="py-3 px-4">Waktu Keluar</th>
                                    <th class="py-3 px-4 text-end">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraanKeluar as $k)
                                <tr>
                                    <td class="px-4 py-3 fw-bold">{{ $k->kendaraan->plat_nomor }}</td>
                                    <td class="px-4 py-3 text-capitalize">{{ $k->kendaraan->jenis_kendaraan }}</td>
                                    <td class="px-4 py-3 text-muted">{{ \Carbon\Carbon::parse($k->waktu_masuk)->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-muted">{{ \Carbon\Carbon::parse($k->waktu_keluar)->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-end fw-bold text-success">Rp {{ number_format($k->biaya_total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                        <p>Belum ada kendaraan keluar</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-sm:hover {
        transform: translateY(-2px);
        transition: all 0.2s;
    }
    
    a[href="{{ route('petugas.dashboard') }}"]:hover {
        background: #bae6fd !important;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
    }
</style>
@endsection