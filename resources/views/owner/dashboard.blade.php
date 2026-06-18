@extends('layouts.main')

@section('title', 'Dashboard Owner')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="fas fa-chart-line me-2 text-primary"></i>Dashboard Owner
                </h2>
            </div>
        </div>
    </div>

    <!-- Stat Cards - Pendapatan Per Area -->
    <div class="row">
        @foreach($areaStats as $stat)
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $stat['area']->nama_area }}
                            </p>
                            <h3 class="mb-2 fw-bold" style="color: #1e3a5f;">
                                Rp {{ number_format($stat['pendapatan'], 0, ',', '.') }}
                            </h3>
                            <div class="d-flex flex-column gap-1 small mb-3">
                                <span class="text-muted">
                                    <i class="fas fa-check-circle text-success me-1"></i>
                                    {{ $stat['transaksi'] }} Transaksi
                                </span>
                                <span class="text-muted">
                                    <i class="fas fa-car text-primary me-1"></i>
                                    {{ $stat['aktif'] }} Sedang Parkir
                                </span>
                            </div>
                            
                            <!-- TOMBOL DETAIL (BARU) -->
                            <a href="{{ route('owner.area.detail', $stat['area']->id_area) }}" 
                               class="btn btn-sm w-100" 
                               style="background: #8b5cf6; color: white; border: none; font-weight: 600; border-radius: 8px; padding: 8px 16px; transition: all 0.2s;">
                                <i class="fas fa-eye me-1"></i> Detail Area
                            </a>
                        </div>
                        <div class="stat-icon ms-3">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <div class="progress" style="height: 6px;">
                        @php
                            $kapasitas = $stat['area']->kapasitas;
                            $terisi = $stat['area']->terisi;
                            $persen = $kapasitas > 0 ? ($terisi / $kapasitas) * 100 : 0;
                        @endphp
                        <div class="progress-bar {{ $persen > 80 ? 'bg-danger' : ($persen > 50 ? 'bg-warning' : 'bg-success') }}" 
                             style="width: {{ $persen }}%"></div>
                    </div>
                    <small class="text-muted d-flex justify-content-between mt-2">
                        <span>Kapasitas: {{ $terisi }}/{{ $kapasitas }}</span>
                        <span>{{ number_format($persen, 0) }}% Terisi</span>
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Total Pendapatan Section -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">
                                <i class="fas fa-money-bill-wave me-2 text-success"></i>Total Pendapatan Keseluruhan
                            </h5>
                            <p class="text-muted mb-0">Dari semua area parkir</p>
                        </div>
                        <div class="text-end">
                            <h2 class="mb-0 fw-bold text-primary">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Riwayat Transaksi -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2 text-primary"></i>Laporan Riwayat Transaksi Selesai
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($transaksiSelesai->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4">ID Parkir</th>
                                    <th class="py-3 px-4">Waktu Masuk</th>
                                    <th class="py-3 px-4">Waktu Keluar</th>
                                    <th class="py-3 px-4">Durasi (Jam)</th>
                                    <th class="py-3 px-4 text-end">Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiSelesai as $ts)
                                <tr>
                                    <td class="px-4 py-3">
                                        <strong>#{{ $ts->id_parkir }}</strong>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($ts->waktu_masuk)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($ts->waktu_keluar)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info">{{ $ts->durasi_jam ?? '0' }} Jam</span>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <span class="text-success fw-bold">
                                            Rp {{ number_format($ts->biaya_total ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada riwayat transaksi selesai</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        flex-shrink: 0;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
        color: white;
    }
</style>
@endsection