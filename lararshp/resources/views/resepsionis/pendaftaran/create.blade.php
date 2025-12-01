@extends('layouts.resepsionis')
@section('title', 'Tambah Pendaftaran')

@section('content')
<h3 class="fw-bold mb-4">Tambah Pendaftaran</h3>

<form action="{{ route('resepsionis.pendaftaran.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih Hewan</label>
        <select name="idpet" class="form-select" required>
            @foreach($pet as $p)
                <option value="{{ $p->idpet }}">
                    {{ $p->nama }} - {{ $p->pemilik->user->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
