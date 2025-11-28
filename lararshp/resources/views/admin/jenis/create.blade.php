@extends('layouts.lte.main')

@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 fw-bold">Tambah Jenis Hewan</h3>
            </div>
            <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis.index') }}">Jenis Hewan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-bold">
            Form Tambah Jenis Hewan
        </div>

        <div class="card-body">

            <form action="{{ route('admin.jenis.store') }}" method="POST">
                @csrf

                {{-- Input Nama Jenis --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jenis Hewan</label>
                    <input type="text" 
                           name="nama_jenis_hewan"
                           class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                           placeholder="Masukkan nama jenis hewan"
                           value="{{ old('nama_jenis_hewan') }}">
                    
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.jenis.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
