<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogAktivitas;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek user ada atau tidak
        if (!$user) {
            return back()->with('loginError', 'Username tidak ditemukan!');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('loginError', 'Password salah!');
        }

        // Cek status aktif
        if ($user->status_aktif != 1) {
            return back()->with('loginError', 'Akun Anda tidak aktif. Hubungi administrator.');
        }

        // Cek role_akses dari form (jika ada)
        $roleAkses = $request->input('role_akses');
        
        // Jika ada role_akses, pastikan sesuai dengan role user
        if ($roleAkses && $user->role !== $roleAkses) {
            return back()->with('loginError', 'Akun ini bukan role ' . ucfirst($roleAkses) . '!');
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Catat log aktivitas
        LogAktivitas::create([
            'id_user' => $user->id_user,
            'aktivitas' => 'Login ke sistem sebagai ' . $user->role,
            'waktu_aktivitas' => now(),
        ]);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } elseif ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Logout dari sistem',
                'waktu_aktivitas' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}