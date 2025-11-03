@extends('layouts.admin')
@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-bold">
            Tambah Jenis Hewan
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jenis.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" id="nama_jenis_hewan" 
                        class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                        placeholder="Masukkan nama jenis hewan"
                        value="{{ old('nama_jenis_hewan') }}">
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.jenis.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
