<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Parkir Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">️ Smart Parkir Dashboard</a>
    </div>
</nav>

<div class="container">
    <!-- Alert Message -->
    <div id="alertBox" class="alert d-none" role="alert"></div>

    <div class="row">
        <!-- FORM PARKIR MASUK -->
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🚗 Kendaraan Masuk</h5>
                </div>
                <div class="card-body">
                    <form id="formMasuk">
                        <div class="mb-3">
                            <label class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" name="plat_nomor" required placeholder="Contoh: B 1234 XYZ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kendaraan</label>
                            <select class="form-select" name="jenis_kendaraan" required>
                                <option value="motor">Motor</option>
                                <option value="mobil">Mobil</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area Parkir</label>
                            <select class="form-select" name="id_area" required>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id_area }}">{{ $area->nama_area }} (Kapasitas: {{ $area->kapasitas }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Warna (Opsional)</label>
                            <input type="text" class="form-control" name="warna" placeholder="Contoh: Hitam">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Proses Masuk</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DAFTAR KENDARAAN AKTIF (PARKIR KELUAR) -->
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📋 Kendaraan Sedang Parkir</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plat Nomor</th>
                                    <th>Area</th>
                                    <th>Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiAktif as $trx)
                                    <tr>
                                        <td>{{ $trx->id_parkir }}</td>
                                        <td><strong>{{ $trx->kendaraan->plat_nomor }}</strong></td>
                                        <td>{{ $trx->area->nama_area }}</td>
                                        <td>{{ $trx->waktu_masuk->format('H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-keluar" data-id="{{ $trx->id_parkir }}">
                                                Keluar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada kendaraan yang parkir.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Handle Form & API -->
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const alertBox = document.getElementById('alertBox');

    function showAlert(message, type) {
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = message;
        alertBox.classList.remove('d-none');
        setTimeout(() => alertBox.classList.add('d-none'), 5000);
    }

    // Handle Form Masuk
    document.getElementById('formMasuk').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            plat_nomor: this.plat_nomor.value,
            jenis_kendaraan: this.jenis_kendaraan.value,
            id_area: this.id_area.value,
            warna: this.warna.value
        };

        fetch('/parkir/masuk', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(err => showAlert('Terjadi kesalahan sistem!', 'danger'));
    });

    // Handle Tombol Keluar
    document.querySelectorAll('.btn-keluar').forEach(btn => {
        btn.addEventListener('click', function() {
            const idParkir = this.getAttribute('data-id');
            if (!confirm('Yakin ingin memproses kendaraan keluar?')) return;

            fetch(`/parkir/keluar/${idParkir}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showAlert(`${data.message} - Total Biaya: ${data.data.formatted_biaya}`, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(data.message, 'danger');
                }
            })
            .catch(err => showAlert('Gagal memproses keluar!', 'danger'));
        });
    });
</script>

</body>
</html>