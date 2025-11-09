@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Tambah Ras Hewan</h3>

    <form action="{{ route('admin.ras.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_ras" class="form-label">Nama Ras</label>
            <input type="text" name="nama_ras" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idjenis_hewan" class="form-label">Jenis Hewan</label>
            <select name="idjenis_hewan" class="form-control" required>
                <option value="">Pilih Jenis Hewan</option>
                @foreach($jenis as $j)
                    <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
