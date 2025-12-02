<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class PasienPerawatController extends Controller
{
    public function index()
    {
        $pasien = Pet::with(['pemilik.user', 'dokter'])->get();
        return view('perawat.pasien.index', compact('pasien'));
    }

    public function detail($id)
    {
        $pet = Pet::with('ras', 'jenis', 'pemilik.user')->findOrFail($id);

        $rekamMedis = RekamMedis::where('idpet', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Tambahkan agar tidak error
        $kategori = KategoriKlinis::all();
        $tindakan = KodeTindakanTerapi::all();

        return view('perawat.pasien.detail', compact(
            'pet',
            'rekamMedis',
            'kategori',
            'tindakan'
        ));
    }

    public function storeRekamMedis(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'diagnosis' => 'required|string',
            'kategori_klinis' => 'required',
            'perawatan' => 'required',
            'catatan' => 'nullable'
        ]);

        RekamMedis::create([
            'idpet' => $id,
            'tanggal' => $request->tanggal,
            'judul' => $request->diagnosis,
            'catatan' => $request->catatan,
            'idkategori_klinis' => $request->kategori_klinis,
            'idkode_tindakan_terapi' => $request->perawatan,
            'dokter_pemeriksa' => session('idperawat')  // FIX DONE
        ]);

        return back()->with('success', 'Rekam medis berhasil ditambahkan');
    }


}
