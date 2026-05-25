<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Smart Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #121214;
            height: 100vh;
            color: #f0f0f0;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
        }
        .login-card {
            background: #1a1a1e;
            border: 1px solid #2d2d35;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        }
        .form-label {
            color: #888892;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .input-group-text {
            background-color: #111114;
            border: 1px solid #2d2d35;
            color: #555562;
        }
        .form-control {
            background-color: #111114;
            border: 1px solid #2d2d35;
            color: #ffffff;
            padding: 12px;
        }
        .form-control:focus {
            background-color: #15151a;
            border-color: #f7b11c;
            color: #ffffff;
            box-shadow: none;
        }
        .btn-gold {
            background-color: #f7b11c;
            border: none;
            color: #0c0c0e;
            font-weight: 700;
            padding: 12px;
            transition: 0.3s;
        }
        .btn-gold:hover {
            background-color: #e59a0f;
            color: #0c0c0e;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-warning text-dark mb-3 fw-bold px-3 py-2 text-uppercase" style="letter-spacing: 1px;">v2.0 New Update</span>
                <h1 class="mb-3">Sistem <span style="color: #f7b11c;">Smart Parkir</span></h1>
                <p class="lead text-muted mb-0" style="max-width: 500px; line-height: 1.6;">
                    Manajemen perparkiran modern digital. Mengamankan kendaraan, mencatat transaksi otomatis, dan memantau kapasitas area secara real-time.
                </p>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="login-card">
                    <h3 class="fw-bold mb-1">Sign In</h3>
                    <p class="text-muted mb-4 small">Silakan masukkan akun Anda untuk mengakses sistem.</p>
                    
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label text-uppercase">Username / Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Masukkan username atau email" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-uppercase">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 rounded-3 shadow text-uppercase">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login ke Sistem
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>