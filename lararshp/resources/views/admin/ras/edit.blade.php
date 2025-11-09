@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-primary mb-4">✏️ Edit Ras Hewan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.ras.update', $ras->idras_hewan) }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_ras" class="form-label fw-semibold">Nama Ras</label>
            <input type="text" 
                   name="nama_ras" 
                   class="form-control" 
                   value="{{ old('nama_ras', $ras->nama_ras) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="idjenis_hewan" class="form-label fw-semibold">Jenis Hewan</label>
            <select name="idjenis_hewan" class="form-select" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                @foreach($jenis as $j)
                    <option value="{{ $j->idjenis_hewan }}" 
                        {{ $ras->idjenis_hewan == $j->idjenis_hewan ? 'selected' : '' }}>
                        {{ $j->nama_jenis_hewan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
            <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary px-4">← Kembali</a>
        </div>
    </form>
</div>
@endsection
