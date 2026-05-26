@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
            <i class="bi bi-pencil-square" style="color: #f59e0b; margin-right: 8px;"></i> Edit Data User
        </h2>
        <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Ubah informasi akun untuk user: <strong>{{ $user->nama_lengkap }}</strong></p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; max-width: 600px; padding: 25px;">
        
        <form action="{{ route('admin.user.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 4px; font-size: 10.5pt;">Password Baru</label>
                <small style="color: #94a3b8; display: block; margin-bottom: 8px; font-size: 9pt;">*Kosongkan jika tidak ingin mengganti password</small>
                <input type="password" name="password" placeholder="Masukkan password baru jika ingin diganti" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Role Akses</label>
                <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; background: white;">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ADMIN</option>
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>PETUGAS</option>
                    <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>OWNER</option>
                </select>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Status Akun</label>
                <select name="status_aktif" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; background: white;">
                    <option value="1" {{ $user->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $user->status_aktif == 0 ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <a href="/admin/user" style="text-decoration: none; background: #94a3b8; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 11pt;">Batal</a>
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 24px; border-radius: 6px; font-weight: bold; font-size: 11pt; cursor: pointer;">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>
@endsection