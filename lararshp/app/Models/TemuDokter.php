<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idtemu_dokter';
    public $timestamps = false;

    protected $fillable = [
        'idpet',
        'iddokter',
        'tanggal',
        'keluhan',
        'status'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
    }
}
