<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Parkir</title>
    <style>
        body {
            background-color: #0f172a; /* Warna dark theme biar senada sama landing page kamu */
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #1e293b;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            width: 320px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #f59e0b; /* Warna kuning emas biar mirip aksen landing page */
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #475569;
            background-color: #0f172a;
            color: white;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #f59e0b;
            color: #0f172a;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #d97706;
        }
        .error-msg {
            color: #ef4444;
            background-color: rgba(239, 68, 68, 0.1);
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h3>Login {{ ucfirst(request()->query('role_akses')) }}</h3>

        @if(session()->has('loginError'))
            <div class="error-msg">
                {{ session('loginError') }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            <input type="hidden" name="role_akses" value="{{ request()->query('role_akses') }}">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autofocus placeholder="Masukkan username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>

            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>