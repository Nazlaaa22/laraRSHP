<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with('pemilik')->get();
        return view('resepsionis.pet.index', compact('pet'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pet.create', compact('pemilik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'ras' => 'required',
            'idpemilik' => 'required'
        ]);

        Pet::create($request->all());

        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Pet berhasil ditambahkan');
    }
}
