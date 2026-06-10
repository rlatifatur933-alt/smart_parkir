@extends('layouts.main')

@section('content')
<div style="padding: 20px;">
    <h2>Dashboard Petugas Parkir</h2>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $transaksiAktif->count() }}</h3>
                    <p>Kendaraan Parkir</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ \App\Models\AreaParkir::sum('kapasitas') - \App\Models\AreaParkir::sum('terisi') }}</h3>
                    <p>Slot Tersedia</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h3>{{ \App\Models\AreaParkir::count() }}</h3>
                    <p>Total Area</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h3>{{ \Carbon\Carbon::now()->format('H:i') }}</h3>
                    <p>Waktu Sekarang</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Button -->
    <div class="mb-4">
        <a href="{{ route('parkir.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Input Kendaraan Masuk
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead style="background: #f8fafc;">
            <tr>
                <th style="padding: 12px; border: 1px solid #ddd;">Plat Nomor</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Jenis</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Waktu Masuk</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiAktif ?? [] as $t)
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d/m/Y H:i') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <a href="{{ route('petugas.cetak.struk', $t->id_parkir) }}" target="_blank" style="padding: 5px 10px; background: #10b981; color: white; text-decoration: none; border-radius: 4px;">Cetak</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 20px; text-align: center; border: 1px solid #ddd;">Belum ada data kendaraan parkir.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection