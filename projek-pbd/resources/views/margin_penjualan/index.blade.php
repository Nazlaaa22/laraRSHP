@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Margin Penjualan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Margin</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Persentase Margin</th>
                    <th>Perkiraan Harga Beli</th>
                    <th>Tanggal Berlaku</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($margin as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idmargin }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->persentase }}%</td>
                        <td>Rp{{ number_format($item->perkiraan_harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $item->tanggal_berlaku }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada data margin penjualan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
