@extends('layouts.lte.main')

@section('content')

<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Pet</label>
                <input type="text" name="nama_pet" class="form-control"
                       value="{{ $pet->nama_pet }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Jantan" {{ $pet->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ $pet->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Hewan</label>
                <select name="idjenis_hewan" class="form-select" required>
                    @foreach ($jenis as $j)
                        <option value="{{ $j->idjenis_hewan }}"
                            {{ $pet->idjenis_hewan == $j->idjenis_hewan ? 'selected' : '' }}>
                            {{ $j->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ras Hewan</label>
                <select name="idras_hewan" class="form-select" required>
                    @foreach ($ras as $r)
                        <option value="{{ $r->idras_hewan }}"
                            {{ $pet->idras_hewan == $r->idras_hewan ? 'selected' : '' }}>
                            {{ $r->nama_ras }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="number" name="umur" class="form-control"
                       value="{{ $pet->umur }}" min="0">
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>

@endsection
