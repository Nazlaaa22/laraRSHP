<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\Pet;
use App\Models\Role;
use App\Models\User;
use App\Models\TindakanTerapi;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalJenis' => JenisHewan::count(),
            'totalRas' => RasHewan::count(),
            'totalKategori' => Kategori::count(),
            'totalKategoriKlinis' => KategoriKlinis::count(),
            'totalPet' => Pet::count(),
            'totalRole' => Role::count(),
            'totalUser' => User::count(),
            'totalTindakan' => TindakanTerapi::count(), 
        ]);
    }
}
