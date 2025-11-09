@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold">Edit Kategori</div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
