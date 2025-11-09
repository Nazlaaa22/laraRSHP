@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Ras Hewan</h3>

    <form action="{{ route('admin.ras.update', $ras->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_ras" class="form-label">Nama Ras</label>
            <input type="text" name="nama_ras" class="form-control" value="{{ $ras->nama_ras }}" required>
        </div>

        <div class="mb-3">
            <label for="id_jenis_hewan" class="form-label">Jenis Hewan</label>
            <select name="id_jenis_hewan" class="form-control" required>
                @foreach($jenis as $j)
                    <option value="{{ $j->id }}" {{ $ras->id_jenis_hewan == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jenis_hewan }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
