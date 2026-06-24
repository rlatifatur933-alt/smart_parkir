@extends('layouts.main')

@section('title', 'Manajemen Kendaraan')
@section('page-title', 'Manajemen Kendaraan')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(240, 147, 188, 0.3);
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
    .stat-card.motor { border-left-color: #11998e; }
    .stat-card.mobil { border-left-color: #f39c12; }
    .stat-card.lainnya { border-left-color: #9b59b6; }
    
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
    .stat-card.motor .stat-icon { background: rgba(17, 153, 142, 0.1); color: #11998e; }
    .stat-card.mobil .stat-icon { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
    .stat-card.lainnya .stat-icon { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
    
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
        font-size: 0.9rem;
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
        font-size: 1.1rem;
        color: #2c3e50;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 8px 15px;
        border-radius: 8px;
        display: inline-block;
        border: 2px solid #e0e0e0;
    }
    
    .badge-jenis {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
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
    
    /* Tombol Edit & Hapus SEJAJAR (tidak ditumpuk) */
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: flex-start;
    }

    .btn-detail {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
        color: white;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
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
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(235, 51, 73, 0.4);
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
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        padding-left: 40px;
        border-radius: 8px;
        border: none;
    }
    
    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #95a5a6;
    }
    
    .owner-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .owner-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        flex-shrink: 0;
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
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-number">{{ $kendaraan->count() }}</div>
                <p class="stat-label">Total Kendaraan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card motor">
                <div class="stat-icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div class="stat-number">{{ $kendaraan->where('jenis_kendaraan', 'motor')->count() }}</div>
                <p class="stat-label">Sepeda Motor</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card mobil">
                <div class="stat-icon">
                    <i class="fas fa-car-side"></i>
                </div>
                <div class="stat-number">{{ $kendaraan->where('jenis_kendaraan', 'mobil')->count() }}</div>
                <p class="stat-label">Mobil</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card lainnya">
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-number">{{ $kendaraan->whereNotIn('jenis_kendaraan', ['motor', 'mobil'])->count() }}</div>
                <p class="stat-label">Lainnya</p>
            </div>
        </div>
    </div>

    <!-- Tabel Kendaraan -->
    <div class="table-card">
        <div class="table-header">
            <h5><i class="fas fa-list me-2"></i>Daftar Kendaraan Terdaftar</h5>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari plat nomor..." style="width: 250px;">
            </div>
        </div>
        
        @if($kendaraan->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern" id="tableKendaraan">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="18%">Plat Nomor</th>
                        <th width="12%">Jenis</th>
                        <th width="12%">Warna</th>
                        <th width="23%">Pemilik</th>
                        <th width="15%">Terdaftar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraan as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="plat-nomor">{{ $k->plat_nomor }}</span>
                        </td>
                        <td>
                            @if($k->jenis_kendaraan == 'motor')
                                <span class="badge-jenis badge-motor">
                                    <i class="fas fa-motorcycle me-1"></i>Motor
                                </span>
                            @elseif($k->jenis_kendaraan == 'mobil')
                                <span class="badge-jenis badge-mobil">
                                    <i class="fas fa-car me-1"></i>Mobil
                                </span>
                            @else
                                <span class="badge-jenis badge-lainnya">
                                    <i class="fas fa-truck me-1"></i>Lainnya
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">{{ ucfirst($k->warna) }}</span>
                        </td>
                        <td>
                            <div class="owner-info">
                                <div class="owner-avatar">
                                    {{ strtoupper(substr($k->pemilik, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50;">{{ $k->pemilik }}</div>
                                    <small style="color: #7f8c8d; font-size: 0.75rem;">ID: #{{ $k->id_user }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($k->created_at)->format('d M Y') }}
                            </small>
                        </td>
                        <td>
                            <!-- TOMBOL DETAIL, EDIT & HAPUS SEJAJAR -->
                            <div class="action-buttons">
                                <a href="{{ route('admin.kendaraan.detail', $k->id_kendaraan) }}" class="btn btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button type="button" class="btn btn-edit" onclick="editKendaraan({{ $k->id_kendaraan }}, '{{ $k->plat_nomor }}', '{{ $k->jenis_kendaraan }}', '{{ $k->warna }}', '{{ $k->pemilik }}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.kendaraan.destroy', $k->id_kendaraan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kendaraan {{ $k->plat_nomor }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-motorcycle"></i>
            <h5>Belum Ada Kendaraan</h5>
            <p>Kendaraan akan otomatis tercatat saat petugas menginput transaksi parkir</p>
        </div>
        @endif
    </div>
</div>

<!-- Modal Edit Kendaraan -->
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
                                <option value="mobil"> Mobil</option>
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
<!-- Modal Detail Kendaraan -->
<div class="modal fade" id="modalDetailKendaraan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Detail Kendaraan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="text-center">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; font-size: 2.5rem; color: white;">
                                <i class="fas fa-car"></i>
                            </div>
                            <h4 id="detail_plat_nomor" style="font-family: 'Courier New', monospace; font-weight: 700; color: #2c3e50;"></h4>
                            <span id="detail_jenis" class="badge-jenis" style="font-size: 1rem; padding: 8px 16px;"></span>
                        </div>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100" style="background: #f8f9fa; border: none; border-radius: 10px;">
                            <div class="card-body p-3">
                                <h6 class="text-muted mb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Kendaraan
                                </h6>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Plat Nomor</small>
                                    <strong id="detail_plat" style="color: #2c3e50; font-size: 1.1rem;"></strong>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Jenis Kendaraan</small>
                                    <strong id="detail_jenis_text" style="color: #2c3e50;"></strong>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Warna</small>
                                    <strong id="detail_warna" style="color: #2c3e50;"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100" style="background: #f8f9fa; border: none; border-radius: 10px;">
                            <div class="card-body p-3">
                                <h6 class="text-muted mb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-user me-2"></i>Informasi Pemilik
                                </h6>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Nama Pemilik</small>
                                    <strong id="detail_pemilik" style="color: #2c3e50; font-size: 1.1rem;"></strong>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">ID User</small>
                                    <strong id="detail_id_user" style="color: #2c3e50;"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="card" style="background: #f8f9fa; border: none; border-radius: 10px;">
                            <div class="card-body p-3">
                                <h6 class="text-muted mb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-clock me-2"></i>Waktu Pendaftaran
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Dibuat</small>
                                        <strong id="detail_created" style="color: #2c3e50;"></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Terakhir Diupdate</small>
                                        <strong id="detail_updated" style="color: #2c3e50;"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Auto uppercase untuk plat nomor di modal edit
document.getElementById('edit_plat_nomor').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    let value = this.value.toUpperCase();
    let table = document.getElementById('tableKendaraan');
    let tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[1]; // Plat nomor column
        if (td) {
            let txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(value) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
});

// Edit kendaraan function - isi modal dengan data
function editKendaraan(id, platNomor, jenis, warna, pemilik) {
    document.getElementById('edit_plat_nomor').value = platNomor;
    document.getElementById('edit_jenis_kendaraan').value = jenis;
    document.getElementById('edit_warna').value = warna;
    document.getElementById('edit_pemilik').value = pemilik;
    
    // Set action form ke route update
    document.getElementById('formEditKendaraan').action = '/admin/kendaraan/' + id;
    
    // Tampilkan modal
    new bootstrap.Modal(document.getElementById('modalEditKendaraan')).show();
}
// Show detail kendaraan
function showDetail(id, platNomor, jenis, warna, pemilik, createdAt, updatedAt) {
    // Set data ke modal
    document.getElementById('detail_plat_nomor').textContent = platNomor;
    document.getElementById('detail_plat').textContent = platNomor;
    document.getElementById('detail_warna').textContent = warna ? ucfirst(warna) : '-';
    document.getElementById('detail_pemilik').textContent = pemilik;
    document.getElementById('detail_id_user').textContent = '#' + id;
    
    // Format tanggal
    document.getElementById('detail_created').textContent = formatDate(createdAt);
    document.getElementById('detail_updated').textContent = formatDate(updatedAt);
    
    // Set badge jenis
    const jenisElement = document.getElementById('detail_jenis');
    const jenisTextElement = document.getElementById('detail_jenis_text');
    
    if (jenis === 'motor') {
        jenisElement.className = 'badge-jenis badge-motor';
        jenisElement.innerHTML = '<i class="fas fa-motorcycle me-1"></i>Motor';
        jenisTextElement.textContent = 'Sepeda Motor';
    } else if (jenis === 'mobil') {
        jenisElement.className = 'badge-jenis badge-mobil';
        jenisElement.innerHTML = '<i class="fas fa-car me-1"></i>Mobil';
        jenisTextElement.textContent = 'Mobil';
    } else {
        jenisElement.className = 'badge-jenis badge-lainnya';
        jenisElement.innerHTML = '<i class="fas fa-truck me-1"></i>Lainnya';
        jenisTextElement.textContent = 'Lainnya';
    }
    
    // Tampilkan modal
    new bootstrap.Modal(document.getElementById('modalDetailKendaraan')).show();
}

// Helper function untuk ucfirst
function ucfirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Helper function untuk format tanggal
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return date.toLocaleDateString('id-ID', options);
}

// Success message
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