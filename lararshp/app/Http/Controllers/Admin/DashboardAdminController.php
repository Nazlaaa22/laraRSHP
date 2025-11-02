<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Pemilik;
use App\Models\Pet;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $roleUsers = RoleUser::with(['user', 'role'])->get();
        $pemilik = Pemilik::with('user')->get();
        $pets = Pet::with(['pemilik'])->get();

        return view('admin.dashboard', compact('users', 'roles', 'roleUsers', 'pemilik', 'pets'));
    }
}
