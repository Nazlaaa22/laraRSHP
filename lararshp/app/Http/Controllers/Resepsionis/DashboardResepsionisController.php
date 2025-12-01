<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Sesuaikan modelnya
        $pendaftaran = TemuDokter::with(['pet.pemilik.user'])->get();

        return view('resepsionis.dashboard', compact('pendaftaran'));
    }
}
