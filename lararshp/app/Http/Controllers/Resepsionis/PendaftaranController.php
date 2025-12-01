<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;

class PendaftaranController extends Controller
{
    // =========================
    // LIST PENDAFTARAN PASIEN
    // =========================
    public function index()
    {
        $pendaftaran = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('idtemu_dokter', 'DESC')
            ->get();

        return view('resepsionis.pendaftaran.index', compact('pendaftaran'));
    }

    // =========================
    // FORM TAMBAH PENDAFTARAN
    // =========================
    public function create()
    {
        $pet = Pet::with('pemilik.user')->get();
        $dokter = Dokter::with('user')->get();

        return view('resepsionis.pendaftaran.create', compact('pet', 'dokter'));
    }

    // =========================
    // SIMPAN DATA PENDAFTARAN
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required',
            'iddokter' => 'required',
            'tanggal' => 'required|date',
            'keluhan' => 'required'
        ]);

        TemuDokter::create([
            'idpet' => $request->idpet,
            'iddokter' => $request->iddokter,
            'tanggal' => $request->tanggal,
            'keluhan' => $request->keluhan,
            'status' => 0 // default: belum diproses
        ]);

        return redirect()->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    // =========================
    // FORM EDIT PENDAFTARAN
    // =========================
    public function edit($id)
    {
        $pendaftaran = TemuDokter::findOrFail($id);
        $pet = Pet::with('pemilik.user')->get();
        $dokter = Dokter::with('user')->get();

        return view('resepsionis.pendaftaran.edit', compact('pendaftaran', 'pet', 'dokter'));
    }

    // =========================
    // UPDATE PENDAFTARAN
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet' => 'required',
            'iddokter' => 'required',
            'tanggal' => 'required|date',
            'keluhan' => 'required',
            'status' => 'required'
        ]);

        TemuDokter::findOrFail($id)->update([
            'idpet' => $request->idpet,
            'iddokter' => $request->iddokter,
            'tanggal' => $request->tanggal,
            'keluhan' => $request->keluhan,
            'status' => $request->status
        ]);

        return redirect()->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil diperbarui');
    }

    // =========================
    // HAPUS PENDAFTARAN
    // =========================
    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();

        return redirect()->route('resepsionis.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus');
    }
}
