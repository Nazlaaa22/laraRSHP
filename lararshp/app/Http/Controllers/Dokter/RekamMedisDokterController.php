<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisDokterController extends Controller
{
    public function index()
    {
        $rekamMedis = DB::table('rekam_medis')
            ->join('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'rekam_medis.idrekam_medis',
                'rekam_medis.tanggal',
                'rekam_medis.diagnosa',
                'pet.idpet',
                'pet.nama as nama_hewan',
                'ras_hewan.nama_ras as ras',
                'jenis_hewan.nama_jenis_hewan as jenis'
            )
            ->orderBy('rekam_medis.tanggal', 'desc')
            ->get();

        return view('dokter.rekam.index', compact('rekamMedis'));
    }

    public function create()
    {
        return view('dokter.rekam.create');
    }

    public function store(Request $request)
    {
        DB::table('rekam_medis')->insert([
            'idpasien' => $request->idpasien,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
        ]);

        return redirect()->route('dokter.rekam.index');
    }

    public function edit($id)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam', $id)->first();
        return view('dokter.rekam.edit', compact('rekam'));
    }

    public function update(Request $request, $id)
    {
        DB::table('rekam_medis')->where('idrekam', $id)->update([
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
        ]);

        return redirect()->route('dokter.rekam.index');
    }

    public function destroy($id)
    {
        DB::table('rekam_medis')->where('idrekam', $id)->delete();
        return redirect()->route('dokter.rekam.index');
    }

    public function detail($id)
    {
        $pasien = DB::table('pet')
            ->leftJoin('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->leftJoin('user', 'user.iduser', '=', 'pemilik.iduser')
            ->where('pet.idpet', $id)
            ->first();

        $rekamMedis = DB::table('rekam_medis')
            ->where('idpet', $id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('dokter.rekam_medis.detail', compact('pasien', 'rekamMedis'));
    }

}
