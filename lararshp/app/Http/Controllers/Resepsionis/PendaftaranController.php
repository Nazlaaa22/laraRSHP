<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = TemuDokter::with(['pet.pemilik.user'])
            ->orderBy('idreservasi_dokter', 'desc')
            ->get();

        return view('resepsionis.pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        $pets = Pet::all();
        $dokter = RoleUser::where('idrole', 2)->with('user')->get(); // ambil user yang rolenya dokter

        return view('resepsionis.pendaftaran.create', compact('pets', 'dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required',
            'idrole_user' => 'required',
            'no_urut' => 'required|numeric',
        ]);

        TemuDokter::create([
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user, // Dokter dipilih
            'no_urut' => $request->no_urut,
            'status' => 2, // Menunggu
        ]);

        return redirect()
            ->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pendaftaran = TemuDokter::findOrFail($id);
        $pets = Pet::all();
        $dokter = RoleUser::where('idrole', 2)->with('user')->get();

        return view('resepsionis.pendaftaran.edit', compact('pendaftaran', 'pets', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet' => 'required',
            'idrole_user' => 'required',
            'no_urut' => 'required|numeric',
            'status' => 'required',
        ]);

        TemuDokter::where('idreservasi_dokter', $id)->update([
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
            'no_urut' => $request->no_urut,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        TemuDokter::where('idreservasi_dokter', $id)->delete();

        return redirect()
            ->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus!');
    }
}
