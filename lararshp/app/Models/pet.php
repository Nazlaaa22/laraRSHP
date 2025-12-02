<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan',
    ];

    // Relasi ke pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi ke ras hewan
    public function ras()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Untuk menampilkan jenis melalui relasi ras -> jenis
    public function jenis()
    {
        return $this->hasOneThrough(
            JenisHewan::class,     // model tujuan akhir
            RasHewan::class,       // model perantara
            'idras_hewan',         // FK di RasHewan menuju Pet
            'idjenis_hewan',       // FK di JenisHewan
            'idras_hewan',         // FK lokal (Pet)
            'idjenis_hewan'        // FK di RasHewan ke JenisHewan
        );
    }

    public function dokter() {
        return $this->belongsTo(\App\Models\User::class, 'iddokter', 'iduser');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }

}
