@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3>Edit Kategori Klinis</h3>
    <form action="{{ route('admin.kategori_klinis.update', $kategoriKlinis->idkategori_klinis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis</label>
            <input type="text" name="nama_kategori_klinis" class="form-control" value="{{ $kategoriKlinis->nama_kategori_klinis }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $kategoriKlinis->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
