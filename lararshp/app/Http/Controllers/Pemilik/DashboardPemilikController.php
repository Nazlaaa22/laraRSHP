<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        // Ambil id user yang sedang login
        $iduser = session('user_id');

        // Ambil semua data pet milik user tersebut
        $pets = Pet::whereHas('pemilik', function ($query) use ($iduser) {
            $query->where('iduser', $iduser);
        })->get();

        return view('pemilik.dashboard', compact('pets'));
    }
}
