@extends('layouts.main')

@section('title', 'Dashboard Owner')
@section('page_title', 'Selamat Datang, Owner!')

@section('content')
    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .card { background-color: #1e293b; padding: 24px; border-radius: 16px; border: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .card-info h3 { font-size: 14px; color: #94a3b8; font-weight: 500; margin-bottom: 8px; }
        .card-info p { font-size: 28px; font-weight: bold; color: #f8fafc; }
        .card-icon { width: 48px; height: 48px; background-color: rgba(234, 179, 8, 0.1); color: #eab308; display: flex; justify-content: center; align-items: center; border-radius: 12px; font-size: 20px; }
        
        .data-section { background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 24px; }
        .section-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; color: #f8fafc; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { color: #94a3b8; font-size: 14px; font-weight: 500; padding: 12px; border-bottom: 1px solid #334155; }
        td { padding: 16px 12px; border-bottom: 1px solid #334155; font-size: 14px; color: #cbd5e1; }
        tr:last-child td { border-bottom: none; }
        .income { color: #22c55e; font-weight: bold; }
    </style>

    <section class="stats-grid">
        <div class="card">
            <div class="card-info">
                <h3>Total Omset Pendapatan</h3>
                <p>Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="card-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
        </div>
    </section>

    <section class="data-section">
        <div class="section-title"><i class="fa-solid fa-chart-line" style="color: #eab308;"></i> Laporan Riwayat Transaksi Selesai</div>
        <table>
            <thead>
                <tr>
                    <th>ID Parkir</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Durasi (Jam)</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiSelesai ?? [] as $ts)
                <tr>
                    <td><strong>#{{ $ts->id_parkir }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($ts->waktu_masuk)->format('H:i d/m/Y') }}</td>
                    <td>{{ $ts->waktu_keluar ? \Carbon\Carbon::parse($ts->waktu_keluar)->format('H:i d/m/Y') : '-' }}</td>
                    <td>{{ $ts->durasi_jam ?? '0' }} Jam</td>
                    <td><span class="income">Rp {{ number_format($ts->biaya_total ?? 0, 0, ',', '.') }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #64748b;">Belum ada riwayat transaksi selesai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection