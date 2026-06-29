<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Parkir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: #1e293b;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .login-box {
            background: #ffffff;
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 10px 15px rgba(0,0,0,0.03);
            width: 100%;
            max-width: 400px;
            border: 1px solid #e2e8f0;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-icon {
            width: 80px;
            height: 80px;
            background: #3b82f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        .login-icon i {
            font-size: 2.5rem;
            color: #ffffff;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
            color: #1e293b;
            font-weight: 700;
            font-size: 1.8rem;
        }
        .login-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #475569;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
            color: #1e293b;
            box-sizing: border-box;
            font-size: 14px;
            transition: all 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        input::placeholder {
            color: #94a3b8;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #3b82f6;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        button:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }
        button:active {
            transform: translateY(0);
        }
        .error-msg {
            color: #dc2626;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #3b82f6;
        }
        .back-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-lock"></i>
            </div>
            <h3>Login Smart Parkir</h3>
            <p class="login-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if(session()->has('loginError'))
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i> {{ session('loginError') }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            <input type="hidden" name="role_akses" value="{{ request()->query('role_akses') }}">

            <div class="form-group">
                <label><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" required autofocus placeholder="Masukkan username" value="{{ old('username') }}">
            </div>

            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>

            <button type="submit">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>
        
        <a href="/" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
        </a>
    </div>

</body>
</html>