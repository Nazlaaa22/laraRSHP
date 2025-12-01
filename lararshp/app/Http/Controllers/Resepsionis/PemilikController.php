<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:5',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        // buat user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // buat pemilik
        Pemilik::create([
            'iduser' => $user->iduser,
            'alamat' => $request->alamat,
            'telp' => $request->telp
        ]);

        return redirect()->route('resepsionis.pemilik.index')
            ->with('success', 'Pemilik berhasil ditambah');
    }
}
