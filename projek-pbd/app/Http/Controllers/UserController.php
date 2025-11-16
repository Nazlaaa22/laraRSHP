<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
            $user = User::join('role', 'user.idrole', '=', 'role.idrole')
                        ->select('user.*', 'role.nama_role')
                        ->orderBy('user.iduser')
                        ->get();
        return view('user.index', compact('user'));
    }
}
