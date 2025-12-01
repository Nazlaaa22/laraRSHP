<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['loginError' => 'Email atau password salah!']);
        }

        $role = $user->activeRole();
        if (!$role) {
            return back()->withErrors(['loginError' => 'User tidak memiliki role aktif!']);
        }

        $roleName = $role->nama_role;

        session([
            'iduser' => $user->iduser,
            'email' => $user->email,
            'nama' => $user->nama,
            'role' => $roleName,
        ]);

        return match ($roleName) {
            'Administrator' => redirect('/admin/dashboard'),
            'resepsionis'   => redirect('/resepsionis/dashboard'),
            'dokter'        => redirect('/dokter/dashboard'),
            'perawat'       => redirect('/perawat/dashboard'),
            'pemilik'       => redirect('/pemilik/dashboard'),
            default         => back()->withErrors(['loginError' => 'Role tidak dikenali'])
        };
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
