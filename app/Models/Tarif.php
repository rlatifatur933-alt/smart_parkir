<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tb_tarif';
    
    protected $primaryKey = 'id_tarif';
    
    public $incrementing = true;
    
    protected $keyType = 'int';
    
    protected $fillable = [
        'jenis_kendaraan',
        'tarif_per_jam'
    ];

    protected $casts = [
        'tarif_per_jam' => 'decimal:0',
    ];

    // Relationships
    public function transaksis() 
    { 
        return $this->hasMany(Transaksi::class, 'id_tarif', 'id_tarif'); 
    }
}