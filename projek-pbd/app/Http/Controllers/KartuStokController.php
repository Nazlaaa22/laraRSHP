<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function index()
    {
        $stok = DB::table('kartu_stok')
            ->join('barang', 'kartu_stok.idbarang', '=', 'barang.idbarang')
            ->select(
                'kartu_stok.idkartu_stok',
                'barang.nama as nama_barang',
                'kartu_stok.tanggal',
                'kartu_stok.jenis_transaksi',
                'kartu_stok.jumlah',
                'kartu_stok.keterangan'
            )
            ->orderBy('kartu_stok.tanggal', 'desc')
            ->get();

        return view('kartu_stok.index', compact('stok'));
    }
}
