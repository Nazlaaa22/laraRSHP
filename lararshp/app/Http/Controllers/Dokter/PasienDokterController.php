<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PasienDokterController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        $pasien = DB::table('pet')
            ->select(
                'pet.idpet',
                'pet.nama as nama_hewan',
                'pet.tanggal_lahir',
                DB::raw("TIMESTAMPDIFF(YEAR, pet.tanggal_lahir, CURDATE()) as umur"),
                'pet.jenis_kelamin',
                'ras_hewan.nama_ras as ras',
                'jenis_hewan.nama_jenis_hewan as jenis',
                'user.nama as nama_pemilik',
                'pemilik.no_wa as telepon',
                'pemilik.alamat'
            )
            ->leftJoin('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->leftJoin('user', 'user.iduser', '=', 'pemilik.iduser')
            ->leftJoin('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->leftJoin('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->orderBy('pet.nama', 'asc')
            ->get();

        return view('dokter.pasien.index', compact('pasien'));
    }

    public function detail($id)
    {
        $pasien = DB::table('pet')
            ->leftJoin('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->leftJoin('user', 'user.iduser', '=', 'pemilik.iduser')
            ->leftJoin('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->leftJoin('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'pet.*',
                'user.nama as nama_pemilik',
                'pemilik.no_wa as telepon',
                'pemilik.alamat',
                'ras_hewan.nama_ras as ras',
                'jenis_hewan.nama_jenis_hewan as jenis'
            )
            ->where('pet.idpet', $id)
            ->first();

        return view('dokter.pasien.detail', compact('pasien'));
    }

}
