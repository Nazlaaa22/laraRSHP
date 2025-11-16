<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    public function index()
    {
        $margin = DB::table('margin_penjualan')
            ->join('barang', 'margin_penjualan.idbarang', '=', 'barang.idbarang')
            ->select(
                'margin_penjualan.idmargin',
                'barang.nama as nama_barang',
                'barang.harga as harga_jual', // karena kolomnya 'harga'
                'margin_penjualan.persentase',
                DB::raw('(barang.harga - (barang.harga / (1 + (margin_penjualan.persentase / 100)))) as perkiraan_harga_beli'),
                'margin_penjualan.tanggal_berlaku'
            )
            ->orderBy('margin_penjualan.tanggal_berlaku', 'desc')
            ->get();

        return view('margin_penjualan.index', compact('margin'));
    }
}
