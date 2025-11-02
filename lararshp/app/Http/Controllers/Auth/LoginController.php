<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil user berdasarkan email dan relasi role aktif
        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', 1);
        }, 'roleUser.role'])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Login user ke sistem
        Auth::login($user);

        // Simpan data user ke session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $user->roleUser[0]->idrole ?? 'user',
            'user_role_name' => $user->roleUser[0]->role->nama_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? 'active',
        ]);

        // Ambil role user
        $userRole = $user->roleUser[0]->idrole ?? null;

        // Redirect sesuai role
        switch ($userRole) {
            case 1:
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Administrator!');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil sebagai Dokter!');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil sebagai Perawat!');
            case 4:
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil sebagai Resepsionis!');
            default:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil sebagai Pemilik!');
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
