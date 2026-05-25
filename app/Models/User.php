<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Beritahu Laravel kalau nama tabelnya adalah 'user'
    protected $table = 'user';

    // 2. Beritahu Laravel kalau Primary Key-nya adalah 'id_user'
    protected $primaryKey = 'id_user';

    // 3. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
        'status_aktif',
    ];

    // 4. Sembunyikan password saat data user dipanggil
    protected $hidden = [
        'password',
    ];

    // 5. Matikan timestamps jika di tabel tidak ada created_at & updated_at
    public $timestamps = false;
}