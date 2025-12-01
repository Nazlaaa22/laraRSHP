@extends('layouts.lte.main')

@section('content')

<div class="app-content">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Tambah Kategori Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori Hewan</a></li>
                <li class="breadcrumb-item active">Tambah Kategori Hewan</li>
            </ol>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                {{-- INPUT --}}
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" 
                           name="nama_kategori" 
                           id="nama_kategori"
                           class="form-control @error('nama_kategori') is-invalid @enderror"
                           placeholder="Masukkan nama kategori"
                           value="{{ old('nama_kategori') }}"
                           required>

                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
