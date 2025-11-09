<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $ras = RasHewan::with('jenisHewan')->get();
        return view('admin.ras.index', compact('ras'));
    }

    public function create()
    {
        $jenis = JenisHewan::all();
        return view('admin.ras.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        RasHewan::create([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);

        return redirect()->route('admin.ras.index')->with('success', 'Ras hewan berhasil ditambahkan!');
    }
}
