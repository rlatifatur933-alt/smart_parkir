<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Parkir')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --primary-color: #34495e;
            --secondary-color: #2c3e50;
            --accent-color: #3498db;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        
        .sidebar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand i {
            margin-right: 10px;
        }
        
        .user-panel {
            background-color: rgba(255,255,255,0.1);
            padding: 20px;
            text-align: center;
            margin: 20px;
            border-radius: 10px;
        }
        
        .user-panel i {
            color: #fff;
            margin-bottom: 10px;
        }
        
        .user-panel h6 {
            color: #fff;
            margin: 5px 0;
            font-weight: 600;
        }
        
        .user-panel small {
            color: rgba(255,255,255,0.7);
        }
        
        .nav-custom {
            padding: 0 15px;
        }
        
        .nav-custom .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .nav-custom .nav-link:hover,
        .nav-custom .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateX(5px);
        }
        
        .nav-custom .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        
        .top-navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 30px;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        
        .card-stat {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s;
            overflow: hidden;
        }
        
        .card-stat:hover {
            transform: translateY(-5px);
        }
        
        .card-stat .card-body {
            padding: 25px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .bg-gradient-success { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .bg-gradient-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .bg-gradient-warning { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; }
        .bg-gradient-danger { background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%); color: white; }
        
        .table-custom {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .table-custom thead {
            background-color: var(--primary-color);
            color: white;
        }
        
        .badge-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .btn-custom {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 188, 0.25);
        }
        
        .progress {
            height: 25px;
            border-radius: 12px;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-parking"></i> Smart Parkir
        </div>
        
        <div class="user-panel">
            <i class="fas fa-user-circle fa-3x mb-2"></i>
            <h6>{{ auth()->user()->nama_lengkap ?? 'User' }}</h6>
            <small>{{ ucfirst(auth()->user()->role ?? 'user') }}</small>
        </div>
        
        <nav class="nav-custom flex-column">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            
            @if(auth()->check())
            <a class="nav-link {{ request()->routeIs('parkir.*') ? 'active' : '' }}" href="{{ route('parkir.index') }}">
                <i class="fas fa-car"></i> Transaksi Parkir
            </a>
            
            <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                <i class="fas fa-motorcycle"></i> Data Kendaraan
            </a>
            
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
            <a class="nav-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}" href="{{ route('tarif.index') }}">
                <i class="fas fa-money-bill-wave"></i> Tarif Parkir
            </a>
            
            <a class="nav-link {{ request()->routeIs('area.*') ? 'active' : '' }}" href="{{ route('area.index') }}">
                <i class="fas fa-map-marker-alt"></i> Area Parkir
            </a>
            
            <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                <i class="fas fa-users"></i> Manajemen User
            </a>
            @endif
            
            <a class="nav-link {{ request()->routeIs('log.*') ? 'active' : '' }}" href="{{ route('log.index') }}">
                <i class="fas fa-history"></i> Log Aktivitas
            </a>
            @endif
            
            <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent text-white">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
            <div>
                <span class="text-muted me-3"><i class="far fa-clock"></i> {{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>
        
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> 
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <!-- Content -->
        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.table-datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>