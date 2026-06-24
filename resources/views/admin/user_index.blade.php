@extends('layouts.main')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User') 

@section('content')
<div style="padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif; animation: fadeIn 0.4s ease;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="margin: 0; font-weight: 700; color: #1e293b; font-size: 22pt;">
                <i class="bi bi-people-fill" style="color: #0284c7; margin-right: 8px;"></i> Manajemen Data User
            </h2>
            <p style="margin: 5px 0 0 0; color: #64748b; font-size: 11pt;">Kelola hak akses, tambah, ubah, atau hapus akun pengguna sistem parkir.</p>
        </div>
        <a href="{{ route('admin.user.create') }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #0284c7, #0369a1); color: white; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-weight: bold; font-size: 11pt; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2);">
            <i class="bi bi-plus-circle-fill"></i> Tambah User Baru
        </a>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; overflow: hidden;">
        
        <div style="padding: 15px 20px; border-bottom: 1px solid #f1f5f9; background: #fafafa;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <span style="font-weight: bold; color: #475569; font-size: 10.5pt; text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="bi bi-list-ul"></i> Daftar Anggota Terdaftar
                </span>
                <span style="background: #e0f2fe; color: #0369a1; padding: 4px 12px; border-radius: 20px; font-weight: bold; font-size: 10pt;">
                    <span id="totalUser">{{ count($semuaUser) }}</span> Total User
                </span>
            </div>
            
            <!-- Search Box -->
            <div class="search-box" style="margin: 0;">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama, username, atau role..." style="width: 100%; max-width: 100%;">
            </div>
            <div id="searchInfo" class="search-info">
                <i class="bi bi-info-circle"></i>
                Menampilkan <strong id="visibleCount">0</strong> dari <strong id="totalCount">{{ count($semuaUser) }}</strong> user
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: left;" id="tableUser">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #cbd5e1;">
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt; text-align: center; width: 60px;">ID</th>
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt;">Nama Lengkap</th>
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt; width: 150px;">Username</th>
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt; width: 160px;">Role Akses</th>
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt; text-align: center; width: 130px;">Status</th>
                    <th style="padding: 15px 20px; color: #475569; font-weight: 600; font-size: 11pt; text-align: center; width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($semuaUser as $u)
                <tr class="row-user" style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                    <td style="padding: 15px 20px; text-align: center; font-weight: bold; color: #64748b; font-size: 11pt;">{{ $u->id_user }}</td>
                    
                    <td style="padding: 15px 20px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #0284c7; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12pt; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                {{ strtoupper(substr($u->nama_lengkap, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1e293b; font-size: 11.5pt;">{{ $u->nama_lengkap }}</div>
                                <div style="color: #94a3b8; font-size: 9.5pt;">ID: #USER-0{{ $u->id_user }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <td style="padding: 15px 20px;">
                        <span style="font-family: monospace; background: #f1f5f9; color: #ef4444; padding: 4px 8px; border-radius: 4px; font-size: 10.5pt; border: 1px solid #e2e8f0;">
                            @<span>{{ $u->username }}</span>
                        </span>
                    </td>
                    
                    <td style="padding: 15px 20px;">
                        @if($u->role == 'admin')
                            <span style="background-color: #e0f2fe; color: #0369a1; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 10pt; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-shield-lock-fill"></i> ADMIN
                            </span>
                        @elseif($u->role == 'petugas')
                            <span style="background-color: #dcfce7; color: #15803d; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 10pt; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-person-badge-fill"></i> PETUGAS
                            </span>
                        @else
                            <span style="background-color: #f3e8ff; color: #6b21a8; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 10pt; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="bi bi-briefcase-fill"></i> OWNER
                            </span>
                        @endif
                    </td>
                    
                    <td style="padding: 15px 20px; text-align: center;">
                        @if($u->status_aktif == 1)
                            <span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 50px; font-size: 9.5pt; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;">
                                <span style="width: 6px; height: 6px; background: white; border-radius: 50%;"></span> Aktif
                            </span>
                        @else
                            <span style="background: #ef4444; color: white; padding: 4px 12px; border-radius: 50px; font-size: 9.5pt; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;">
                                <span style="width: 6px; height: 6px; background: white; border-radius: 50%;"></span> Non-Aktif
                            </span>
                        @endif
                    </td>
                    
                    <td style="padding: 15px 20px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('admin.user.edit', $u->id_user) }}" style="background: #f59e0b; color: white; text-decoration: none; padding: 6px 14px; border-radius: 6px; font-weight: bold; font-size: 10pt; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.user.destroy', $u->id_user) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus user ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 14px; border-radius: 6px; font-weight: bold; font-size: 10pt; display: inline-flex; align-items: center; gap: 4px; cursor: pointer; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8; font-size: 11pt;">
                        <i class="bi bi-folder-x" style="font-size: 32pt; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                        Belum ada data user terdaftar di sistem.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .row-user:hover {
        background-color: #f8fafc !important;
    }

    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        padding-left: 40px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        width: 100%;
        max-width: 350px;
        padding: 10px 15px 10px 40px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #95a5a6;
        font-size: 1rem;
    }

    .search-info {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-top: 10px;
        display: none;
    }

    .search-info.show {
        display: block;
    }
</style>
@endsection

@section('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    let value = this.value.toUpperCase();
    let table = document.getElementById('tableUser');
    let tr = table.getElementsByTagName('tr');
    let visibleCount = 0;
    
    // Loop through all table rows, and hide those who don't match the search query
    for (let i = 1; i < tr.length; i++) {
        let namaTd = tr[i].getElementsByTagName('td')[1];
        let usernameTd = tr[i].getElementsByTagName('td')[2];
        let roleTd = tr[i].getElementsByTagName('td')[3];
        
        if (namaTd || usernameTd || roleTd) {
            let namaTxt = namaTd.textContent || namaTd.innerText;
            let usernameTxt = usernameTd.textContent || usernameTd.innerText;
            let roleTxt = roleTd.textContent || roleTd.innerText;
            
            if (namaTxt.toUpperCase().indexOf(value) > -1 || 
                usernameTxt.toUpperCase().indexOf(value) > -1 || 
                roleTxt.toUpperCase().indexOf(value) > -1) {
                tr[i].style.display = "";
                visibleCount++;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    
    // Update counter
    document.getElementById('visibleCount').textContent = visibleCount;
    document.getElementById('totalCount').textContent = {{ count($semuaUser) }};
    
    // Show/hide search info
    if (value.length > 0) {
        document.getElementById('searchInfo').classList.add('show');
    } else {
        document.getElementById('searchInfo').classList.remove('show');
    }
    
    // Show message if no results
    let noResultsMsg = document.getElementById('noResultsMsg');
    if (visibleCount === 0 && value.length > 0) {
        if (!noResultsMsg) {
            let tbody = table.querySelector('tbody');
            let msgRow = document.createElement('tr');
            msgRow.id = 'noResultsMsg';
            msgRow.innerHTML = `
                <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8; font-size: 11pt;">
                    <i class="bi bi-search" style="font-size: 32pt; color: #cbd5e1; display: block; margin-bottom: 10px;"></i>
                    Tidak ada user yang sesuai dengan pencarian "<strong>${this.value}</strong>"
                </td>
            `;
            tbody.appendChild(msgRow);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
});
</script>
@endsection