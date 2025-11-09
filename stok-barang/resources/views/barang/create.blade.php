@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Barang</h2>
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <select name="idsatuan" class="form-control">
                @foreach ($satuan as $s)
                    <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
