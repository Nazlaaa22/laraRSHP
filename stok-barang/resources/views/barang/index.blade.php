@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Data Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">+ Tambah Barang</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->idbarang }}</td>
                <td>{{ $row->nama_barang }}</td>
                <td>{{ $row->nama_satuan }}</td>
                <td>{{ $row->stok }}</td>
                <td>{{ number_format($row->harga, 0, ',', '.') }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <a href="{{ route('barang.edit', $row->idbarang) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $row->idbarang) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
