<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'logaktivitas';
    protected $primaryKey = 'id_log';
    protected $fillable = ['id_user', 'aktivitas', 'waktu_aktivitas'];
    public $timestamps = false;
}