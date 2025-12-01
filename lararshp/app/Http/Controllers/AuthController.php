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

        // Ambil role dari database
        $roleName = strtolower($role->nama_role);

        // Simpan ke session (VERSI FIX)
        session([
            'iduser' => $user->iduser,
            'email' => $user->email,
            'nama' => $user->nama,
            'role' => $roleName, // <- FIX TERPENTING
        ]);

        // Redirect berdasarkan role
        switch ($roleName) {
            case 'administrator':
                return redirect('/admin/dashboard');
            case 'resepsionis':
                return redirect('/resepsionis/dashboard');
            case 'dokter':
                return redirect('/dokter/dashboard');
            case 'perawat':
                return redirect('/perawat/dashboard');
            case 'pemilik':
                return redirect('/pemilik/dashboard');
            default:
                return back()->withErrors(['loginError' => 'Role tidak dikenali!']);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
