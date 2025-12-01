<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // RELASI KE TABEL role_user
    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'iduser', 'iduser')
                    ->where('status', 1); // HANYA ROLE YANG AKTIF
    }

    // MENGAMBIL ROLE AKTIF
    public function activeRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->wherePivot('status', 1)
                    ->first();
    }
}
