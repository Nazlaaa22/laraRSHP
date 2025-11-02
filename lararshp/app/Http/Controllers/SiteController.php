<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        // Jika file kamu ada di resources/views/site/home.blade.php
        return view('site.home');
    }

    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return "Koneksi ke database BERHASIL!";
        } catch (\Exception $e) {
            return "Koneksi ke database GAGAL: " . $e->getMessage();
        }
    }

    public function layanan()
    {
        return view('site.layanan');
    }

    public function kontak()
    {
        return view('site.kontak');
    }

    public function struktur()
    {
        return view('site.struktur');
    }



}
