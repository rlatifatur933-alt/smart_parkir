<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Smart Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .badge-update {
            background: #ffffff;
            color: #1e40af;
            font-size: 0.75rem;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
            border: 1px solid #93c5fd;
        }
        .text-gradient {
            background: linear-gradient(to right, #1e40af, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
        }
        .login-card {
            background: #ffffff;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 10px 15px rgba(0,0,0,0.03);
        }
        .btn-login-main {
            background: #2563eb;
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
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
        }
        .btn-login-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 12px rgba(37, 99, 235, 0.4);
            color: #ffffff;
            background: #1e40af;
        }
        .btn-login-main .arrow {
            font-size: 1.5rem;
            transition: transform 0.3s;
        }
        .btn-login-main:hover .arrow {
            transform: translateX(5px);
        }
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
        }
        .info-box p {
            color: #1e40af;
            font-size: 0.85rem;
            margin: 0;
            text-align: center;
            font-weight: 500;
        }
        .welcome-title {
            color: #0f172a !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
            font-weight: 800 !important;
            line-height: 1.2;
        }
        .welcome-desc {
            color: #0f172a !important;
            font-weight: 600 !important;
            line-height: 1.7;
            font-size: 1.05rem;
        }
        .feature-item {
            color: #0f172a;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.8);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid #93c5fd;
        }
        .card-title {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        .card-subtitle {
            color: #475569 !important;
        }
        .footer-text {
            color: #475569 !important;
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
                <h1 class="display-4 fw-bold mb-3 welcome-title">
                    Sistem <span class="text-gradient">Smart Parkir</span>
                </h1>
                <p class="lead mb-4 welcome-desc">
                    Manajemen perparkiran modern digital. Mengamankan kendaraan, mencatat transaksi otomatis, dan memantau kapasitas area secara real-time dengan efisiensi penuh.
                </p>
                <div class="d-flex gap-3 small pt-2">
                    <span class="feature-item">⚡ Fast Access</span>
                    <span class="feature-item">🛡️ Secure Auth</span>
                    <span class="feature-item">📊 Real-time</span>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <span style="font-size: 4rem;">🔐</span>
                        </div>
                        <h3 class="fw-bold mb-2 card-title">Selamat Datang</h3>
                        <p class="small mb-0 card-subtitle">Silakan login untuk mengakses sistem</p>
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
                        <small class="footer-text">
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