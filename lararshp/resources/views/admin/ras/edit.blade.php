@extends('layouts.lte.main')

@section('content')

<div class="app-content">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit Ras Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.ras.index') }}">Ras Hewan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.ras.update', $ras->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- INPUT NAMA RAS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ras</label>
                    <input type="text" 
                           name="nama_ras"
                           class="form-control @error('nama_ras') is-invalid @enderror"
                           value="{{ old('nama_ras', $ras->nama_ras) }}"
                           placeholder="Masukkan nama ras hewan"
                           required>

                    @error('nama_ras')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SELECT JENIS HEWAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Hewan</label>
                    <select name="idjenis_hewan"
                            class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                            required>
                        <option value="">Pilih Jenis Hewan</option>

                        @foreach($jenis as $j)
                            <option value="{{ $j->idjenis_hewan }}"
                                {{ $ras->idjenis_hewan == $j->idjenis_hewan ? 'selected' : '' }}>
                                {{ $j->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>

                    @error('idjenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TOMBOL --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary me-2">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
