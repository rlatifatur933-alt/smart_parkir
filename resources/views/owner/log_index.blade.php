@extends('layouts.main')

@section('title', 'Log Pemasukan')
@section('page-title', 'Log Aktivitas Pemasukan')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(17, 153, 142, 0.3);
    }
    
    .page-header h2 {
        margin: 0;
        font-weight: 700;
    }
    
    .page-header p {
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
    .stat-card.hari-ini { border-left-color: #f39c12; }
    .stat-card.minggu { border-left-color: #3498db; }
    .stat-card.bulan { border-left-color: #9b59b6; }
    
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
    .stat-card.hari-ini .stat-icon { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
    .stat-card.minggu .stat-icon { background: rgba(52, 152, 219, 0.1); color: #3498db; }
    .stat-card.bulan .stat-icon { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
    
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2c3e50;
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
    
    .table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .table-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .table-modern {
        margin: 0;
    }
    
    .table-modern thead {
        background: #f8f9fa;
    }
    
    .table-modern thead th {
        padding: 15px 20px;
        font-weight: 600;
        color: #2c3e50;
        border: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table-modern tbody tr {
        transition: all 0.2s;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .table-modern tbody tr:hover {
        background: #f8f9fa;
    }
    
    .table-modern tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        border: none;
    }
    
    .plat-nomor {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
        border: 1px solid #e0e0e0;
    }
    
    .badge-jenis {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .badge-motor {
        background: rgba(17, 153, 142, 0.1);
        color: #11998e;
    }
    
    .badge-mobil {
        background: rgba(243, 156, 18, 0.1);
        color: #f39c12;
    }
    
    .badge-lainnya {
        background: rgba(155, 89, 182, 0.1);
        color: #9b59b6;
    }
    
    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .badge-masuk {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }
    
    .badge-keluar {
        background: rgba(17, 153, 142, 0.1);
        color: #11998e;
    }
    
    .pendapatan-amount {
        font-weight: 700;
        color: #11998e;
        font-size: 1rem;
    }
    
    .btn-filter {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        color: white;
    }
    
    .btn-reset {
        background: #95a5a6;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        transition: all 0.3s;
    }
    
    .btn-reset:hover {
        background: #7f8c8d;
        color: white;
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistik Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <p class="stat-label">Total Pendapatan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card hari-ini">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                <p class="stat-label">Pendapatan Hari Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card minggu">
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($pendapatanMingguIni, 0, ',', '.') }}</div>
                <p class="stat-label">Pendapatan Minggu Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bulan">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
                <p class="stat-label">Pendapatan Bulan Ini</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-card">
        <h5><i class="fas fa-filter me-2"></i>Filter Transaksi</h5>
        <form action="{{ route('owner.log') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="masuk" {{ request('status') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-filter flex-grow-1">
                        <i class="fas fa-search me-1"></i>Terapkan
                    </button>
                    <a href="{{ route('owner.log') }}" class="btn btn-reset">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabel Transaksi -->
    <div class="table-card">
        <div class="table-header">
            <h5><i class="fas fa-list me-2"></i>Riwayat Transaksi</h5>
            <span class="badge bg-light text-dark">{{ $transaksis->count() }} data</span>
        </div>
        
        @if($transaksis->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">ID Parkir</th>
                        <th width="15%">Plat Nomor</th>
                        <th width="10%">Jenis</th>
                        <th width="15%">Waktu Masuk</th>
                        <th width="15%">Waktu Keluar</th>
                        <th width="8%">Durasi</th>
                        <th width="10%">Status</th>
                        <th width="12%">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $index => $t)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>#{{ $t->id_parkir }}</strong></td>
                        <td><span class="plat-nomor">{{ $t->kendaraan->plat_nomor }}</span></td>
                        <td>
                            @if($t->kendaraan->jenis_kendaraan == 'motor')
                                <span class="badge-jenis badge-motor">
                                    <i class="fas fa-motorcycle me-1"></i>Motor
                                </span>
                            @elseif($t->kendaraan->jenis_kendaraan == 'mobil')
                                <span class="badge-jenis badge-mobil">
                                    <i class="fas fa-car me-1"></i>Mobil
                                </span>
                            @else
                                <span class="badge-jenis badge-lainnya">Lainnya</span>
                            @endif
                        </td>
                        <td>
                            <small>
                                <i class="fas fa-clock text-muted me-1"></i>
                                {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d/m/Y H:i') }}
                            </small>
                        </td>
                        <td>
                            @if($t->waktu_keluar)
                                <small>
                                    {{ \Carbon\Carbon::parse($t->waktu_keluar)->format('d/m/Y H:i') }}
                                </small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($t->durasi_jam)
                                <strong>{{ $t->durasi_jam }} jam</strong>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($t->status == 'masuk')
                                <span class="badge-status badge-masuk">
                                    <i class="fas fa-arrow-down me-1"></i>Masuk
                                </span>
                            @else
                                <span class="badge-status badge-keluar">
                                    <i class="fas fa-arrow-up me-1"></i>Keluar
                                </span>
                            @endif
                        </td>
                        <td class="pendapatan-amount">
                            Rp {{ number_format($t->biaya_total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-receipt"></i>
            <h5>Belum Ada Transaksi</h5>
            <p>Belum ada riwayat transaksi pada periode ini</p>
        </div>
        @endif
    </div>
</div>
@endsection