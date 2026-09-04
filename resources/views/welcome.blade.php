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
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #a855f7;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-link {
            color: #475569;
            font-weight: 500;
            margin-left: 2rem;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .btn-nav {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
            color: white;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #f5f3ff 0%, #e0e7ff 50%, #dbeafe 100%);
            min-height: 100vh;
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .hero-badge {
            display: inline-block;
            background: white;
            color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #1e293b;
        }
        
        .hero-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-subtitle {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 2rem;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(99, 102, 241, 0.3);
            color: white;
        }
        
        .btn-secondary-custom {
            background: white;
            color: var(--primary-color);
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-secondary-custom:hover {
            border-color: var(--primary-color);
            background: #f8fafc;
            color: var(--primary-color);
        }
        
        .hero-features {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-weight: 500;
        }
        
        .feature-item i {
            color: var(--primary-color);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Stats Section */
        .stats-section {
            padding: 60px 0;
            background: white;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: var(--primary-color);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(180deg, #fafafa 0%, #ffffff 100%);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
        }
        
        .section-title p {
            font-size: 1.125rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
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
            box-shadow: 0 16px 32px rgba(0,0,0,0.08);
            border-color: var(--primary-color);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #e0e7ff 0%, #fce7f3 100%);
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
            color: #1e293b;
            margin-bottom: 12px;
        }
        
        .feature-card p {
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }
        
        /* About Section */
        .about-section {
            padding: 100px 0;
            background: white;
        }
        
        .about-icon-box {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }
        
        /* Trust Section */
        .trust-section {
            padding: 60px 0;
            background: white;
            text-align: center;
        }
        
        .trust-section p {
            color: #64748b;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .trust-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            opacity: 0.6;
        }
        
        .trust-logos i {
            font-size: 2.5rem;
            color: #94a3b8;
        }
        
        /* Footer */
        .footer {
            background: #0f172a;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer p {
            margin: 0;
            color: #94a3b8;
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
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
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
                        Sistem manajemen perparkiran terintegrasi dengan teknologi AI. 
                        Pantau kapasitas real-time, catat transaksi otomatis, dan tingkatkan 
                        efisiensi operasional parkir Anda.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>
                        <a href="#about" class="btn btn-secondary-custom">
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
                    <div style="font-size: 20rem; opacity: 0.8; animation: float 3s ease-in-out infinite;">
                        🅿️
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Fitur Unggulan Smart Parkir</h2>
                <p>Semua yang Anda butuhkan untuk mengelola area parkir dengan efisien dan profesional</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚗</div>
                    <h3>Kendaraan Masuk/Keluar</h3>
                    <p>Catat setiap kendaraan yang masuk dan keluar secara otomatis dengan sistem yang cepat dan akurat.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Real-time Monitoring</h3>
                    <p>Pantau kapasitas area parkir secara real-time dengan dashboard yang informatif dan mudah dipahami.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Kalkulasi Otomatis</h3>
                    <p>Hitung biaya parkir secara otomatis berdasarkan durasi dan tarif yang telah ditentukan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Keamanan Terjamin</h3>
                    <p>Sistem autentikasi multi-role dengan enkripsi password untuk keamanan data Anda.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"></div>
                    <h3>Responsive Design</h3>
                    <p>Akses sistem dari berbagai perangkat - desktop, tablet, atau smartphone dengan mudah.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Laporan Lengkap</h3>
                    <p>Generate laporan transaksi, pendapatan, dan aktivitas parkir secara detail dan akurat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <i class="fas fa-info-circle me-2"></i>Tentang Kami
                    </div>
                    <h2 style="font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 1.5rem;">
                        Solusi Parkir <span style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Terdepan</span> untuk Indonesia
                    </h2>
                    <p style="color: #64748b; line-height: 1.8; margin-bottom: 2rem;">
                        Smart Parkir adalah sistem manajemen parkir modern yang dirancang untuk memudahkan 
                        pengelolaan area parkir di berbagai instansi seperti mall, rumah sakit, perkantoran, 
                        dan tempat publik lainnya.
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div style="display: flex; gap: 15px; align-items: flex-start;">
                                <div class="about-icon-box">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Terpercaya</h4>
                                    <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Telah melayani ribuan kendaraan setiap harinya</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="display: flex; gap: 15px; align-items: flex-start;">
                                <div class="about-icon-box">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Aman</h4>
                                    <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Sistem keamanan data terenkripsi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="display: flex; gap: 15px; align-items: flex-start;">
                                <div class="about-icon-box">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div>
                                    <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Cepat</h4>
                                    <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Proses transaksi dalam hitungan detik</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="display: flex; gap: 15px; align-items: flex-start;">
                                <div class="about-icon-box">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Support 24/7</h4>
                                    <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Tim support siap membantu kapan saja</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div style="font-size: 15rem; opacity: 0.6;">
                        🏢
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="trust-section">
        <div class="container">
            <p>Dipercaya oleh berbagai instansi dan pengelola parkir</p>
            <div class="trust-logos">
                <i class="fas fa-building"></i>
                <i class="fas fa-university"></i>
                <i class="fas fa-hospital"></i>
                <i class="fas fa-shopping-mall"></i>
                <i class="fas fa-plane"></i>
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
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards
        document.querySelectorAll('.stat-card, .feature-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>