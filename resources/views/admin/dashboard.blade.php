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
                        <a href="{{ route('area.create') }}" class="btn btn-primary btn-sm">
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
<div class="row">
    <div class="col-12">
        <div class="card table-custom">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-history text-primary"></i> Transaksi Terakhir</h5>
                <a href="{{ route('parkir.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID Parkir</th>
                                <th>Plat Nomor</th>
                                <th>Jenis</th>
                                <th>Waktu Masuk</th>
                                <th>Area</th>
                                <th>Status</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerakhir as $transaksi)
                            <tr>
                                <td><strong>#{{ $transaksi->id_parkir }}</strong></td>
                                <td>{{ $transaksi->kendaraan->plat_nomor ?? '-' }}</td>
                                <td>{{ ucfirst($transaksi->kendaraan->jenis_kendaraan ?? '-') }}</td>
                                <td>{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</td>
                                <td>{{ $transaksi->area->nama_area ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $transaksi->status === 'masuk' ? 'success' : 'secondary' }} badge-custom">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada transaksi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection