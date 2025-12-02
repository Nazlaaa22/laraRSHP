<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Total hewan dalam perawatan
        $totalPasien = Pet::count();

        // Total rekam medis (ambil dari tabel detail_rekam_medis)
        $totalRekam = DB::table('detail_rekam_medis')->count();

        // Shift perawat
        $shift = "Pagi (07:00 - 15:00)";

        // Data pasien untuk tabel tampilan
        $pasien = Pet::with(['pemilik.user'])
            ->orderBy('idpet', 'desc')
            ->get();

        return view('perawat.dashboard', compact(
            'totalPasien',
            'totalRekam',
            'shift',
            'pasien'
        ));
    }
}
