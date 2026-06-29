@extends('layouts.main')

@section('title', 'Transaksi Parkir')
@section('page-title', 'Transaksi Parkir')

@section('styles')
<style>
    .card-transaksi {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .card-transaksi .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 20px;
    }
    .card-transaksi .card-header.bg-success-gradient {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    .card-transaksi .card-header.bg-danger-gradient {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }
    .form-control-lg, .form-select-lg {
        border-radius: 10px;
        padding: 12px 15px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-proses {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-proses:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .btn-keluar {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-keluar:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(235, 51, 73, 0.4);
        color: white;
    }
    .stat-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        text-align: center;
        margin-bottom: 20px;
    }
    .stat-box .number {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
    }
    .stat-box .label {
        color: #7f8c8d;
        font-size: 0.9rem;
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
    .badge-jenis {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 12px;
    }
    .badge-motor { background: #3498db; color: white; }
    .badge-mobil { background: #9b59b6; color: white; }
    .badge-lainnya { background: #95a5a6; color: white; }
    .badge-area {
        background: #f39c12;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
    }
    .table-modern {
        background: white;
        border-radius: 12px;
        overflow: hidden;
    }
    .table-modern thead {
        background: #2c3e50;
        color: white;
    }
    .table-modern tbody tr:hover {
        background: #f8f9fa;
    }
    .plat-nomor {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        font-size: 1.1rem;
        color: #2c3e50;
        background: #ecf0f1;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    /* PRINT STYLES - Sembunyikan SEMUA kecuali struk */
    @media print {
        @page {
            margin: 10mm;
            size: auto;
        }
        
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Sembunyikan SEMUA elemen */
        body * {
            visibility: hidden !important;
        }
        
        /* Tampilkan hanya modal struk dan isinya */
        #modalStruk,
        #modalStruk *,
        #modalStruk .modal-content,
        #modalStruk .modal-body,
        #modalStruk .modal-body * {
            visibility: visible !important;
        }
        
        /* Reset posisi modal */
        #modalStruk {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
        }
        
        #modalStruk .modal-content {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
            margin: 0 !important;
            padding: 20px !important;
            max-width: 400px !important;
        }
        
        /* Sembunyikan tombol di modal */
        #modalStruk .modal-footer,
        #modalStruk button,
        #modalStruk .btn-close {
            display: none !important;
        }
        
        /* Hide scrollbar */
        body {
            overflow: visible !important;
        }
        
        /* Hide everything else */
        .main-sidebar,
        .main-header,
        .main-footer,
        .top-navbar,
        .content-wrapper,
        .wrapper,
        nav,
        header,
        footer,
        aside,
        [class*="sidebar"],
        [class*="navbar"],
        .modal-backdrop {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }
    }

</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistik Singkat -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-box">
                <div class="number">{{ $areas->sum('terisi') }}</div>
                <div class="label">Kendaraan Parkir</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="number" style="color: #11998e;">{{ $areas->sum('kapasitas') - $areas->sum('terisi') }}</div>
                <div class="label">Slot Tersedia</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="number" style="color: #f39c12;">{{ $areas->count() }}</div>
                <div class="label">Total Area</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="number" style="color: #e74c3c;">{{ $transaksiAktif->count() }}</div>
                <div class="label">Transaksi Aktif</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Form Kendaraan Masuk -->
        <div class="col-lg-4 mb-4">
            <div class="card card-transaksi">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-circle-down me-2"></i>Kendaraan Masuk
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form id="formParkirMasuk">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-car me-1"></i> Plat Nomor <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="plat_nomor" id="plat_nomor" 
                                   class="form-control form-control-lg text-uppercase" 
                                   placeholder="B 1234 XYZ" required 
                                   value="{{ old('plat_nomor') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-motorcycle me-1"></i> Jenis Kendaraan <span class="text-danger">*</span>
                            </label>
                            <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="motor">🏍️ Motor</option>
                                <option value="mobil">🚗 Mobil</option>
                                <option value="lainnya">🚚 Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1"></i> Area Parkir <span class="text-danger">*</span>
                            </label>
                            <select name="id_area" id="id_area" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Area --</option>
                                @foreach($areas as $area)
                                    @php
                                        $tersedia = $area->kapasitas - $area->terisi;
                                    @endphp
                                    <option value="{{ $area->id_area }}" 
                                            {{ $tersedia <= 0 ? 'disabled' : '' }}>
                                        {{ $area->nama_area }} 
                                        (Tersedia: {{ $tersedia }}/{{ $area->kapasitas }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Area yang penuh tidak dapat dipilih</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-palette me-1"></i> Warna Kendaraan
                            </label>
                            <input type="text" name="warna" id="warna" class="form-control" 
                                   placeholder="Contoh: Hitam, Merah" 
                                   value="{{ old('warna') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1"></i> Nama Pemilik
                            </label>
                            <input type="text" name="pemilik" id="pemilik" class="form-control" 
                                   placeholder="Opsional" 
                                   value="{{ old('pemilik') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-proses btn-lg">
                                <i class="fas fa-ticket-alt me-2"></i>Proses Masuk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Kendaraan Sedang Parkir -->
        <div class="col-lg-8 mb-4">
            <div class="card card-transaksi">
                <div class="card-header bg-success-gradient">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Kendaraan Sedang Parkir
                        <span class="badge bg-white text-success ms-2">{{ $transaksiAktif->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($transaksiAktif->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern table-hover align-middle">
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
                                @foreach($transaksiAktif as $index => $transaksi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="plat-nomor">
                                            {{ $transaksi->kendaraan->plat_nomor }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($transaksi->kendaraan->jenis_kendaraan == 'motor')
                                            <span class="badge-jenis badge-motor">
                                                <i class="fas fa-motorcycle me-1"></i>Motor
                                            </span>
                                        @elseif($transaksi->kendaraan->jenis_kendaraan == 'mobil')
                                            <span class="badge-jenis badge-mobil">
                                                <i class="fas fa-car me-1"></i>Mobil
                                            </span>
                                        @else
                                            <span class="badge-jenis badge-lainnya">Lainnya</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-area">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $transaksi->area->nama_area }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        @php
                                            $waktuMasuk = \Carbon\Carbon::parse($transaksi->waktu_masuk);
                                            $menitTotal = $waktuMasuk->diffInMinutes(\Carbon\Carbon::now());
                                            $jam = floor($menitTotal / 60);
                                            $menit = $menitTotal % 60;
                                            
                                            if($jam < 1) {
                                                $durasiText = $menit . ' mnt';
                                                $color = '#27ae60';
                                            } elseif($jam < 2) {
                                                $durasiText = $jam . 'j ' . $menit . 'm';
                                                $color = '#f39c12';
                                            } else {
                                                $durasiText = $jam . 'j ' . $menit . 'm';
                                                $color = '#e74c3c';
                                            }
                                        @endphp
                                        <span class="durasi-text" 
                                            data-waktu-masuk="{{ $waktuMasuk->format('Y-m-d H:i:s') }}" 
                                            style="color: {{ $color }}; font-weight: 600;">
                                            {{ $durasiText }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-keluar btn-sm" 
                                                onclick="konfirmasiKeluar({{ $transaksi->id_parkir }}, '{{ $transaksi->kendaraan->plat_nomor }}', '{{ $transaksi->kendaraan->jenis_kendaraan }}')">
                                            <i class="fas fa-sign-out-alt me-1"></i>Proses Keluar
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-parking"></i>
                        <h5>Belum Ada Kendaraan</h5>
                        <p>Belum ada kendaraan yang sedang parkir saat ini</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Keluar -->
<div class="modal fade" id="modalKeluar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Keluar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>
                <p class="text-center mb-3">
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

<!-- Modal Struk Pembayaran -->
<div class="modal fade" id="modalStruk" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-receipt me-2"></i>Struk Pembayaran
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="strukContent">
                <!-- Isi struk akan diisi via JavaScript -->
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-success" onclick="window.print()" style="border-radius: 8px;">
                    <i class="fas fa-print me-1"></i>Cetak Struk
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

// Auto uppercase untuk plat nomor
document.getElementById('plat_nomor').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Submit Form Parkir Masuk dengan AJAX
document.getElementById('formParkirMasuk').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.innerHTML;
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
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
                text: 'Kendaraan ' + data.data.plat_nomor + ' berhasil masuk!',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message
            });
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan pada server'
        });
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
});

// Fungsi untuk update durasi secara real-time
function updateDurasi() {
    const durasiElements = document.querySelectorAll('.durasi-text');
    
    durasiElements.forEach(element => {
        const waktuMasukStr = element.getAttribute('data-waktu-masuk');
        const waktuMasuk = new Date(waktuMasukStr.replace(' ', 'T'));
        const sekarang = new Date();
        
        const diffMs = sekarang - waktuMasuk;
        const menitTotal = Math.floor(diffMs / 60000); // konversi ms ke menit
        const jam = Math.floor(menitTotal / 60);
        const menit = menitTotal % 60;
        
        let durasiText;
        let color;
        
        if(jam < 1) {
            durasiText = menit + ' mnt';
            color = '#27ae60';
        } else if(jam < 2) {
            durasiText = jam + 'j ' + menit + 'm';
            color = '#f39c12';
        } else {
            durasiText = jam + 'j ' + menit + 'm';
            color = '#e74c3c';
        }
        
        element.textContent = durasiText;
        element.style.color = color;
    });
}

// Update durasi setiap 30 detik
setInterval(updateDurasi, 30000);

// Update durasi segera setelah halaman load
document.addEventListener('DOMContentLoaded', function() {
    updateDurasi();
});

// Fungsi Konfirmasi Keluar
function konfirmasiKeluar(idParkir, platNomor, jenis) {
    idParkirKeluar = idParkir;
    document.getElementById('platNomorKeluar').textContent = platNomor;
    new bootstrap.Modal(document.getElementById('modalKeluar')).show();
}

// Proses Keluar
document.getElementById('btnProsesKeluar').addEventListener('click', function() {
    if(!idParkirKeluar) return;
    
    const btn = this;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
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
            // Tampilkan struk
            tampilkanStruk(data.data);
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
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan pada server'
        });
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
});

// Fungsi Tampilkan Struk
function tampilkanStruk(data) {
    const now = new Date();
    const tanggal = now.toLocaleDateString('id-ID', { 
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
    });
    const jam = now.toLocaleTimeString('id-ID');
    
    const html = `
        <div style="font-family: 'Courier New', monospace; padding: 20px;">
            <div style="text-align: center; border-bottom: 2px dashed #333; padding-bottom: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 5px 0; font-size: 18px;">🅿️ SMART PARKIR</h4>
                <small style="color: #666;">STRUK PEMBAYARAN PARKIR</small>
                <p style="margin: 5px 0 0 0; font-size: 11px; color: #666;">${tanggal}</p>
            </div>
            
            <div style="margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px;">
                    <span style="color: #666;">Plat Nomor</span>
                    <span style="font-weight: bold;">: ${data.plat_nomor}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px;">
                    <span style="color: #666;">Waktu Masuk</span>
                    <span style="font-weight: bold;">: ${data.waktu_masuk}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px;">
                    <span style="color: #666;">Waktu Keluar</span>
                    <span style="font-weight: bold;">: ${data.waktu_keluar}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px;">
                    <span style="color: #666;">Durasi Parkir</span>
                    <span style="font-weight: bold;">: ${data.durasi_jam} Jam</span>
                </div>
            </div>
            
            <div style="border-top: 2px dashed #333; margin: 15px 0;"></div>
            
            <div style="text-align: center; margin: 15px 0;">
                <div style="font-size: 12px; color: #666; margin-bottom: 5px;">TOTAL BAYAR</div>
                <div style="font-size: 20px; font-weight: bold; color: #11998e;">${data.formatted_biaya}</div>
            </div>
            
            <div style="border-top: 2px dashed #333; padding-top: 15px; text-align: center; font-size: 10px; color: #666;">
                <p style="margin: 0;">Terima kasih telah menggunakan layanan Smart Parkir</p>
            </div>
        </div>
    `;
    
    document.getElementById('strukContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalStruk')).show();
}
</script>
@endsection