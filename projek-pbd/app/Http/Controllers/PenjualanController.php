<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KartuStok;
use App\Models\DetailPenjualan;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.iduser', '=', 'user.iduser')
            ->select(
                'penjualan.idpenjualan',
                'user.username as nama_user',
                'penjualan.tanggal',
                'penjualan.total',
                'penjualan.status'
            )
            ->orderBy('penjualan.tanggal', 'desc')
            ->get();

        return view('penjualan.index', compact('penjualan'));
    }
    public function store(Request $request)
    {
        // 1️⃣ Simpan data penjualan utama
        $penjualan = Penjualan::create([
            'iduser' => auth()->user()->iduser,
            'tanggal' => now(),
            'status' => 'A',
        ]);

        // 2️⃣ Simpan detail penjualan (barang + jumlah)
        foreach ($request->barang as $index => $idbarang) {
            DetailPenjualan::create([
                'idpenjualan' => $penjualan->idpenjualan,
                'idbarang' => $idbarang,
                'jumlah' => $request->jumlah[$index],
                'subtotal' => $request->subtotal[$index],
            ]);

            // 3️⃣ Tambahkan otomatis ke kartu_stok (KELUAR)
            KartuStok::create([
                'idbarang' => $idbarang,
                'tanggal' => now(),
                'jenis_transaksi' => 'Keluar',
                'jumlah' => $request->jumlah[$index],
                'keterangan' => 'Penjualan ID: ' . $penjualan->idpenjualan,
            ]);
        }

        return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil disimpan dan kartu stok diperbarui.');
    }
}


