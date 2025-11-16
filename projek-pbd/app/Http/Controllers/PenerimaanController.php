<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        // ambil data penerimaan join ke pengadaan dan user (sesuaikan nama kolom di DB-mu)
        $penerimaan = DB::table('penerimaan')
            ->leftJoin('pengadaan', 'penerimaan.idpengadaan', '=', 'pengadaan.idpengadaan')
            ->leftJoin('user', 'penerimaan.iduser', '=', 'user.iduser')
            ->select(
                'penerimaan.idpenerimaan',
                'pengadaan.idpengadaan',
                DB::raw("COALESCE(user.username, '') as nama_user"),
                'penerimaan.tanggal',
                'penerimaan.status'
            )
            ->orderBy('penerimaan.tanggal', 'desc')
            ->get();

        return view('penerimaan.index', compact('penerimaan'));
    }

    // optional: halaman detail penerimaan yang menampilkan detail_penerimaan
    public function show($id)
    {
        $header = DB::table('penerimaan')->where('idpenerimaan', $id)->first();

        $detail = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.idbarang', '=', 'barang.idbarang')
            ->where('detail_penerimaan.idpenerimaan', $id)
            ->select('detail_penerimaan.*', 'barang.nama as nama_barang')
            ->get();

        return view('penerimaan.show', compact('header','detail'));
    }
}
