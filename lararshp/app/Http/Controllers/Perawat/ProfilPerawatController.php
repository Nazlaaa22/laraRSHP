<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilPerawatController extends Controller
{
    public function index()
    {
        $id = session('iduser');
        $profil = \DB::table('user')->where('iduser', $id)->first();
        return view('perawat.profil.index', compact('profil'));
    }

}
