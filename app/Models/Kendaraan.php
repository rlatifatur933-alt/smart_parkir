<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $fillable = ['plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik', 'id_user'];
    public $timestamps = false;

    // Relasi balik ke User (Siapa yang mendaftarkan kendaraan)
    public $belongsTo = [
        'user' => [User::class, 'foreignKey' => 'id_user']
    ];
}