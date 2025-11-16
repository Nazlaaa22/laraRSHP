<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = DB::table('vendor')
            ->select('idvendor', 'nama_vendor', 'badan_hukum', 'status')
            ->orderBy('nama_vendor', 'asc')
            ->get();

        return view('vendor.index', compact('vendor'));
    }
}
