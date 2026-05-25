<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';
    protected $primaryKey = 'id_tarif';
    protected $fillable = ['jenis_kendaraan', 'tarif_per_jam'];
    public $timestamps = false; // Karena di tabel tidak ada kolom created_at & updated_at
}