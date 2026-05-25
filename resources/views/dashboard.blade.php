<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parkir - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f8; }
        .navbar-custom { background-color: #0d6efd; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Smart Parkir</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold">Input Kendaraan Masuk</div>
                    <div class="card-body">
                        <form action="{{ route('parkir.masuk') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Plat Nomor</label>
                                <input type="text" name="plat_nomor" class="form-control" placeholder="Contoh: L 1234 AB" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" class="form-control" required>
                                    <option value="motor">Motor</option>
                                    <option value="mobil">Mobil</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Area Parkir</label>
                                <select name="id_area" class="form-control" required>
                                    <option value="1">Area A (Gedung Depan)</option>
                                    <option value="2">Area B (Samping)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cetak Karcis & Masuk</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-info text-white fw-bold">Kapasitas Area Parkir</div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Area A (Gedung Depan):</strong> 10 / 50 Slot Terisi</p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-info" style="width: 20%"></div>
                        </div>
                        <p class="mb-1"><strong>Area B (Samping):</strong> 5 / 30 Slot Terisi</p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 16%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>