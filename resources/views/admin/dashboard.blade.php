@extends('layouts.main')

@section('title', 'Dashboard Admin')
@section('page_title', 'Selamat Datang, Admin!')

@section('content')
    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .card { background-color: #1e293b; padding: 24px; border-radius: 16px; border: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .card-info h3 { font-size: 14px; color: #94a3b8; font-weight: 500; margin-bottom: 8px; }
        .card-info p { font-size: 28px; font-weight: bold; color: #f8fafc; }
        .card-icon { width: 48px; height: 48px; background-color: rgba(56, 189, 248, 0.1); color: #38bdf8; display: flex; justify-content: center; align-items: center; border-radius: 12px; font-size: 20px; }
        
        .data-section { background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 24px; }
        .section-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; color: #f8fafc; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { color: #94a3b8; font-size: 14px; font-weight: 500; padding: 12px; border-bottom: 1px solid #334155; }
        td { padding: 16px 12px; border-bottom: 1px solid #334155; font-size: 14px; color: #cbd5e1; }
        tr:last-child td { border-bottom: none; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-badge.aktif { background-color: rgba(34, 197, 94, 0.1); color: #22c55e; }
        .status-badge.nonaktif { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    </style>

    <section class="stats-grid">
        <div class="card">
            <div class="card-info">
                <h3>Total Pengguna Aplikasi</h3>
                <p>{{ $totalUser ?? '0' }} User</p>
            </div>
            <div class="card-icon"><i class="fa-solid fa-users"></i></div>
        </div>
        <div class="card">
            <div class="card-info">
                <h3>Total Area Parkir</h3>
                <p>{{ $totalArea ?? '0' }} Area</p>
            </div>
            <div class="card-icon" style="color: #a855f7; background-color: rgba(168,85,247,0.1);"><i class="fa-solid fa-warehouse"></i></div>
        </div>
    </section>

    <section class="data-section">
        <div class="section-title"><i class="fa-solid fa-user-gear" style="color: #38bdf8;"></i> Manajemen Data Akun Terdaftar (Tabel User)</div>
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role Akses</th>
                    <th>Status Akun</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $u)
                <tr>
                    <td><strong>{{ $u->nama_lengkap }}</strong></td>
                    <td>{{ $u->username }}</td>
                    <td><span style="color: #38bdf8;">{{ $u->role }}</span></td>
                    <td>
                        @if($u->status_aktif == 1)
                            <span class="status-badge aktif">Aktif</span>
                        @else
                            <span class="status-badge nonaktif">Non-Aktif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #64748b;">Belum ada data user di database.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection