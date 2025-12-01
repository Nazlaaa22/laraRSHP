<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $pendaftaran = TemuDokter::orderBy('idreservasi_dokter', 'DESC')->get();

        return view('resepsionis.dashboard', compact('pendaftaran'));
    }
}
