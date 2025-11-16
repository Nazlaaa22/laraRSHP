<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- DATA DASHBOARD ---
        $totalPenjualan = DB::table('penjualan')->count();
        $totalBarang    = DB::table('barang')->count();
        $totalVendor    = DB::table('vendor')->count();
        $nilaiPenjualan = DB::table('penjualan')->sum('total');

        // --- DATA LAPORAN (BULAN INI) ---
        $bulanIni = date('m');

        $lap_penjualan = DB::table('penjualan')
            ->whereMonth('tanggal', $bulanIni)
            ->count();

        $lap_pengadaan = DB::table('pengadaan')
            ->whereMonth('tanggal', $bulanIni)
            ->count();

        $lap_penerimaan = DB::table('penerimaan')
            ->whereMonth('tanggal', $bulanIni)
            ->count();

        $lap_retur = DB::table('retur')
            ->whereMonth('tanggal', $bulanIni)
            ->count();

        // --- Grafik: 6 bulan terakhir ---
        $grafik_bulan = [];
        $grafik_penjualan = [];

        for ($i = 5; $i >= 0; $i--) {

            $label = date('M Y', strtotime("-{$i} month"));
            $yearMonth = date('Y-m', strtotime("-{$i} month"));

            $grafik_bulan[] = $label;

            $totalP = DB::table('penjualan')
                ->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$yearMonth])
                ->sum('total');

            $grafik_penjualan[] = (int)$totalP;
        }

        // --- Distribusi barang (pie chart) ---
        $distribusi = DB::table('barang')
            ->select('jenis', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis')
            ->get()
            ->map(function ($r) {
                return ['jenis' => $r->jenis, 'jumlah' => (int)$r->jumlah];
            })
            ->toArray();

        // --- Penjualan terbaru (tabel) ---
        $penjualanTerbaru = DB::table('penjualan')
            ->join('user', 'penjualan.iduser', '=', 'user.iduser')
            ->select('penjualan.*', 'user.nama_lengkap')
            ->orderBy('penjualan.idpenjualan', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', [
            'totalPenjualan'   => $totalPenjualan,
            'totalBarang'      => $totalBarang,
            'totalVendor'      => $totalVendor,
            'nilaiPenjualan'   => $nilaiPenjualan,

            'lap_penjualan'    => $lap_penjualan,
            'lap_pengadaan'    => $lap_pengadaan,
            'lap_penerimaan'   => $lap_penerimaan,
            'lap_retur'        => $lap_retur,

            'grafik_bulan'     => $grafik_bulan,
            'grafik_penjualan' => $grafik_penjualan,

            'distribusi'       => $distribusi,
            'penjualanTerbaru' => $penjualanTerbaru,
        ]);
    }
}
