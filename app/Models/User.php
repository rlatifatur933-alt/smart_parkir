<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    // TAMBAHKAN BARIS INI
    public $timestamps = false; 

    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'username',
        'password',
        'role',
        'status_aktif'
    ];
}