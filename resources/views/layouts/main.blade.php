<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parkir - Sistem Manajemen Parkir</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            display: block;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Layout Wrapper menggunakan konsep display table untuk kompatibilitas */
        .wrapper-table {
            display: table;
            width: 100%;
            height: 100vh;
            border-collapse: collapse;
        }
        .wrapper-row {
            display: table-row;
        }
        /* Sidebar Styling */
        .main-sidebar {
            display: table-cell;
            width: 260px;
            background-color: #1e293b; /* Warna gelap estetik slategray */
            color: #f8fafc;
            vertical-align: top;
            padding: 24px 16px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.15);
        }
        /* Konten Utama Styling */
        .main-content {
            display: table-cell;
            vertical-align: top;
            padding: 30px;
        }
        /* Menu Sidebar Link */
        .nav-custom {
            display: block;
            color: #94a3b8;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 14pt;
            transition: all 0.2s ease;
        }
        .nav-custom:hover {
            background-color: #334155;
            color: #ffffff;
        }
        .nav-custom i {
            margin-right: 10px;
            font-size: 1.1em;
        }
        .nav-custom.active {
            background-color: #0284c7; /* Warna biru aksen premium */
            color: #ffffff;
            font-weight: bold;
        }
        .sidebar-brand {
            font-size: 18pt;
            font-weight: 700;
            color: #f1f5f9;
            text-align: center;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        .user-panel {
            background-color: #334155;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
        }
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
            margin-bottom: 10px;
            padding-left: 10px;
        }
    </style>
</head>
<body>

    <div class="wrapper-table">
        <div class="wrapper-row">
            
            <div class="main-sidebar">
                <div class="sidebar-brand">
                    <i class="bi bi-p-circle-fill text-warning"></i> Smart Parkir
                </div>
                <p class="text-center text-muted small mb-3">New Update</p>
                
                <div class="user-panel">
                    <div class="small text-muted" style="font-size: 11px;">Selamat Datang,</div>
                    <div class="fw-bold text-white text-truncate">{{ Auth::user()->nama_lengkap }}</div>
                    <span class="badge bg-info text-dark text-uppercase mt-1" style="font-size: 10px; font-weight: 700;">
                        {{ Auth::user()->role }}
                    </span>
                </div>
                
                <div class="section-title">Navigasi Fitur</div>

                @if(Auth::user()->role == 'admin')
                    <a href="/admin/dashboard" class="nav-custom {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard Admin
                    </a>
                    <a href="/admin/user" class="nav-custom {{ Request::is('admin/user*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> User
                    </a>
                    <a href="/admin/tarif" class="nav-custom {{ Request::is('admin/tarif*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i> Tarif Parkir
                    </a>
                    <a href="/admin/area" class="nav-custom {{ Request::is('admin/area*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt-fill"></i> Area Parkir
                    </a>
                    <a href="/admin/kendaraan" class="nav-custom {{ Request::is('admin/kendaraan*') ? 'active' : '' }}">
                        <i class="bi bi-car-front-fill"></i> Kendaraan
                    </a>
                    <a href="{{ route('admin.log.index') }}" class="nav-custom {{ Request::is('admin/log*') ? 'active' : '' }}">
                        <i class="bi bi-shield-lock-fill"></i> Akses Log Aktivitas
                    </a>
                @endif 

                @if(Auth::user()->role == 'petugas')
                    <a href="/petugas/dashboard" class="nav-custom {{ Request::is('petugas/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard Petugas
                    </a>
                    <a href="#" class="nav-custom">
                        <i class="bi bi-printer-fill"></i> Cetak Struk Parkir
                    </a>
                    <a href="#" class="nav-custom">
                        <i class="bi bi-arrow-left-right"></i> Transaksi Parkir
                    </a>
                @endif

                @if(Auth::user()->role == 'owner')
                    <a href="/owner/dashboard" class="nav-custom {{ Request::is('owner/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard Owner
                    </a>
                    <a href="#" class="nav-custom">
                        <i class="bi bi-calendar-check-fill"></i> Rekap Transaksi
                    </a>
                @endif

                <hr style="border-color: #334155; margin-top: 30px;">
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100 py-2 fw-bold">
                        <i class="bi bi-box-arrow-right"></i> Keluar (Logout)
                    </button>
                </form>
            </div>

            <div class="main-content">
                @yield('content')
            </div>

        </div>
    </div>

</body>
</html>