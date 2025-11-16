@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3>Tambah Kategori Klinis</h3>
    <form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis</label>
            <input type="text" name="nama_kategori_klinis" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
