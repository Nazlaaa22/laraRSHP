@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Barang</h2>
    <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <select name="idsatuan" class="form-control">
                @foreach ($satuan as $s)
                    <option value="{{ $s->idsatuan }}" {{ $barang->idsatuan == $s->idsatuan ? 'selected' : '' }}>
                        {{ $s->nama_satuan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Y" {{ $barang->status == 'Y' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ $barang->status == 'N' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
