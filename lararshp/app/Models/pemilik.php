<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke tabel Pet (one to many)
    public function pet()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}
