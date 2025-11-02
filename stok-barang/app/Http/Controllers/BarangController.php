<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // 🔹 Menampilkan seluruh data barang
    public function index()
    {
        $data = DB::table('barang')
            ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
            ->select(
                'barang.idbarang',
                'barang.nama',
                'barang.status',
                'barang.stok',
                'satuan.nama_satuan'
            )
            ->get();

        return view('barang.index', compact('data'));
    }

    // 🔹 Form untuk tambah barang
    public function create()
    {
        $satuan = DB::table('satuan')->get();
        return view('barang.create', compact('satuan'));
    }

    // 🔹 Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'idsatuan' => 'required',
            'stok' => 'required|integer',
            'status' => 'required'
        ]);

        DB::table('barang')->insert([
            'nama' => $request->nama,
            'idsatuan' => $request->idsatuan,
            'stok' => $request->stok,
            'status' => $request->status,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    // 🔹 Form edit barang
    public function edit($id)
    {
        $barang = DB::table('barang')->where('idbarang', $id)->first();
        $satuan = DB::table('satuan')->get();

        return view('barang.edit', compact('barang', 'satuan'));
    }

    // 🔹 Update data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'idsatuan' => 'required',
            'stok' => 'required|integer',
            'status' => 'required'
        ]);

        DB::table('barang')->where('idbarang', $id)->update([
            'nama' => $request->nama,
            'idsatuan' => $request->idsatuan,
            'stok' => $request->stok,
            'status' => $request->status,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui!');
    }

    // 🔹 Hapus barang
    public function destroy($id)
    {
        DB::table('barang')->where('idbarang', $id)->delete();
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }
}
