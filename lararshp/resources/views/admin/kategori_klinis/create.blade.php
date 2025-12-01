@extends('layouts.lte.main')

@section('content')

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Tambah Kategori Klinis</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kategori_klinis.index') }}">Kategori Klinis</a></li>
                <li class="breadcrumb-item active">Tambah Kategori Klinis</li>
            </ol>
        </div>
    </div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Kategori Klinis</label>
                <input type="text" 
                       name="nama_kategori_klinis" 
                       class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                       placeholder="Masukkan nama kategori klinis"
                       value="{{ old('nama_kategori_klinis') }}"
                       required>
                @error('nama_kategori_klinis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi (opsional)</label>
                <textarea name="deskripsi" class="form-control" rows="3"
                          placeholder="Masukkan deskripsi kategori klinis">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>

@endsection
