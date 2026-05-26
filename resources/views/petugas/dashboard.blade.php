@extends('layouts.main')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Selamat Datang, Petugas Lapangan!')

@section('content')
    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .card { background-color: #1e293b; padding: 24px; border-radius: 16px; border: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .card-info h3 { font-size: 14px; color: #94a3b8; font-weight: 500; margin-bottom: 8px; }
        .card-info p { font-size: 28px; font-weight: bold; color: #f8fafc; }
        .card-icon { width: 48px; height: 48px; background-color: rgba(34, 197, 94, 0.1); color: #22c55e; display: flex; justify-content: center; align-items: center; border-radius: 12px; font-size: 20px; }
        
        .data-section { background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 24px; }
        .section-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; color: #f8fafc; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { color: #94a3b8; font-size: 14px; font-weight: 500; padding: 12px; border-bottom: 1px solid #334155; }
        td { padding: 16px 12px; border-bottom: 1px solid #334155; font-size: 14px; color: #cbd5e1; }
        tr:last-child td { border-bottom: none; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: rgba(234, 179, 8, 0.1); color: #eab308; }
    </style>

    <section class="stats-grid">
        <div class="card">
            <div class="card-info">
                <h3>Kendaraan Aktif Parkir</h3>
                <p>{{ $kendaraanAktif ?? '0' }} Unit</p>
            </div>
            <div class="card-icon"><i class="fa-solid fa-car-side"></i></div>
        </div>
    </section>

    <section class="data-section">
        <div class="section-title"><i class="fa-solid fa-list-check" style="color: #22c55e;"></i> Kendaraan Aktif di Lapangan (Tabel Transaksi)</div>
        <table>
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Waktu Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiAktif ?? [] as $t)
                <tr>
                    <td><strong>{{ $t->kendaraan->plat_nomor ?? '-' }}</strong></td>
                    <td>{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('H:i d/m/Y') }} WIB</td>
                    <td><span class="status-badge">{{ $t->status }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #64748b;">Tidak ada kendaraan yang sedang parkir.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection