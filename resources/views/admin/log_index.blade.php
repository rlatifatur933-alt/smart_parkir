@extends('layouts.main')

@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('styles')
<style>
    .log-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .log-header h2 {
        margin: 0;
        font-weight: 700;
    }
    
    .log-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-left: 4px solid;
        margin-bottom: 20px;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .stat-card.total { border-left-color: #667eea; }
    .stat-card.login { border-left-color: #11998e; }
    .stat-card.parkir { border-left-color: #f39c12; }
    .stat-card.user { border-left-color: #e74c3c; }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
    
    .stat-card.total .stat-icon { background: rgba(102, 126, 234, 0.1); color: #667eea; }
    .stat-card.login .stat-icon { background: rgba(17, 153, 142, 0.1); color: #11998e; }
    .stat-card.parkir .stat-icon { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
    .stat-card.user .stat-icon { background: rgba(231, 76, 60, 0.1); color: #e74c3c; }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin: 0;
    }
    
    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }
    
    .filter-card h5 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
    }
    
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-reset {
        background: #95a5a6;
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-reset:hover {
        background: #7f8c8d;
        color: white;
    }
    
    .log-table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .log-table-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .log-table-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .log-table {
        margin: 0;
    }
    
    .log-table thead {
        background: #f8f9fa;
    }
    
    .log-table thead th {
        padding: 15px 20px;
        font-weight: 600;
        color: #2c3e50;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .log-table tbody tr {
        transition: all 0.2s;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .log-table tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
    }
    
    .log-table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        border: none;
    }
    
    .activity-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .badge-login {
        background: rgba(17, 153, 142, 0.1);
        color: #11998e;
    }
    
    .badge-logout {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }
    
    .badge-parkir-masuk {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }
    
    .badge-parkir-keluar {
        background: rgba(243, 156, 18, 0.1);
        color: #f39c12;
    }
    
    .badge-default {
        background: rgba(149, 165, 166, 0.1);
        color: #95a5a6;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
    }
    
    .avatar-admin { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .avatar-petugas { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .avatar-owner { background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%); }
    
    .user-details h6 {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
        color: #2c3e50;
    }
    
    .user-details small {
        color: #7f8c8d;
        font-size: 0.75rem;
    }
    
    .time-display {
        display: flex;
        flex-direction: column;
    }
    
    .time-display .date {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
    }
    
    .time-display .time {
        color: #7f8c8d;
        font-size: 0.8rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #95a5a6;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
    }
    
    .pagination-custom {
        padding: 20px 25px;
        background: #f8f9fa;
        border-top: 1px solid #e0e0e0;
    }
    
    .btn-refresh {
        background: white;
        border: 1px solid #e0e0e0;
        color: #667eea;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-refresh:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Statistik Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-number">{{ $totalLogs ?? 0 }}</div>
                <p class="stat-label">Total Log Aktivitas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card login">
                <div class="stat-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="stat-number">{{ $totalLoginHariIni ?? 0 }}</div>
                <p class="stat-label">Login Hari Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card parkir">
                <div class="stat-icon">
                    <i class="fas fa-parking"></i>
                </div>
                <div class="stat-number">{{ $totalParkirHariIni ?? 0 }}</div>
                <p class="stat-label">Aktivitas Parkir Hari Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card user">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ $totalUserAktif ?? 0 }}</div>
                <p class="stat-label">User Aktif Hari Ini</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-card">
        <h5><i class="fas fa-filter me-2"></i>Filter Log Aktivitas</h5>
        <form action="{{ route('admin.log.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Jenis Aktivitas</label>
                    <select name="jenis" class="form-select">
                        <option value="">Semua Aktivitas</option>
                        <option value="login" {{ request('jenis') == 'login' ? 'selected' : '' }}>Login/Logout</option>
                        <option value="parkir" {{ request('jenis') == 'parkir' ? 'selected' : '' }}>Aktivitas Parkir</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-select">
                        <option value="">Semua User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id_user }}" {{ request('user_id') == $user->id_user ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }} ({{ ucfirst($user->role) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-filter flex-grow-1">
                        <i class="fas fa-search me-1"></i> Terapkan
                    </button>
                    <a href="{{ route('admin.log.index') }}" class="btn btn-reset">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabel Log -->
    <div class="log-table-card">
        <div class="log-table-header">
            <h5><i class="fas fa-table me-2"></i>Daftar Log Aktivitas</h5>
            <span class="badge bg-light text-dark">{{ $logs->count() }} data</span>
        </div>
        
        @if($logs->count() > 0)
        <div class="table-responsive">
            <table class="table log-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Waktu</th>
                        <th width="25%">User</th>
                        <th width="40%">Aktivitas</th>
                        <th width="10%">Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="time-display">
                                <span class="date">{{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d M Y') }}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('H:i:s') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar avatar-{{ $log->user->role ?? 'default' }}">
                                    {{ strtoupper(substr($log->user->nama_lengkap ?? 'U', 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <h6>{{ $log->user->nama_lengkap ?? 'Unknown' }}</h6>
                                    <small>{{ ucfirst($log->user->role ?? 'user') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $log->aktivitas }}</strong>
                        </td>
                        <td>
                            @php
                                $aktivitas = strtolower($log->aktivitas);
                                if(str_contains($aktivitas, 'login')) {
                                    $badgeClass = 'badge-login';
                                    $icon = 'fa-sign-in-alt';
                                } elseif(str_contains($aktivitas, 'logout')) {
                                    $badgeClass = 'badge-logout';
                                    $icon = 'fa-sign-out-alt';
                                } elseif(str_contains($aktivitas, 'masuk')) {
                                    $badgeClass = 'badge-parkir-masuk';
                                    $icon = 'fa-arrow-circle-down';
                                } elseif(str_contains($aktivitas, 'keluar')) {
                                    $badgeClass = 'badge-parkir-keluar';
                                    $icon = 'fa-arrow-circle-up';
                                } else {
                                    $badgeClass = 'badge-default';
                                    $icon = 'fa-info-circle';
                                }
                            @endphp
                            <span class="activity-badge {{ $badgeClass }}">
                                <i class="fas {{ $icon }} me-1"></i>
                                {{ str_contains($aktivitas, 'login') || str_contains($aktivitas, 'logout') ? 'Auth' : 'Parkir' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination-custom">
            {{ $logs->links() }}
        </div>
        @endif
        @else
        <div class="empty-state">
            <i class="fas fa-clipboard-list"></i>
            <h5>Tidak Ada Data</h5>
            <p>Belum ada log aktivitas yang tercatat</p>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
// Auto refresh setiap 30 detik (opsional)
// setTimeout(function() {
//     location.reload();
// }, 30000);
</script>
@endsection