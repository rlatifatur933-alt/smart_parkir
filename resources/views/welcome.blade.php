<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Smart Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #111827 0%, #030712 50%, #1f2937 100%);
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            align-items: center;
        }
        .badge-update {
            background: linear-gradient(to right, #f59e0b, #d97706);
            color: #000;
            font-size: 0.75rem;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 50px;
            display: inline-block;
        }
        .text-gradient {
            background: linear-gradient(to right, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-card {
            background: rgba(31, 41, 55, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(75, 85, 99, 0.4);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .btn-role {
            background: rgba(17, 24, 39, 0.6);
            color: #ffffff;
            border: 1px solid rgba(75, 85, 99, 0.5);
            border-radius: 12px;
            padding: 15px;
            text-align: left;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn-role:hover {
            background: linear-gradient(to right, #f59e0b, #amber-500);
            background-color: #f59e0b;
            color: #000000 !important;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
        }
        .btn-role:hover .role-title {
            color: #000000 !important;
        }
        .btn-role:hover .role-desc {
            color: rgba(0, 0, 0, 0.7) !important;
        }
        .btn-role:hover .arrow {
            color: #000000 !important;
        }
        .role-title {
            font-weight: 600;
            margin-bottom: 2px;
            color: #ffffff;
        }
        .role-desc {
            font-size: 0.8rem;
            color: #9ca3af;
            margin-bottom: 0;
        }
        .arrow {
            color: #6b7280;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 text-start">
                <div class="mb-4">
                    <span class="badge-update text-uppercase">🚀 V2.0 New Update</span>
                </div>
                <h1 class="display-4 fw-black mb-3 text-white">
                    Sistem <span class="text-gradient">Smart Parkir</span>
                </h1>
                <p class="lead text-gray-300 fw-light lh-base mb-4" style="color: #cbd5e1;">
                    Manajemen perparkiran modern digital. Mengamankan kendaraan, mencatat transaksi otomatis, dan memantau kapasitas area secara real-time dengan efisiensi penuh.
                </p>
                <div class="d-flex gap-3 text-secondary small pt-2">
                    <span>⚡ Fast Access</span>
                    <span>•</span>
                    <span>🛡️ Secure Auth</span>
                    <span>•</span>
                    <span>📊 Real-time</span>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-white mb-1">Selamat Datang</h3>
                        <p class="text-muted small">Silakan pilih akses masuk sistem sesuai role Anda.</p>
                    </div>

                    <div class="login-card">
    
                        <a href="{{ route('login', ['role_akses' => 'admin']) }}" class="btn btn-role text-decoration-none">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fs-3">🔑</span>
                                <div>
                                    <div class="role-title">Masuk sebagai Admin</div>
                                    <div class="role-desc">Kelola data user & konfigurasi utama</div>
                                </div>
                            </div>
                            <span class="arrow">&rarr;</span>
                        </a>

                        <a href="{{ route('login', ['role_akses' => 'petugas']) }}" class="btn btn-role text-decoration-none mt-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fs-3">🧑‍✈️</span>
                                <div>
                                    <div class="role-title">Masuk sebagai Petugas</div>
                                    <div class="role-desc">Input & monitoring data parkir lapangan</div>
                                </div>
                            </div>
                            <span class="arrow">&rarr;</span>
                        </a>

                        <a href="{{ route('login', ['role_akses' => 'owner']) }}" class="btn btn-role text-decoration-none mt-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fs-3">📊</span>
                                <div>
                                    <div class="role-title">Masuk sebagai Owner</div>
                                    <div class="role-desc">Pantau laporan pendapatan & statistik</div>
                                </div>
                            </div>
                            <span class="arrow">&rarr;</span>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function setRole(roleName) {
            document.getElementById('role_akses').value = roleName;
        }
    </script>
</body>
</html>