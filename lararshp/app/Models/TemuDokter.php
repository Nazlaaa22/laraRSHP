<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter'; // nama tabel di database kamu
    protected $primaryKey = 'idtemu_dokter';
    public $timestamps = false;

    protected $fillable = [
        'idpet',
        'iddokter',
        'tanggal',
        'keluhan',
        'status'
    ];

    // Relasi ke tabel Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
}
