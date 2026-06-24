@extends('layouts.main')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

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
    
    .page-header h2 { margin: 0; font-weight: 700; }
    .page-header p { margin: 5px 0 0 0; opacity: 0.9; }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-left: 4px solid;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .stat-card.parkir { border-left-color: #3498db; }
    .stat-card.tersedia { border-left-color: #2ecc71; }
    .stat-card.area { border-left-color: #9b59b6; }
    .stat-card.waktu { border-left-color: #f39c12; }
    
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
    
    .stat-card.parkir .stat-icon { background: rgba(52, 152, 219, 0.1); color: #3498db; }
    .stat-card.tersedia .stat-icon { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }
    .stat-card.area .stat-icon { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
    .stat-card.waktu .stat-icon { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2c3e50;
        line-height: 1;
    }
    
    .stat-label {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin: 0;
        font-weight: 500;
    }
    
    /* Style untuk Area Card - UPDATED */
    .area-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        margin-bottom: 20px;
        border: 2px solid #e2e8f0;
    }
    
    .area-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        border-color: #11998e;
    }
    
    .area-card.penuh {
        opacity: 0.8;
        border-color: #e74c3c;
    }
    
    .area-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .area-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .area-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-tersedia {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(46, 204, 113, 0.3);
    }
    
    .badge-penuh {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
    }
    
    .area-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .info-item {
        background: #f8fafc;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
    }
    
    .info-label {
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .info-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
    }
    
    .info-value.terisi { color: #e74c3c; }
    .info-value.tersedia { color: #2ecc71; }
    
    .area-progress {
        height: 10px;
        background: #ecf0f1;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 15px;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .area-progress-bar {
        height: 100%;
        border-radius: 5px;
        transition: width 0.5s ease;
    }
    
    .progress-success { background: linear-gradient(90deg, #2ecc71 0%, #27ae60 100%); }
    .progress-warning { background: linear-gradient(90deg, #f39c12 0%, #e67e22 100%); }
    .progress-danger { background: linear-gradient(90deg, #e74c3c 0%, #c0392b 100%); }
    
    .area-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 2px solid #f1f5f9;
    }
    
    .capacity-text {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }
    
    /* UPDATED: Tombol Detail yang berbeda */
    .btn-info-area {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .btn-info-area:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
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
    
    .table-header h5 { margin: 0; font-weight: 600; }
    
    .table-modern thead { background: #f8f9fa; }
    
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
    
    .table-modern tbody tr:hover { background: #f8f9fa; }
    
    .table-modern tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        border: none;
    }
    
    .plat-nomor {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 8px 15px;
        border-radius: 8px;
        display: inline-block;
        border: 2px solid #e0e0e0;
        font-size: 1.1rem;
    }
    
    .badge-jenis {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .badge-motor { background: rgba(17, 153, 142, 0.1); color: #11998e; }
    .badge-mobil { background: rgba(52, 152, 219, 0.1); color: #3498db; }
    .badge-lainnya { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
    
    .badge-area {
        background: rgba(243, 156, 18, 0.1);
        color: #f39c12;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .btn-cetak {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-cetak:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .btn-keluar {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-keluar:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
        color: white;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
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

    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        padding-left: 40px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        width: 100%;
        max-width: 350px;
        padding: 10px 15px 10px 40px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: #11998e;
        box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #95a5a6;
        font-size: 1rem;
    }

    .search-info {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-top: 10px;
        display: none;
    }

    .search-info.show {
        display: block;
    }
    
    .durasi-badge {
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
    }
    
    .durasi-baru { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }
    .durasi-sedang { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
    .durasi-lama { background: rgba(231, 76, 60, 0.1); color: #e74c3c; }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Stat Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card parkir">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-number">{{ $transaksiAktif->count() }}</div>
                <p class="stat-label">Kendaraan Parkir</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card tersedia">
                <div class="stat-icon">
                    <i class="fas fa-parking"></i>
                </div>
                <div class="stat-number">{{ \App\Models\AreaParkir::sum('kapasitas') - \App\Models\AreaParkir::sum('terisi') }}</div>
                <p class="stat-label">Slot Tersedia</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card area">
                <div class="stat-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stat-number">{{ $areas->count() }}</div>
                <p class="stat-label">Total Area</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card waktu">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" style="font-size: 1.8rem;">{{ now()->format('H:i') }}</div>
                <p class="stat-label">Waktu Sekarang</p>
            </div>
        </div>
    </div>

    <!-- Section Area Parkir -->
    <div class="row mt-4">
        <div class="col-12">
            <h4 style="margin-bottom: 20px; font-weight: 700; color: #2c3e50;">
                <i class="fas fa-map-marker-alt me-2" style="color: #11998e;"></i>Status Area Parkir
            </h4>
        </div>

        @foreach($areas as $area)
        @php
            $tersedia = $area->kapasitas - $area->terisi;
            $persen = $area->kapasitas > 0 ? ($area->terisi / $area->kapasitas) * 100 : 0;
            $isPenuh = $tersedia <= 0;
            
            if ($persen >= 100) {
                $progressClass = 'progress-danger';
                $badgeClass = 'badge-penuh';
                $badgeText = 'PENUH';
            } elseif ($persen >= 80) {
                $progressClass = 'progress-warning';
                $badgeClass = 'badge-tersedia';
                $badgeText = 'HAMPIR PENUH';
            } else {
                $progressClass = 'progress-success';
                $badgeClass = 'badge-tersedia';
                $badgeText = 'TERSEDIA';
            }
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="area-card {{ $isPenuh ? 'penuh' : '' }}">
                <div class="area-header">
                    <h5 class="area-name">
                        <i class="fas fa-warehouse" style="color: #11998e;"></i>{{ $area->nama_area }}
                    </h5>
                    <span class="area-badge {{ $badgeClass }}">{{ $badgeText }}</span>
                </div>
                
                <div class="area-info">
                    <div class="info-item">
                        <div class="info-label">Terisi</div>
                        <div class="info-value terisi">{{ $area->terisi }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tersedia</div>
                        <div class="info-value tersedia">{{ $tersedia }}</div>
                    </div>
                </div>
                
                <div class="area-progress">
                    <div class="area-progress-bar {{ $progressClass }}" style="width: {{ min($persen, 100) }}%"></div>
                </div>
                
                <div class="area-footer">
                    <small class="capacity-text">
                        <i class="fas fa-layer-group me-1"></i> Kapasitas: {{ $area->kapasitas }}
                    </small>
                        <a href="{{ route('petugas.area.detail', $area->id_area) }}" class="btn-info-area">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tabel Kendaraan Sedang Parkir -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="table-card">
                <div class="table-header">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-list me-2"></i>Kendaraan Sedang Parkir</h5>
                        <small style="opacity: 0.9;">
                            <span id="totalKendaraan">{{ $transaksiAktif->count() }}</span> kendaraan terdaftar
                        </small>
                    </div>
                    <div class="search-box" style="margin: 0;">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari plat nomor, jenis, atau area...">
                    </div>
                </div>
                <div id="searchInfo" class="search-info px-4 pb-3">
                    <i class="fas fa-info-circle me-1"></i>
                    Menampilkan <strong id="visibleCount">0</strong> dari <strong id="totalCount">{{ $transaksiAktif->count() }}</strong> kendaraan
                </div>
                
                @if($transaksiAktif->count() > 0)
                <div class="table-responsive">
                    <table class="table table-modern" id="tableKendaraan">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Plat Nomor</th>
                                <th width="12%">Jenis</th>
                                <th width="15%">Area</th>
                                <th width="18%">Waktu Masuk</th>
                                <th width="15%">Durasi</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiAktif as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="plat-nomor">{{ $t->kendaraan->plat_nomor }}</span>
                                </td>
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
                                    <span class="badge-area">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $t->area->nama_area ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d/m/Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    @php
                                        $masuk = \Carbon\Carbon::parse($t->waktu_masuk);
                                        $menit = $masuk->diffInMinutes(now());
                                        $jam = floor($menit / 60);
                                        $menitSisa = $menit % 60;
                                        
                                        if($jam < 1) {
                                            $durasiText = $menit . ' mnt';
                                            $durasiClass = 'durasi-baru';
                                        } elseif($jam < 3) {
                                            $durasiText = $jam . 'j ' . $menitSisa . 'm';
                                            $durasiClass = 'durasi-sedang';
                                        } else {
                                            $durasiText = $jam . 'j ' . $menitSisa . 'm';
                                            $durasiClass = 'durasi-lama';
                                        }
                                    @endphp
                                    <span class="durasi-badge {{ $durasiClass }}">
                                        {{ $durasiText }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons justify-content-center">
                                        <a href="{{ route('petugas.cetak.struk', $t->id_parkir) }}" 
                                           class="btn btn-cetak" target="_blank">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                        <button type="button" class="btn btn-keluar" 
                                                onclick="konfirmasiKeluar({{ $t->id_parkir }}, '{{ $t->kendaraan->plat_nomor }}')">
                                            <i class="fas fa-sign-out-alt"></i> Keluar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-parking"></i>
                    <h5>Tidak Ada Kendaraan</h5>
                    <p>Belum ada kendaraan yang sedang parkir saat ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Keluar -->
<div class="modal fade" id="modalKeluar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Keluar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p class="mb-3">
                    Apakah Anda yakin kendaraan <br>
                    <strong class="plat-nomor" id="platNomorKeluar"></strong><br>
                    akan keluar dari area parkir?
                </p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Sistem akan menghitung durasi dan biaya parkir secara otomatis.
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnProsesKeluar" style="border-radius: 8px;">
                    <i class="fas fa-check me-1"></i>Ya, Proses Keluar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let idParkirKeluar = null;

// Konfirmasi keluar
function konfirmasiKeluar(idParkir, platNomor) {
    idParkirKeluar = idParkir;
    document.getElementById('platNomorKeluar').textContent = platNomor;
    new bootstrap.Modal(document.getElementById('modalKeluar')).show();
}

// Proses keluar
document.getElementById('btnProsesKeluar').addEventListener('click', function() {
    if(!idParkirKeluar) return;
    
    const btn = this;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
    btn.disabled = true;
    
    fetch('/parkir/keluar/' + idParkirKeluar, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        bootstrap.Modal.getInstance(document.getElementById('modalKeluar')).hide();
        
        if(data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: `
                    <div class="text-start">
                        <p><strong>Plat:</strong> ${data.data.plat_nomor}</p>
                        <p><strong>Durasi:</strong> ${data.data.durasi_jam} Jam</p>
                        <p><strong>Biaya:</strong> ${data.data.formatted_biaya}</p>
                    </div>
                `,
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message
            });
        }
        
        btn.innerHTML = originalText;
        btn.disabled = false;
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan pada server'
        });
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    let value = this.value.toUpperCase();
    let table = document.getElementById('tableKendaraan');
    let tr = table.getElementsByTagName('tr');
    let visibleCount = 0;
    
    // Loop through all table rows, and hide those who don't match the search query
    for (let i = 1; i < tr.length; i++) {
        let platTd = tr[i].getElementsByTagName('td')[1];
        let jenisTd = tr[i].getElementsByTagName('td')[2];
        let areaTd = tr[i].getElementsByTagName('td')[3];
        
        if (platTd || jenisTd || areaTd) {
            let platTxt = platTd.textContent || platTd.innerText;
            let jenisTxt = jenisTd.textContent || jenisTd.innerText;
            let areaTxt = areaTd.textContent || areaTd.innerText;
            
            if (platTxt.toUpperCase().indexOf(value) > -1 || 
                jenisTxt.toUpperCase().indexOf(value) > -1 || 
                areaTxt.toUpperCase().indexOf(value) > -1) {
                tr[i].style.display = "";
                visibleCount++;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    
    // Update counter
    document.getElementById('visibleCount').textContent = visibleCount;
    document.getElementById('totalCount').textContent = {{ $transaksiAktif->count() }};
    
    // Show/hide search info
    if (value.length > 0) {
        document.getElementById('searchInfo').classList.add('show');
    } else {
        document.getElementById('searchInfo').classList.remove('show');
    }
    
    // Show message if no results
    let noResultsMsg = document.getElementById('noResultsMsg');
    if (visibleCount === 0 && value.length > 0) {
        if (!noResultsMsg) {
            let tbody = table.querySelector('tbody');
            let msgRow = document.createElement('tr');
            msgRow.id = 'noResultsMsg';
            msgRow.innerHTML = `
                <td colspan="7" style="padding: 40px; text-align: center; color: #95a5a6;">
                    <i class="fas fa-search" style="font-size: 3rem; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                    Tidak ada kendaraan yang sesuai dengan pencarian "<strong>${this.value}</strong>"
                </td>
            `;
            tbody.appendChild(msgRow);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
});
</script>
@endsection