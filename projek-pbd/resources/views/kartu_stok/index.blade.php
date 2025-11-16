@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Kartu Stok Barang</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stok as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>
                            @if ($item->jenis_transaksi == 'Masuk')
                                <span class="badge bg-success">Masuk</span>
                            @elseif ($item->jenis_transaksi == 'Keluar')
                                <span class="badge bg-danger">Keluar</span>
                            @else
                                <span class="badge bg-warning text-dark">Retur</span>
                            @endif
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada data kartu stok</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
