@extends('layouts.main')

@section('title', 'Area Parkir')
@section('page-title', 'Area Parkir')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
            <i class="bi bi-geo-alt-fill" style="color: #0284c7; margin-right: 8px;"></i> Manajemen Area Parkir
        </h2>
        <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Kelola data lokasi dan kapasitas area parkir.</p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 25px;">
        
        <!-- Form Tambah Area -->
        <form action="{{ route('admin.area.store') }}" method="POST" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            @csrf
            <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div style="flex: 2; min-width: 200px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Nama Area</label>
                    <input type="text" name="nama_area" placeholder="Contoh: Blok A" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Kapasitas</label>
                    <input type="number" name="kapasitas" placeholder="Contoh: 50" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt;">
                </div>
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-plus-lg"></i> Simpan Area
                </button>
            </div>
        </form>

        <!-- Tabel Area -->
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8fafc;">
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">ID</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Nama Area</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Kapasitas</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: left;">Terisi</th>
                    <th style="padding: 12px 20px; color: #475569; border-bottom: 2px solid #e2e8f0; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($area as $a)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px; color: #64748b;">{{ $a->id_area }}</td>
                    <td style="padding: 15px 20px; font-weight: 600;">{{ $a->nama_area }}</td>
                    <td style="padding: 15px 20px;">{{ $a->kapasitas }}</td>
                    <td style="padding: 15px 20px;">
                        <span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-weight: bold; color: #475569;">
                            {{ $a->terisi }}
                        </span>
                    </td>
                    <td style="padding: 15px 20px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <!-- TOMBOL EDIT (BARU) -->
                            <button type="button" 
                                    onclick="editArea({{ $a->id_area }}, '{{ $a->nama_area }}', {{ $a->kapasitas }})"
                                    style="background: #0284c7; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 9pt; cursor: pointer; font-weight: bold;">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                            
                            <!-- TOMBOL HAPUS -->
                            <form action="{{ route('admin.area.destroy', $a->id_area) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus area {{ $a->nama_area }}? Pastikan area ini kosong!')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 9pt; cursor: pointer; font-weight: bold;">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Area -->
<div id="modalEditArea" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center; animation: fadeIn 0.3s ease;">
    <div style="background: white; border-radius: 12px; width: 90%; max-width: 450px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden;">
        <!-- Header Modal -->
        <div style="background: #0284c7; color: white; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center;">
            <h5 style="margin: 0; font-weight: 600; font-size: 13pt;">
                <i class="bi bi-pencil-square"></i> Edit Area Parkir
            </h5>
            <button type="button" onclick="tutupModal()" style="background: transparent; border: none; color: white; font-size: 16pt; cursor: pointer; padding: 0; line-height: 1;">
                &times;
            </button>
        </div>
        
        <!-- Body Modal -->
        <form id="formEditArea" method="POST" style="padding: 25px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Nama Area</label>
                <input type="text" name="nama_area" id="edit_nama_area" required 
                       style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt; box-sizing: border-box;">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10pt;">Kapasitas</label>
                <input type="number" name="kapasitas" id="edit_kapasitas" required min="1"
                       style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 10.5pt; box-sizing: border-box;">
                <small style="color: #64748b; font-size: 9pt; margin-top: 5px; display: block;">
                    <i class="bi bi-info-circle"></i> Pastikan kapasitas tidak kurang dari kendaraan yang sedang parkir
                </small>
            </div>
            
            <!-- Footer Modal -->
            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" onclick="tutupModal()" 
                        style="background: #e2e8f0; color: #475569; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-x-lg"></i> Batal
                </button>
                <button type="submit" 
                        style="background: #0284c7; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-check-lg"></i> Update Area
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Hover effect untuk tombol */
    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    /* Input focus effect */
    input:focus {
        outline: none;
        border-color: #0284c7 !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }
</style>

<script>
// Fungsi untuk membuka modal edit
function editArea(id, namaArea, kapasitas) {
    // Isi form dengan data area
    document.getElementById('edit_nama_area').value = namaArea;
    document.getElementById('edit_kapasitas').value = kapasitas;
    
    // Set action form ke URL update
    document.getElementById('formEditArea').action = '/admin/area/' + id;
    
    // Tampilkan modal
    const modal = document.getElementById('modalEditArea');
    modal.style.display = 'flex';
}

// Fungsi untuk menutup modal
function tutupModal() {
    document.getElementById('modalEditArea').style.display = 'none';
}

// Tutup modal saat klik di luar
window.onclick = function(event) {
    const modal = document.getElementById('modalEditArea');
    if (event.target === modal) {
        tutupModal();
    }
}

// Tutup modal dengan tombol ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        tutupModal();
    }
});

// Tampilkan notifikasi SweetAlert2 dari session
@if(session('sukses'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('sukses') }}',
        showConfirmButton: false,
        timer: 2000,
        toast: true,
        position: 'top-end',
        timerProgressBar: true
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#0284c7'
    });
@endif
</script>
@endsection