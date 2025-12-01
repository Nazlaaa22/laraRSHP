<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class TindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakan = TindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.tindakan_terapi.index', compact('tindakan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();

        return view('admin.tindakan_terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'deskripsi_tindakan_terapi' => 'nullable|string|max:1000',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer',
        ]);

        TindakanTerapi::create($request->all());

        return redirect()->route('admin.tindakan_terapi.index')
            ->with('success', 'Tindakan Terapi berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $tindakan = TindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();

        return view('admin.tindakan_terapi.edit', compact('tindakan', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $tindakan = TindakanTerapi::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:10|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'nullable|string|max:255',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer',
        ]);

        $tindakan->update([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.tindakan_terapi.index')
                         ->with('success', 'Tindakan terapi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tindakan = TindakanTerapi::findOrFail($id);
        $tindakan->delete();

        return redirect()->route('admin.tindakan_terapi.index')
                         ->with('success', 'Tindakan terapi berhasil dihapus!');
    }
}
