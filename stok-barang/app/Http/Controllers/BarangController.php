<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // 🔹 Menampilkan seluruh data barang
    public function index(Request $request)
    {
        $query = DB::table('barang')
            ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
            ->select(
                'barang.idbarang',
                'barang.jenis',
                'barang.nama',
                'barang.stok',
                'barang.harga',
                'barang.status',
                'satuan.nama_satuan'
            )
            ->orderBy('barang.idbarang', 'asc');

        // filter status aktif/tidak aktif
        if ($request->status !== null && $request->status !== '') {
            $query->where('barang.status', $request->status);
        }

        $data = $query->get();
        return view('barang.index', compact('data'));
    }

    // 🔹 Form untuk tambah barang
    public function create()
    {
        $satuan = DB::table('satuan')->get();
        return view('barang.create', compact('satuan'));
    }

    // 🔹 Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'idsatuan'    => 'required',
            'stok'        => 'required|integer',
            'harga'       => 'required|numeric',
            'status'      => 'required'
        ]);

        DB::table('barang')->insert([
            'jenis'     => substr($request->nama_barang, 0, 1), // otomatis isi huruf pertama dari nama
            'nama'      => $request->nama_barang,
            'idsatuan'  => $request->idsatuan,
            'stok'      => $request->stok,
            'harga'     => $request->harga,
            'status'    => (int) $request->status, // ubah ke angka (0/1)
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    // 🔹 Form edit barang
    public function edit($id)
    {
        $barang = DB::table('barang')
            ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
            ->select(
                'barang.idbarang',
                'barang.jenis',
                'barang.nama AS nama_barang', 
                'barang.stok',
                'barang.harga',
                'barang.status',
                'barang.idsatuan',
                'satuan.nama_satuan'
            )
            ->where('barang.idbarang', $id)
            ->first();

        $satuan = DB::table('satuan')->get();
        return view('barang.edit', compact('barang', 'satuan'));
    }

    // 🔹 Update data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'idsatuan'    => 'required',
            'stok'        => 'required|integer',
            'harga'       => 'required|numeric',
            'status'      => 'required'
        ]);

        DB::table('barang')->where('idbarang', $id)->update([
            'jenis'     => substr($request->nama_barang, 0, 1), // otomatis update jenis juga
            'nama'      => $request->nama_barang,
            'idsatuan'  => $request->idsatuan,
            'stok'      => $request->stok,
            'harga'     => $request->harga,
            'status'    => (int) $request->status,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui!');
    }

    // 🔹 Hapus barang
    public function destroy($id)
    {
        DB::table('barang')->where('idbarang', $id)->delete();
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }
}
