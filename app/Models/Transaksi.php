<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_parkir';
    protected $fillable = [
        'id_kendaraan', 'waktu_masuk', 'waktu_keluar', 
        'id_tarif', 'durasi_jam', 'biaya_total', 'status', 
        'id_user', 'id_area'
    ];
    public $timestamps = false;
}