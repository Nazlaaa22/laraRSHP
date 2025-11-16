@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Edit Barang</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ old('nama', $barang->nama) }}" required>
            </div>

            {{-- Jenis Barang --}}
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select name="jenis" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="a" {{ $barang->jenis == 'a' ? 'selected' : '' }}>Alat</option>
                    <option value="b" {{ $barang->jenis == 'b' ? 'selected' : '' }}>Bahan</option>
                    <option value="m" {{ $barang->jenis == 'm' ? 'selected' : '' }}>Makanan</option>
                    <option value="S" {{ $barang->jenis == 'S' ? 'selected' : '' }}>Sabun</option>
                </select>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="{{ old('stok', $barang->stok) }}" required>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control"
                       value="{{ old('harga', $barang->harga) }}" required>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="A" {{ $barang->status == 'A' ? 'selected' : '' }}>Aktif</option>
                    <option value="N" {{ $barang->status == 'N' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
