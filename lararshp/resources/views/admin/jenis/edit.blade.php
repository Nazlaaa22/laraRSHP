@extends('layouts.lte.main')

@section('title', 'Edit Jenis Hewan')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 fw-bold">Edit Jenis Hewan</h3>
            </div>
            <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis.index') }}">Jenis Hewan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold">
            Form Edit Jenis Hewan
        </div>

        <div class="card-body">

            <form action="{{ route('admin.jenis.update', $jenis->idjenis_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Nama Jenis --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" class="form-control"
                        value="{{ old('nama_jenis_hewan', $jenis->nama_jenis_hewan) }}"
                        placeholder="Masukkan nama jenis hewan">

                    @error('nama_jenis_hewan')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.jenis.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button class="btn btn-warning text-white">
                        Perbarui
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
