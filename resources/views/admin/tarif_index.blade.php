@extends('layouts.main')

@section('title', 'Tarif Parkir')
@section('page-title', 'Tarif Parkir')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(243, 156, 18, 0.3);
    }
    
    .page-header h2 { margin: 0; font-weight: 700; }
    .page-header p { margin: 5px 0 0 0; opacity: 0.9; }
    
    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }
    
    .form-card h5 {
        margin-bottom: 25px;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #f39c12;
        box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
    }
    
    .btn-save {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
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
    
    .table-modern tbody tr { transition: all 0.2s; border-bottom: 1px solid #f0f0f0; }
    .table-modern tbody tr:hover { background: #f8f9fa; }
    .table-modern tbody td { padding: 15px 20px; vertical-align: middle; border: none; }
    
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
    
    .tarif-amount {
        font-weight: 700;
        color: #27ae60;
        font-size: 1rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-edit {
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
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .btn-delete {
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
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
        color: white;
    }

    .btn-add {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px rgba(243, 156, 18, 0.2);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(243, 156, 18, 0.4);
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
    
    <!-- Header dengan Tombol Tambah -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
                <i class="bi bi-cash-coin" style="color: #f39c12; margin-right: 8px;"></i> Manajemen Tarif Parkir
            </h2>
            <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Kelola tarif parkir untuk setiap jenis kendaraan.</p>
        </div>
        <button type="button" class="btn btn-add" onclick="openModalTambah()">
            <i class="bi bi-plus-circle-fill"></i> Tambah Tarif Baru
        </button>
    </div>

    <!-- Tabel Tarif -->
    <div class="table-card">
        <div class="table-header">
            <h5><i class="fas fa-list me-2"></i>Daftar Tarif Parkir</h5>
            <span class="badge bg-light text-dark">{{ $tarif->count() }} tarif terdaftar</span>
        </div>
        
        @if($tarif->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Jenis Kendaraan</th>
                        <th width="30%">Tarif / Jam</th>
                        <th width="30%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarif as $t)
                    <tr>
                        <td><strong>#{{ $t->id_tarif }}</strong></td>
                        <td>
                            @if($t->jenis_kendaraan == 'motor')
                                <span class="badge-jenis badge-motor">
                                    <i class="fas fa-motorcycle me-1"></i>Motor
                                </span>
                            @elseif($t->jenis_kendaraan == 'mobil')
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
                            <span class="tarif-amount">
                                Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons justify-content-center">
                                <button type="button" class="btn btn-edit" 
                                        onclick="editTarif({{ $t->id_tarif }}, '{{ $t->jenis_kendaraan }}', {{ $t->tarif_per_jam }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.tarif.destroy', $t->id_tarif) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?')">
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
            <i class="fas fa-money-bill-wave"></i>
            <h5>Belum Ada Tarif</h5>
            <p>Klik tombol "Tambah Tarif Baru" untuk menambahkan tarif parkir</p>
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Tarif -->
<div class="modal fade" id="modalTambahTarif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Tarif Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.tarif.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kendaraan <span class="text-danger">*</span></label>
                        <select name="jenis_kendaraan" class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="motor">🏍️ Motor</option>
                            <option value="mobil">🚗 Mobil</option>
                            <option value="lainnya">🚚 Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarif per Jam (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="tarif_per_jam" class="form-control" placeholder="Contoh: 2000" required min="0">
                        <small class="text-muted">Masukkan tarif parkir per jam dalam Rupiah</small>
                    </div>
                </div>
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn" style="border-radius: 8px; background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 10px 25px;">
                        <i class="fas fa-save me-1"></i>Simpan Tarif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Tarif -->
<div class="modal fade" id="modalEditTarif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Tarif Parkir
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditTarif" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" id="edit_jenis_kendaraan" class="form-select" required>
                            <option value="motor">🏍️ Motor</option>
                            <option value="mobil">🚗 Mobil</option>
                            <option value="lainnya">🚚 Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarif per Jam (Rp)</label>
                        <input type="number" name="tarif_per_jam" id="edit_tarif_per_jam" class="form-control" required min="0">
                    </div>
                </div>
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn" style="border-radius: 8px; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 10px 25px;">
                        <i class="fas fa-save me-1"></i>Update Tarif
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
// Fungsi untuk membuka modal tambah
function openModalTambah() {
    new bootstrap.Modal(document.getElementById('modalTambahTarif')).show();
}

function editTarif(id, jenis, tarif) {
    document.getElementById('edit_jenis_kendaraan').value = jenis;
    document.getElementById('edit_tarif_per_jam').value = tarif;
    document.getElementById('formEditTarif').action = '/admin/tarif/' + id;
    new bootstrap.Modal(document.getElementById('modalEditTarif')).show();
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