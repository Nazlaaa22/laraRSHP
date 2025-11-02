<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ✅ Halaman dashboard utama (menu 8 tabel)
    public function index()
    {
        return view('admin.dashboard');
    }

    // ✅ 1. Daftar Jenis Hewan
    public function jenis()
    {
        $data = DB::table('jenis_hewan')->get();
        return view('admin.jenis', ['data' => $data]);
    }

    // ✅ 2. Daftar Ras Hewan
    public function ras()
    {
        $data = DB::table('ras_hewan')->get();
        return view('admin.ras', ['data' => $data]);
    }

    // ✅ 3. Daftar Kategori
    public function kategori()
    {
        $data = DB::table('kategori')->get();
        return view('admin.kategori', ['data' => $data]);
    }

    // ✅ 4. Daftar Kategori Klinis
    public function kategoriKlinis()
    {
        $data = DB::table('kategori_klinis')->get();
        return view('admin.kategori_klinis', ['data' => $data]);
    }

    // ✅ 5. Daftar Kode Tindakan Terapi
    public function tindakanTerapi()
    {
        $data = DB::table('kode_tindakan_terapi')->get();
        return view('admin.tindakan_terapi', ['data' => $data]);
    }

    // ✅ 6. Daftar Pet
    public function pet()
    {
        $data = DB::table('pet')->get();
        return view('admin.pet', ['data' => $data]);
    }

    // ✅ 7. Daftar Role
    public function role()
    {
        $data = DB::table('role')->get();
        return view('admin.role', ['data' => $data]);
    }

    // ✅ 8. Daftar User + Role
    public function user()
    {
        $data = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->select('user.iduser', 'user.nama', 'user.email', 'role.nama_role')
            ->get();

        return view('admin.user', ['data' => $data]);
    }
}
