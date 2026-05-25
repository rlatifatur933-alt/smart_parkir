<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'areaparkir';
    protected $primaryKey = 'id_area';
    protected $fillable = ['nama_area', 'kapasitas', 'terisi'];
    public $timestamps = false;
}