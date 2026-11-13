<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Smart Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --dark-blue: #1e40af;
            --text-dark: #1e293b;
            --text-gray: #64748b;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            background: #ffffff;
        }
        
        /* Navbar */
        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-link {
            color: var(--text-gray);
            font-weight: 500;
            margin-left: 2rem;
            transition: all 0.3s;
            padding: 8px 16px;
            border-radius: 8px;
        }
        
        .nav-link:hover {
            color: var(--primary-blue);
            background-color: var(--light-blue);
        }
        
        .nav-link.active {
            color: var(--primary-blue);
            background-color: var(--light-blue);
        }
        
        .btn-nav {
            background: var(--primary-blue);
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-nav:hover {
            background: var(--dark-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        
        /* Hero Section */
        .hero-section {
            background: #ffffff;
            padding: 120px 0 80px;
            position: relative;
        }
        
        .hero-badge {
            display: inline-block;
            background: var(--light-blue);
            color: var(--primary-blue);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }
        
        .hero-title span {
            color: var(--primary-blue);
        }
        
        .hero-subtitle {
            font-size: 1.125rem;
            color: var(--text-gray);
            line-height: 1.8;
            margin-bottom: 2rem;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }
        
        .btn-primary-custom {
            background: var(--primary-blue);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .btn-primary-custom:hover {
            background: var(--dark-blue);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.3);
            color: white;
        }
        
        .btn-secondary-custom {
            background: white;
            color: var(--primary-blue);
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid var(--light-blue);
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .btn-secondary-custom:hover {
            border-color: var(--primary-blue);
            background: var(--light-blue);
            color: var(--primary-blue);
        }
        
        .hero-features {
            display: flex;
            gap: 2rem;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-gray);
            font-weight: 500;
        }
        
        .feature-item i {
            color: var(--primary-blue);
        }
        
        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--light-blue) 0%, #ffffff 100%);
            padding: 60px 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--text-gray);
            font-size: 0.95rem;
        }
        
        /* How It Works */
        .how-it-works {
            padding: 100px 0;
            background: #ffffff;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            font-size: 1.125rem;
            color: var(--text-gray);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .step-card {
            text-align: center;
            padding: 40px 30px;
            background: white;
            border-radius: 20px;
            border: 2px solid #f1f5f9;
            transition: all 0.3s;
            position: relative;
        }
        
        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.1);
            border-color: var(--light-blue);
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 20px;
        }
        
        .step-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        .step-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }
        
        .step-card p {
            color: var(--text-gray);
            line-height: 1.7;
        }
        
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: #f8fafc;
        }
        
        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.1);
            border-color: var(--primary-blue);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: var(--light-blue);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.75rem;
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }
        
        .feature-card p {
            color: var(--text-gray);
            line-height: 1.7;
            margin: 0;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }
        
        .cta-section p {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-cta {
            background: white;
            color: var(--primary-blue);
            padding: 16px 40px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.2);
            color: var(--primary-blue);
        }
        
        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer p {
            margin: 0;
            opacity: 0.8;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .hero-features {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-parking"></i>
                Smart Parkir
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-nav" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Kelola Parkir dengan <span>Smart & Efisien</span>
                    </h1>
                    <p class="hero-subtitle">
                        Pantau kapasitas real-time, catat transaksi otomatis, dan tingkatkan 
                        efisiensi operasional parkir Anda dengan teknologi terkini.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>
                        <a href="#how-it-works" class="btn btn-secondary-custom">
                            <i class="fas fa-play-circle"></i>
                            Pelajari Lebih
                        </a>
                    </div>
                    <div class="hero-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Fast Access</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure Auth</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-chart-line"></i>
                            <span>Real-time</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div style="animation: float 3s ease-in-out infinite;">
                        <svg width="400" height="400" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background Circle -->
                            <circle cx="200" cy="200" r="180" fill="#dbeafe" opacity="0.5"/>
                            
                            <!-- Parking Sign -->
                            <rect x="80" y="40" width="10" height="120" rx="5" fill="#2563eb"/>
                            <rect x="50" y="20" width="70" height="70" rx="12" fill="#2563eb"/>
                            <text x="85" y="68" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="white" text-anchor="middle">P</text>
                            
                            <!-- Car -->
                            <rect x="150" y="220" width="180" height="70" rx="15" fill="#2563eb"/>
                            <path d="M 175 220 L 200 170 L 290 170 L 315 220 Z" fill="#3b82f6"/>
                            <path d="M 185 210 L 205 180 L 240 180 L 240 210 Z" fill="white" opacity="0.9"/>
                            <path d="M 250 210 L 250 180 L 285 180 L 305 210 Z" fill="white" opacity="0.9"/>
                            <circle cx="190" cy="290" r="25" fill="#1e293b"/>
                            <circle cx="190" cy="290" r="15" fill="#64748b"/>
                            <circle cx="290" cy="290" r="25" fill="#1e293b"/>
                            <circle cx="290" cy="290" r="15" fill="#64748b"/>
                            <circle cx="170" cy="250" r="10" fill="#fbbf24"/>
                            <circle cx="310" cy="250" r="10" fill="#fbbf24"/>
                            
                            <!-- Decorative Elements -->
                            <circle cx="100" cy="350" r="8" fill="#3b82f6" opacity="0.6"/>
                            <circle cx="320" cy="100" r="12" fill="#3b82f6" opacity="0.6"/>
                            <circle cx="350" cy="300" r="10" fill="#3b82f6" opacity="0.6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>Cara Kerja Sistem</h2>
                <p>Tiga langkah mudah untuk mengelola parkir Anda</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">🚗</div>
                        <h3>Kendaraan Masuk</h3>
                        <p>Catat kendaraan masuk dengan input plat nomor, jenis kendaraan, dan area parkir yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">⏱️</div>
                        <h3>Parkir & Monitor</h3>
                        <p>Pantau durasi parkir secara real-time dan kapasitas area yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">💳</div>
                        <h3>Proses Keluar</h3>
                        <p>Sistem otomatis menghitung durasi dan biaya parkir. Cetak struk pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Semua yang Anda butuhkan untuk mengelola area parkir</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Real-time Monitoring</h3>
                        <p>Pantau kapasitas area parkir secara real-time dengan dashboard yang informatif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Kalkulasi Otomatis</h3>
                        <p>Hitung biaya parkir otomatis berdasarkan durasi dan tarif yang ditentukan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3>Keamanan Terjamin</h3>
                        <p>Sistem autentikasi multi-role dengan enkripsi untuk keamanan data.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📈</div>
                        <h3>Laporan Lengkap</h3>
                        <p>Generate laporan transaksi, pendapatan, dan aktivitas parkir detail.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"></div>
                        <h3>Fast Access</h3>
                        <p>Proses transaksi cepat dalam hitungan detik untuk efisiensi maksimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Smart Parkir System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Update active menu saat scroll
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>