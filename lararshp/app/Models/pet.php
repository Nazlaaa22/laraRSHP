<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = ['nama','jenis','ras','idpemilik'];

    public function pemilik(){
        return $this->belongsTo(Pemilik::class,'idpemilik','idpemilik');
    }
}
