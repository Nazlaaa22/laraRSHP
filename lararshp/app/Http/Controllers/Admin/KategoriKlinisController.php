<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        KategoriKlinis::create([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori_klinis.index')
                         ->with('success', 'Kategori Klinis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategori_klinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->update([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori_klinis.index')
                         ->with('success', 'Kategori Klinis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori_klinis.index')
                         ->with('success', 'Kategori Klinis berhasil dihapus!');
    }
}
