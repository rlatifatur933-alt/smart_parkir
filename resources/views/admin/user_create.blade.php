@extends('layouts.main')

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
            <i class="bi bi-person-plus-fill" style="color: #0284c7; margin-right: 8px;"></i> Tambah User Baru
        </h2>
        <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Dafrarkan akun baru ke dalam sistem aplikasi Smart Parkir.</p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; max-width: 600px; padding: 25px;">
        
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Username</label>
                <input type="text" name="username" placeholder="Masukkan username unik" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Password</label>
                <input type="password" name="password" placeholder="Masukkan password akun" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 10.5pt;">Role Akses</label>
                <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11pt; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Hak Akses --</option>
                    <option value="admin">ADMIN</option>
                    <option value="petugas">PETUGAS</option>
                    <option value="owner">OWNER</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <a href="/admin/user" style="text-decoration: none; background: #94a3b8; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 11pt; line-height: 1.5;">Batal</a>
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 10px 24px; border-radius: 6px; font-weight: bold; font-size: 11pt; cursor: pointer; shadow: 0 2px 4px rgba(2, 132, 199, 0.2);">Simpan User</button>
            </div>

        </form>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    input:focus, select:focus {
        outline: none;
        border-color: #0284c7 !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }
</style>
@endsection