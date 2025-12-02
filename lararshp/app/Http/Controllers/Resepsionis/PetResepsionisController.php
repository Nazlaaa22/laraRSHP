<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;

class PetResepsionisController extends Controller
{
    public function index()
    {
        $pet = Pet::with('pemilik')->get();
        return view('resepsionis.pet.index', compact('pet'));
    }

    public function create()
    {
        $pemilik = Pemilik::all();
        $jenis = \App\Models\JenisHewan::all();
        $ras = \App\Models\RasHewan::all();

        return view('resepsionis.pet.create', compact('pemilik', 'jenis', 'ras'));
    }

    public function store(Request $request)
    {
    // 1. Validasi
    $request->validate([
        'nama_hewan' => 'required',
        'idras_hewan' => 'required',
        'tanggal_lahir' => 'required',
        'warna_tanda' => 'required',
        'jenis_kelamin' => 'required',
        'nama_pemilik' => 'required',
        'email' => 'required|email|unique:user,email',
        'password' => 'required|min:6',
        'no_wa' => 'required',
        'alamat' => 'required',
    ]);

    // 2. Buat user untuk login pemilik
    $user = \App\Models\User::create([
        'nama' => $request->nama_pemilik,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // 3. Buat record pemilik
    $pemilik = Pemilik::create([
        'iduser' => $user->iduser,
        'no_wa' => $request->no_wa,
        'alamat' => $request->alamat,
    ]);

    // 4. Buat record pet
    Pet::create([
        'nama' => $request->nama_hewan,
        'tanggal_lahir' => $request->tanggal_lahir,
        'warna_tanda' => $request->warna_tanda,
        'jenis_kelamin' => $request->jenis_kelamin,
        'idras_hewan' => $request->idras_hewan,
        'idpemilik' => $pemilik->idpemilik,
    ]);

    return redirect()->route('resepsionis.pet.index')->with('success', 'Pet berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $ras = \App\Models\RasHewan::all(); // <— ini yang kurang
        $pemilik = Pemilik::find($pet->idpemilik);

        return view('resepsionis.pet.edit', compact('pet', 'pemilik', 'ras'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $pet->update([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'ras'       => $request->ras,
            'idpemilik' => $request->idpemilik,
        ]);

        return redirect()->route('resepsionis.pet.index')->with('success', 'Pet berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pet::destroy($id);

        return redirect()->route('resepsionis.pet.index')->with('success', 'Pet berhasil dihapus!');
    }

    public function getRas($idjenis)
    {
        $ras = \App\Models\RasHewan::where('idjenis_hewan', $idjenis)->get();
        return response()->json($ras);
    }
}
