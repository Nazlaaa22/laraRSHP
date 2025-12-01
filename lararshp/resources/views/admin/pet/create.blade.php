@extends('layouts.lte.main')

@section('content')

<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
            <li class="breadcrumb-item active">Tambah Pet</li>
        </ol>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.pet.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Pet</label>
                <input type="text" name="nama_pet" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Hewan</label>
                <select name="idjenis_hewan" class="form-select" required>
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach ($jenis as $j)
                        <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ras Hewan</label>
                <select name="idras_hewan" class="form-select" required>
                    <option value="">-- Pilih Ras Hewan --</option>
                    @foreach ($ras as $r)
                        <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Umur (opsional)</label>
                <input type="number" name="umur" class="form-control" min="0">
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>

@endsection
