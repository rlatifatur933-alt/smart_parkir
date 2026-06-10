<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Smart Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c3e50 50%, #34495e 100%);
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            align-items: center;
        }
        .badge-update {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.4);
        }
        .text-gradient {
            background: linear-gradient(to right, #3498db, #5dade2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-card {
            background: rgba(44, 62, 80, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(52, 152, 219, 0.3);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .btn-login-main {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }
        .btn-login-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.6);
            color: #ffffff;
            background: linear-gradient(to right, #5dade2, #3498db);
        }
        .btn-login-main .arrow {
            font-size: 1.5rem;
            transition: transform 0.3s;
        }
        .btn-login-main:hover .arrow {
            transform: translateX(5px);
        }
        .info-box {
            background: rgba(52, 73, 94, 0.6);
            border: 1px solid rgba(52, 152, 219, 0.3);
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
        }
        .info-box p {
            color: #bdc3c7;
            font-size: 0.85rem;
            margin: 0;
            text-align: center;
        }
        .text-muted {
            color: #95a5a6 !important;
        }
        .fw-bold {
            color: #ecf0f1;
        }
        h3.fw-bold {
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 text-start">
                <div class="mb-4">
                    <span class="badge-update text-uppercase">Welcome</span>
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
                        <div class="mb-3">
                            <span style="font-size: 4rem;">🔐</span>
                        </div>
                        <h3 class="fw-bold text-white mb-2">Selamat Datang</h3>
                        <p class="text-muted small mb-0">Silakan login untuk mengakses sistem</p>
                    </div>

                    <!-- SATU TOMBOL LOGIN UNTUK SEMUA ROLE -->
                    <a href="{{ route('login') }}" class="btn-login-main">
                        <span style="font-size: 1.5rem;">🚀</span>
                        <span>LOGIN SISTEM</span>
                        <span class="arrow">→</span>
                    </a>

                    <div class="info-box">
                        <p>
                            <i class="fas fa-info-circle"></i>
                            Sistem akan otomatis mengarahkan Anda ke dashboard sesuai role akun Anda
                        </p>
                    </div>

                    <div class="text-center mt-4">
                        <small class="text-muted">
                            © {{ date('Y') }} Smart Parkir System. All rights reserved.
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>