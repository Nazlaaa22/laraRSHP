<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index()
    {
        $retur = DB::table('retur')
            ->join('penerimaan', 'retur.idpenerimaan', '=', 'penerimaan.idpenerimaan')
            ->join('user', 'retur.iduser', '=', 'user.iduser')
            ->select(
                'retur.idretur',
                'retur.tanggal',
                'retur.alasan',
                'retur.status',
                'penerimaan.idpenerimaan',
                'user.username as nama_user'
            )
            ->orderBy('retur.tanggal', 'desc')
            ->get();

        return view('retur.index', compact('retur'));
    }
}
