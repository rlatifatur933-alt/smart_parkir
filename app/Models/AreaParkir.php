<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';
    
    protected $primaryKey = 'id_area';
    
    public $incrementing = true;
    
    protected $keyType = 'int';
    
    protected $fillable = [
        'nama_area',
        'kapasitas',
        'terisi'
    ];

    protected $casts = [
        'kapasitas' => 'integer',
        'terisi' => 'integer',
    ];

    // Relationships
    public function transaksis() 
    { 
        return $this->hasMany(Transaksi::class, 'id_area', 'id_area'); 
    }
}