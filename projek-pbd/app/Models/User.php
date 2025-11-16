<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user'; // ✅ ini penting! nama tabel kamu di DB
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'idrole',
        'status'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole');
    }
}
