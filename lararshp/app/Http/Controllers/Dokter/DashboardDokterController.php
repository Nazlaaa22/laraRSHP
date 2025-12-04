<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardDokterController extends Controller
{
    public function index()
    {
        return redirect()->route('dokter.pasien');
    }


}
