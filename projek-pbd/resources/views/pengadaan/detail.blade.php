@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Detail Pengadaan</h2>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5>Informasi Pengadaan</h5>
        <p><strong>ID Pengadaan:</strong> {{ $pengadaan->idpengadaan }}</p>
        <p><strong>Vendor:</strong> {{ $pengadaan->namavendor ?? '-' }}</p>
        <p><strong>User:</strong> {{ $pengadaan->username ?? '-' }}</p>
        <p><strong>Tanggal:</strong> {{ $pengadaan->tanggal }}</p>
        <p><strong>Status:</strong> {{ $pengadaan->status }}</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5>Daftar Barang yang Dipesan</h5>
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($row->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada barang di pengadaan ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
