@extends('layouts.main')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Total Area -->
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Area Parkir</h6>
                        <h2 class="mb-0">{{ $totalArea ?? 0 }}</h2>
                        <small class="text-muted">Area tersedia</small>
                    </div>
                    <div class="stat-icon bg-gradient-primary">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kendaraan Masuk Hari Ini -->
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Kendaraan Masuk</h6>
                        <h2 class="mb-0">{{ $kendaraanMasuk ?? 0 }}</h2>
                        <small class="text-muted">Hari ini</small>
                    </div>
                    <div class="stat-icon bg-gradient-success">
                        <i class="fas fa-car"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Durasi Rata-rata -->
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Durasi Rata-rata</h6>
                        <h2 class="mb-0">{{ $durasiRata ?? 0 }}</h2>
                        <small class="text-muted">Jam</small>
                    </div>
                    <div class="stat-icon bg-gradient-info">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pendapatan Hari Ini -->
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Pendapatan Hari Ini</h6>
                        <h2 class="mb-0">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</h2>
                        <small class="text-muted">Total</small>
                    </div>
                    <div class="stat-icon bg-gradient-warning">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Area Parkir -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card table-custom">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt text-primary"></i> Status Area Parkir</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($areas as $area)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">{{ $area->nama_area }}</h6>
                                    <span class="badge bg-{{ $area->terisi >= $area->kapasitas ? 'danger' : 'success' }} badge-custom">
                                        {{ $area->terisi >= $area->kapasitas ? 'Penuh' : 'Tersedia' }}
                                    </span>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-{{ $area->terisi >= $area->kapasitas ? 'danger' : 'success' }}" 
                                         role="progressbar" 
                                         style="width: {{ ($area->terisi / $area->kapasitas) * 100 }}%">
                                        {{ $area->terisi }} / {{ $area->kapasitas }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Terisi: {{ $area->terisi }}</small>
                                    <small class="text-success">Tersedia: {{ $area->kapasitas - $area->terisi }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Belum ada data area parkir</p>
                        <a href="{{ route('admin.area.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Area
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaksi Terakhir -->
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-history me-2"></i>Transaksi Terakhir
        </h5>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-primary btn-sm">
            🔍 Lihat Semua
        </a>
    </div>
    <div class="card-body">
        @if($transaksiTerakhir->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="8%">ID Parkir</th>
                        <th width="12%">Plat Nomor</th>
                        <th width="10%">Jenis</th>
                        <th width="14%">Waktu Masuk</th>
                        <th width="14%">Waktu Keluar</th>
                        <th width="12%">Area</th>
                        <th width="10%">Status</th>
                        <th width="12%">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerakhir as $t)
                    <tr>
                        <td><strong>#{{ $t->id_parkir }}</strong></td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $t->kendaraan->plat_nomor }}
                            </span>
                        </td>
                        <td>
                            @if($t->kendaraan->jenis_kendaraan == 'motor')
                                <span class="badge bg-primary">Motor</span>
                            @elseif($t->kendaraan->jenis_kendaraan == 'mobil')
                                <span class="badge bg-info">Mobil</span>
                            @else
                                <span class="badge bg-secondary">Lainnya</span>
                            @endif
                        </td>
                        <td>
                            <small>
                                <i class="fas fa-clock me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d/m/Y H:i') }}
                            </small>
                        </td>
                        <td>
                            @if($t->waktu_keluar)
                                <small>
                                    <i class="fas fa-clock me-1 text-muted"></i>
                                    {{ \Carbon\Carbon::parse($t->waktu_keluar)->format('d/m/Y H:i') }}
                                </small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $t->area->nama_area ?? '-' }}
                            </span>
                        </td>
                        <td>
                            @if($t->status == 'masuk')
                                <span class="badge bg-success">Masuk</span>
                            @else
                                <span class="badge bg-secondary">Keluar</span>
                            @endif
                        </td>
                        <td>
                            <strong class="text-success">
                                Rp {{ number_format($t->biaya_total ?? 0, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada transaksi</p>
        </div>
        @endif
    </div>
</div>
@endsection