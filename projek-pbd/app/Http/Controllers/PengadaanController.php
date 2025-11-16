<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PengadaanController extends Controller
{
    protected function detectNameColumn(string $table)
    {
        $cols = Schema::getColumnListing($table);

        // Kandidat nama yang umum
        $candidates = [
            'nama', 'name', 'nama_vendor', 'namavendor', 'vendor_nama',
            'username', 'user_name', 'full_name', 'fullname', 'nama_user'
        ];

        foreach ($candidates as $cand) {
            foreach ($cols as $col) {
                if (strtolower($col) === strtolower($cand)) {
                    return $col;
                }
            }
        }

        // Jika tidak ditemukan kandidat, kembalikan kolom kedua (jika ada)
        // atau primary key sebagai fallback
        if (count($cols) > 1) {
            // biasanya kolom ke-1 adalah id, jadi ambil kolom ke-2
            return $cols[1];
        }

        // fallback extreme: kolom pertama
        return $cols[0] ?? null;
    }

    public function index()
    {
        // deteksi kolom "nama" untuk vendor dan user
        $vendorNameCol = $this->detectNameColumn('vendor');
        $userNameCol   = $this->detectNameColumn('user');

        // jika deteksi gagal (sangat tidak mungkin), kembalikan view kosong + pesan
        if (!$vendorNameCol || !$userNameCol) {
            return view('pengadaan.index', [
                'pengadaan' => collect(),
                'error' => 'Gagal mendeteksi kolom nama pada tabel vendor atau user. Cek struktur tabel.'
            ]);
        }

        // build select string dengan aman (mencegah SQL injection karena nama kolom berasal dari introspeksi)
        $selectRaw = "pengadaan.idpengadaan, vendor.`{$vendorNameCol}` as nama_vendor, user.`{$userNameCol}` as nama_user, pengadaan.tanggal, pengadaan.status";

        $pengadaan = DB::table('pengadaan')
            ->join('user', 'pengadaan.iduser', '=', 'user.iduser')
            ->join('vendor', 'pengadaan.idvendor', '=', 'vendor.idvendor')
            ->selectRaw($selectRaw)
            ->orderBy('pengadaan.tanggal', 'desc')
            ->get();

        return view('pengadaan.index', compact('pengadaan'));
    }

    public function show($id)
    {
        // Ambil data pengadaan berdasarkan ID
        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.idvendor', '=', 'vendor.idvendor')
            ->join('user', 'pengadaan.iduser', '=', 'user.iduser')
            ->select('pengadaan.*', 'vendor.namavendor', 'user.username')
            ->where('pengadaan.idpengadaan', $id)
            ->first();

        // Ambil data detail pengadaannya
        $detail = DB::table('detail_pengadaan')
            ->join('barang', 'detail_pengadaan.idbarang', '=', 'barang.idbarang')
            ->select('detail_pengadaan.*', 'barang.nama as nama_barang', 'barang.harga')
            ->where('detail_pengadaan.idpengadaan', $id)
            ->get();

        return view('pengadaan.detail', compact('pengadaan', 'detail'));
    }

}
