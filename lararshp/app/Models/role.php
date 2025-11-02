<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

}
