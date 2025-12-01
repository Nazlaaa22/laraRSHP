@extends('layouts.lte.main')

@section('content')

<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Role</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
            <li class="breadcrumb-item active">Edit Role</li>
        </ol>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Role</label>
                <input type="text" name="nama_role"
                       class="form-control @error('nama_role') is-invalid @enderror"
                       value="{{ old('nama_role', $role->nama_role) }}">

                @error('nama_role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.role.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-warning text-white">Perbarui</button>
            </div>

        </form>

    </div>
</div>

@endsection
