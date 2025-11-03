<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index() {
        $jenis = JenisHewan::all();
        return view('admin.jenis.index', compact('jenis'));
    }

    public function create() {
        return view('admin.jenis.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:50|unique:jenis_hewan,nama_jenis_hewan',
        ]);

        JenisHewan::create([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        return redirect()->route('admin.jenis.index')->with('success', 'Jenis Hewan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        return view('admin.jenis.edit', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100',
        ]);

        $jenis = JenisHewan::findOrFail($id);
        $jenis->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        return redirect()->route('admin.jenis.index')->with('success', 'Data jenis hewan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        $jenis->delete();

        return redirect()->route('admin.jenis.index')
                        ->with('success', 'Data jenis hewan berhasil dihapus!');
    }
}
