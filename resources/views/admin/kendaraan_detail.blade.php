@extends('layouts.main')

@section('title', 'Detail Kendaraan - ' . $kendaraan->plat_nomor)
@section('page-title', 'Detail Kendaraan')

@section('styles')
<style>
    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .detail-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
    }
    
    .detail-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
        transition: all 0.3s;
    }
    
    .back-button:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        transform: translateX(-5px);
    }
    
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    
    .info-section {
        margin-bottom: 30px;
    }
    
    .info-section:last-child {
        margin-bottom: 0;
    }
    
    .info-section h5 {
        color: #667eea;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .info-row {
        display: flex;
        margin-bottom: 15px;
    }
    
    .info-label {
        width: 200px;
        color: #7f8c8d;
        font-weight: 500;
    }
    
    .info-value {
        flex: 1;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .plat-display {
        font-family: 'Courier New', monospace;
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 20px 30px;
        border-radius: 12px;
        display: inline-block;
        border: 3px solid #e0e0e0;
        margin-bottom: 15px;
    }
    
    .badge-jenis-large {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
    }
    
    .badge-motor-large {
        background: rgba(17, 153, 142, 0.1);
        color: #11998e;
    }
    
    .badge-mobil-large {
        background: rgba(243, 156, 18, 0.1);
        color: #f39c12;
    }
    
    .badge-lainnya-large {
        background: rgba(155, 89, 182, 0.1);
        color: #9b59b6;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }
    
    .btn-edit-large {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    
    .btn-edit-large:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-back-large {
        background: #95a5a6;
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    
    .btn-back-large:hover {
        background: #7f8c8d;
        transform: translateY(-2px);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- Header -->
    <div class="detail-header">
        <a href="{{ route('admin.kendaraan.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kendaraan
        </a>
        <h2>
            <i class="fas fa-car me-2"></i>Detail Kendaraan
        </h2>
        <p>Informasi lengkap kendaraan terdaftar</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Informasi Kendaraan -->
            <div class="info-card">
                <div class="text-center mb-4">
                    <div class="plat-display">{{ $kendaraan->plat_nomor }}</div>
                    @if($kendaraan->jenis_kendaraan == 'motor')
                        <span class="badge-jenis-large badge-motor-large">
                            <i class="fas fa-motorcycle me-2"></i>Motor
                        </span>
                    @elseif($kendaraan->jenis_kendaraan == 'mobil')
                        <span class="badge-jenis-large badge-mobil-large">
                            <i class="fas fa-car me-2"></i>Mobil
                        </span>
                    @else
                        <span class="badge-jenis-large badge-lainnya-large">
                            <i class="fas fa-truck me-2"></i>Lainnya
                        </span>
                    @endif
                </div>
                
                <div class="info-section">
                    <h5><i class="fas fa-info-circle me-2"></i>Informasi Kendaraan</h5>
                    <div class="info-row">
                        <div class="info-label">Plat Nomor</div>
                        <div class="info-value">: {{ $kendaraan->plat_nomor }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Jenis Kendaraan</div>
                        <div class="info-value">: {{ ucfirst($kendaraan->jenis_kendaraan) }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Warna</div>
                        <div class="info-value">: {{ ucfirst($kendaraan->warna) ?? '-' }}</div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h5><i class="fas fa-user me-2"></i>Informasi Pemilik</h5>
                    <div class="info-row">
                        <div class="info-label">Nama Pemilik</div>
                        <div class="info-value">: {{ $kendaraan->pemilik }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">ID User</div>
                        <div class="info-value">: #{{ $kendaraan->id_user }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Petugas</div>
                        <div class="info-value">: 
                            @if($petugasList->count() > 0)
                                {{ $petugasList->implode(', ') }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h5><i class="fas fa-clock me-2"></i>Riwayat Waktu Masuk & Keluar</h5>
                    @if($riwayatTransaksi->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="table table-sm table-hover" style="font-size: 0.9rem;">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="padding: 10px;">No</th>
                                        <th style="padding: 10px;">Area</th>
                                        <th style="padding: 10px;">Waktu Masuk</th>
                                        <th style="padding: 10px;">Waktu Keluar</th>
                                        <th style="padding: 10px;">Status</th>
                                        <th style="padding: 10px;">Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatTransaksi as $index => $rt)
                                    <tr>
                                        <td style="padding: 10px;">{{ $index + 1 }}</td>
                                        <td style="padding: 10px;">
                                            <span class="badge bg-warning text-dark">
                                                {{ $rt->area->nama_area ?? '-' }}
                                            </span>
                                        </td>
                                        <td style="padding: 10px;">
                                            {{ \Carbon\Carbon::parse($rt->waktu_masuk)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="padding: 10px;">
                                            @if($rt->waktu_keluar)
                                                {{ \Carbon\Carbon::parse($rt->waktu_keluar)->format('d/m/Y H:i') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td style="padding: 10px;">
                                            @if($rt->status == 'masuk')
                                                <span class="badge bg-success">Masuk</span>
                                            @else
                                                <span class="badge bg-secondary">Keluar</span>
                                            @endif
                                        </td>
                                        <td style="padding: 10px;">
                                            <strong class="text-success">
                                                Rp {{ number_format($rt->biaya_total ?? 0, 0, ',', '.') }}
                                            </strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada riwayat transaksi untuk kendaraan ini.
                        </div>
                    @endif
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('admin.kendaraan.index') }}" class="btn-back-large">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="info-card">
                <h5 class="mb-4"><i class="fas fa-lightbulb me-2"></i>Quick Info</h5>
                
                @if($sedangParkir)
                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-parking me-2"></i>
                        <strong>Status Parkir:</strong> Sedang Parkir
                    </div>
                @else
                    <div class="alert alert-secondary mb-3">
                        <i class="fas fa-car me-2"></i>
                        <strong>Status Parkir:</strong> Tidak Parkir
                    </div>
                @endif
                
                <div class="alert alert-success mb-3">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Terdaftar:</strong> Ya
                </div>
                <hr>
                <p class="text-muted mb-2">
                    <i class="fas fa-history me-2"></i>
                    @if($sedangParkir)
                        Kendaraan ini sedang berada di area parkir.
                    @else
                        Kendaraan ini tercatat dalam sistem dan dapat digunakan untuk transaksi parkir.
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kendaraan (Sama seperti di index) -->
<div class="modal fade" id="modalEditKendaraan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Data Kendaraan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditKendaraan" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Plat Nomor <span class="text-danger">*</span></label>
                            <input type="text" name="plat_nomor" id="edit_plat_nomor" class="form-control text-uppercase" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kendaraan <span class="text-danger">*</span></label>
                            <select name="jenis_kendaraan" id="edit_jenis_kendaraan" class="form-select" required>
                                <option value="motor">🏍️ Sepeda Motor</option>
                                <option value="mobil">🚗 Mobil</option>
                                <option value="lainnya">🚚 Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Warna Kendaraan</label>
                            <input type="text" name="warna" id="edit_warna" class="form-control" placeholder="Contoh: Hitam, Merah">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                            <input type="text" name="pemilik" id="edit_pemilik" class="form-control" placeholder="Nama pemilik kendaraan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success" style="border-radius: 8px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; color: white; padding: 10px 25px;">
                        <i class="fas fa-save me-1"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Auto uppercase untuk plat nomor
document.getElementById('edit_plat_nomor').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Edit kendaraan function
function editKendaraan(id) {
    document.getElementById('edit_plat_nomor').value = '{{ $kendaraan->plat_nomor }}';
    document.getElementById('edit_jenis_kendaraan').value = '{{ $kendaraan->jenis_kendaraan }}';
    document.getElementById('edit_warna').value = '{{ $kendaraan->warna }}';
    document.getElementById('edit_pemilik').value = '{{ $kendaraan->pemilik }}';
    
    document.getElementById('formEditKendaraan').action = '/admin/kendaraan/' + id;
    
    new bootstrap.Modal(document.getElementById('modalEditKendaraan')).show();
}

@if(session('sukses'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('sukses') }}',
    timer: 3000,
    showConfirmButton: false
});
@endif
</script>
@endsection