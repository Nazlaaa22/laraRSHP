<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class PetController extends Controller
{
    // ===========================
    // INDEX
    // ===========================
    public function index()
    {
        $pet = Pet::with(['jenisHewan', 'rasHewan'])->get();

        return view('admin.pet.index', compact('pet'));
    }

    // ===========================
    // CREATE
    // ===========================
    public function create()
    {
        $jenis = JenisHewan::all();
        $ras = RasHewan::all();

        return view('admin.pet.create', compact('jenis', 'ras'));
    }

    // ===========================
    // STORE
    // ===========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_pet' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'umur' => 'nullable|numeric|min:0'
        ]);

        Pet::create([
            'nama_pet' => $request->nama_pet,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idjenis_hewan' => $request->idjenis_hewan,
            'idras_hewan' => $request->idras_hewan,
            'umur' => $request->umur,
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil ditambahkan!');
    }

    // ===========================
    // EDIT
    // ===========================
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $jenis = JenisHewan::all();
        $ras = RasHewan::all();

        return view('admin.pet.edit', compact('pet', 'jenis', 'ras'));
    }

    // ===========================
    // UPDATE
    // ===========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pet' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'umur' => 'nullable|numeric|min:0'
        ]);

        $pet = Pet::findOrFail($id);

        $pet->update([
            'nama_pet' => $request->nama_pet,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idjenis_hewan' => $request->idjenis_hewan,
            'idras_hewan' => $request->idras_hewan,
            'umur' => $request->umur,
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil diperbarui!');
    }

    // ===========================
    // DESTROY
    // ===========================
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil dihapus!');
    }
}
