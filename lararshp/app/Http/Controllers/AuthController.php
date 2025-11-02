<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRSHP;

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

        $user = UserRSHP::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'iduser' => $user->iduser,
                'email' => $user->email,
                'nama' => $user->nama ?? 'Admin',
            ]);
            return redirect('/admin');
        }

        return back()->withErrors(['loginError' => 'Email atau password salah!']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
