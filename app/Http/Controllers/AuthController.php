<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman login gelap yang kamu buat tadi
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Fungsi untuk mengecek username & password asli (Bcrypt) dari form login
    public function login(Request $request)
    {
        // Validasi input form dulu
        $kredensial = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role_akses' => 'required'
        ]);

        // Proses login otomatis mencocokkan password ter-enkripsi di database
        $sukses = Auth::attempt([
            'username' => $kredensial['username'],
            'password' => $kredensial['password'],
            'role'     => $kredensial['role_akses']
        ]);

        if ($sukses) {
            $request->session()->regenerate();

            // Pindahkan ke dashboard sesuai role masing-masing
            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role === 'petugas') {
                return redirect()->intended('/petugas/dashboard');
            } elseif ($role === 'owner') {
                return redirect()->intended('/owner/dashboard');
            }
        }

        // Kalau gagal login, balikin ke form login dengan pesan error kustom
        return back()->with('loginError', 'Username, password, atau role akses salah!');
    }

    // 3. Fungsi Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}