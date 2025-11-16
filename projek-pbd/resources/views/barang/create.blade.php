@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Tambah Barang</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            {{-- Jenis Barang --}}
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select name="jenis" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="a">Alat</option>
                    <option value="b">Bahan</option>
                    <option value="m">Makanan</option>
                    <option value="S">Sabun</option>
                </select>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            {{-- Status otomatis Aktif --}}
            <input type="hidden" name="status" value="1">

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
