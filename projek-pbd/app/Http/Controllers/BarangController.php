<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('barang')->orderBy('idbarang', 'asc')->get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric'
        ]);

        DB::table('barang')->insert([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => 1, 
            'created_at' => now()
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = DB::table('barang')->where('idbarang', $id)->first();
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        DB::table('barang')->where('idbarang', $id)->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => (int)$request->status
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');;
    }

    public function destroy($id)
    {
        DB::table('barang')->where('idbarang', $id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}

