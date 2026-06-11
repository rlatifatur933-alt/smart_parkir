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
    
    .form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .form-card-header {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 20px 25px;
    }
    
    .form-card-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .form-card-body {
        padding: 30px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #11998e;
        box-shadow: 0 0 0 0.2rem rgba(17, 153, 142, 0.25);
    }
    
    .btn-proses {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-proses:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
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
                <div class="stat-number">{{ \App\Models\AreaParkir::count() }}</div>
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

    <!-- Form Input Kendaraan Masuk -->
    <div class="form-card">
        <div class="form-card-header">
            <h5><i class="fas fa-plus-circle me-2"></i>Input Kendaraan Masuk</h5>
        </div>
        <div class="form-card-body">
            <form id="formParkirMasuk">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-car me-1"></i> Plat Nomor <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="plat_nomor" id="plat_nomor" 
                               class="form-control text-uppercase" 
                               placeholder="B 1234 XYZ" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-motorcycle me-1"></i> Jenis <span class="text-danger">*</span>
                        </label>
                        <select name="jenis_kendaraan" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="motor">🏍️ Motor</option>
                            <option value="mobil"> Mobil</option>
                            <option value="lainnya">🚚 Lainnya</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt me-1"></i> Area <span class="text-danger">*</span>
                        </label>
                        <select name="id_area" class="form-select" required>
                            <option value="">-- Pilih Area --</option>
                            @foreach(\App\Models\AreaParkir::all() as $area)
                                @php $tersedia = $area->kapasitas - $area->terisi; @endphp
                                <option value="{{ $area->id_area }}" {{ $tersedia <= 0 ? 'disabled' : '' }}>
                                    {{ $area->nama_area }} ({{ $tersedia }} tersedia)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-palette me-1"></i> Warna
                        </label>
                        <input type="text" name="warna" class="form-control" placeholder="Hitam">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-proses w-100">
                            <i class="fas fa-arrow-circle-down me-1"></i>Proses Masuk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Kendaraan Sedang Parkir -->
    <div class="table-card">
        <div class="table-header">
            <h5><i class="fas fa-list me-2"></i>Kendaraan Sedang Parkir</h5>
            <span class="badge bg-light text-dark">{{ $transaksiAktif->count() }} kendaraan</span>
        </div>
        
        @if($transaksiAktif->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern">
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

// Auto uppercase plat nomor
document.getElementById('plat_nomor').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Submit form parkir masuk dengan AJAX
document.getElementById('formParkirMasuk').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.innerHTML;
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
    btn.disabled = true;
    
    fetch('{{ route("parkir.masuk") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Kendaraan berhasil masuk!',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan'
            });
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
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
</script>
@endsection