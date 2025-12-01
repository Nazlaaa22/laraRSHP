@extends('layouts.lte.main')

@section('content')

<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Tindakan Terapi</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tindakan_terapi.index') }}">Tindakan Terapi</a></li>
            <li class="breadcrumb-item active">Tambah Tindakan Terapi</li>
        </ol>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.tindakan_terapi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Kode Tindakan</label>
                <input type="text" name="kode" class="form-control" 
                       placeholder="Contoh: T001" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi Tindakan</label>
                <textarea name="deskripsi_tindakan_terapi" class="form-control" rows="3"
                          placeholder="Opsional — isi deskripsi tindakan"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <select name="idkategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kategori Klinis</label>
                <select name="idkategori_klinis" class="form-select" required>
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach($kategoriKlinis as $kk)
                        <option value="{{ $kk->idkategori_klinis }}">
                            {{ $kk->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.tindakan_terapi.index') }}" 
                   class="btn btn-secondary">Kembali</a>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>

@endsection
