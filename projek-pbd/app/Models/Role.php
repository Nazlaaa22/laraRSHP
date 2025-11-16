<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // nama tabel di database
    protected $primaryKey = 'idrole'; // primary key
    public $timestamps = false; // karena tabelmu gak punya created_at & updated_at

    protected $fillable = ['nama_role'];
}
