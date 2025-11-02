<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'barang' => DB::table('barang')->count(),
            'vendor' => DB::table('vendor')->count(),
            'satuan' => DB::table('satuan')->count(),
            'user' => DB::table('user')->count(),
            'role' => DB::table('role')->count(),
            'kartu_stok' => DB::table('kartu_stok')->count(),
        ];

        return view('home', compact('data'));
    }
}
