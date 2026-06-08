<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = ['nama_lengkap', 'username', 'password', 'role', 'status_aktif'];
    protected $hidden = ['password'];

    public function kendaraans() { return $this->hasMany(Kendaraan::class, 'id_user', 'id_user'); }
    public function transaksis() { return $this->hasMany(Transaksi::class, 'id_user', 'id_user'); }
    public function logs() { return $this->hasMany(LogAktivitas::class, 'id_user', 'id_user'); }
}