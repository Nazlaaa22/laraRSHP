<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\KategoriKlinis;
use App\Models\DetailRekamMedis;
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
        $rekam = RekamMedis::create([
            'idpet' => $id,
            'tanggal' => $request->tanggal,
            'diagnosa' => $request->diagnosis,
            'anamnesa' => $request->catatan,
            'temuan_klinis' => null,
            'dokter_pemeriksa' => null,
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $rekam->idrekam_medis,
            'idkode_tindakan_terapi' => $request->perawatan,
        ]);

        return back()->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function show($id)
    {
        $rekam = RekamMedis::with('detail.tindakan')->findOrFail($id);
        return view('perawat.pasien.show_rekam', compact('rekam'));
    }

    public function edit($id)
    {
        $rekam = RekamMedis::with('detail.tindakan')->findOrFail($id);
        $kategori = KategoriKlinis::all();
        $tindakan = KodeTindakanTerapi::all();

        return view('perawat.pasien.edit_rekam', compact('rekam', 'kategori', 'tindakan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'diagnosa' => 'required|string',
            'perawatan' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->tanggal = $request->tanggal;
        $rekam->diagnosa = $request->diagnosa;
        $rekam->anamnesa = $request->catatan;
        $rekam->save();

        // Update tabel detail_rekam_medis
        DetailRekamMedis::updateOrCreate(
            ['idrekam_medis' => $rekam->idrekam_medis],
            ['idkode_tindakan_terapi' => $request->perawatan]
        );

        return redirect()->route('perawat.pasien.detail', $rekam->idpet)
                        ->with('success', 'Rekam medis berhasil diperbarui!');
    }

    public function delete($id)
    {
        DetailRekamMedis::where('idrekam_medis', $id)->delete();
        RekamMedis::where('idrekam_medis', $id)->delete();

        return back()->with('success', 'Rekam medis berhasil dihapus!');
    }

    public function deleteRekamMedis($id)
    {
        \App\Models\DetailRekamMedis::where('idrekam_medis', $id)->delete();

        \App\Models\RekamMedis::where('idrekam_medis', $id)->delete();

        return back()->with('success', 'Rekam medis berhasil dihapus');
    }


}
