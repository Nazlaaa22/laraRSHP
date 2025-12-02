<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temu = TemuDokter::with(['pet.pemilik.user'])
            ->orderBy('idreservasi_dokter','desc')
            ->get();

        return view('resepsionis.temudokter.index', compact('temu'));
    }

    public function edit($id)
    {
        $temu = TemuDokter::with('pet.pemilik.user')->findOrFail($id);

        // Ambil semua dokter berdasarkan role_id = 4 (dokter)
        $dokter = RoleUser::where('idrole', 4)->with('user')->get();

        return view('resepsionis.temudokter.edit', compact('temu', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        TemuDokter::where('idreservasi_dokter', $id)->update([
            'status' => $request->status,
            'iddokter' => $request->iddokter
        ]);

        return redirect()->route('resepsionis.temu.index')->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy($id)
    {
        TemuDokter::where('idreservasi_dokter', $id)->delete();
        return redirect()->route('resepsionis.temu.index')->with('success', 'Data berhasil dihapus!');
    }
}
