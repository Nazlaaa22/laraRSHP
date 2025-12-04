<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $user = DB::table('user')->where('iduser', Auth::id())->first();
        return view('dokter.profil.index', compact('user'));
    }
}
