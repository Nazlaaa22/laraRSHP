<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TindakanTerapi;

class TindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakan = TindakanTerapi::all();
        return view('admin.tindakan_terapi.index', compact('tindakan'));
    }

    public function create()
    {
        return view('admin.tindakan_terapi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:150|unique:tindakan_terapi,nama_tindakan',
            'deskripsi' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        TindakanTerapi::create([
            'nama_tindakan' => $request->nama_tindakan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.tindakan_terapi.index')
                         ->with('success', 'Tindakan Terapi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tindakan = TindakanTerapi::findOrFail($id);
        return view('admin.tindakan_terapi.edit', compact('tindakan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $tindakan = TindakanTerapi::findOrFail($id);

        $tindakan->update([
            'nama_tindakan' => $request->nama_tindakan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.tindakan_terapi.index')
                         ->with('success', 'Tindakan Terapi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tindakan = TindakanTerapi::findOrFail($id);
        $tindakan->delete();

        return redirect()->route('admin.tindakan_terapi.index')
                         ->with('success', 'Tindakan Terapi berhasil dihapus!');
    }
}
