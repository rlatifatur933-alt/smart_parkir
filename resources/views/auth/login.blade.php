<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Parkir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c3e50 50%, #34495e 100%);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .login-box {
            background: rgba(44, 62, 80, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(52, 152, 219, 0.3);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(52, 152, 219, 0.4);
        }
        .login-icon i {
            font-size: 2.5rem;
            color: #ffffff;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.8rem;
        }
        .login-subtitle {
            text-align: center;
            color: #bdc3c7;
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
            color: #ecf0f1;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid rgba(52, 152, 219, 0.3);
            background-color: rgba(30, 58, 95, 0.5);
            color: #ffffff;
            box-sizing: border-box;
            font-size: 14px;
            transition: all 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #3498db;
            background-color: rgba(30, 58, 95, 0.8);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        input::placeholder {
            color: #95a5a6;
        }
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }
        button:hover {
            background: linear-gradient(135deg, #5dade2, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.6);
        }
        button:active {
            transform: translateY(0);
        }
        .error-msg {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.3);
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #95a5a6;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #3498db;
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