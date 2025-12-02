@extends('layouts.resepsionis')
@section('title', 'Edit Temu Dokter')

@section('content')

<div class="container mt-4">

    <h3 class="fw-bold mb-4" style="color: var(--primary)">✏️ Edit Temu Dokter</h3>

    <div class="card shadow-sm p-4" style="border-radius: 18px;">
        <form action="{{ route('resepsionis.temu.update', $temu->idreservasi_dokter) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- PILIH HEWAN --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Hewan</label>
                <input type="text" class="form-control" value="{{ $temu->pet->nama }}" disabled>
            </div>

            {{-- PEMILIK --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Pemilik</label>
                <input type="text" class="form-control"
                       value="{{ $temu->pet->pemilik->user->nama ?? '-' }}" disabled>
            </div>

            {{-- DOKTER --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Dokter</label>
                <select name="idrole_user" class="form-select" required>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->idrole_user }}"
                            {{ $temu->idrole_user == $d->idrole_user ? 'selected' : '' }}>
                            {{ $d->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="0" {{ $temu->status == 0 ? 'selected' : '' }}>Belum Diproses</option>
                    <option value="2" {{ $temu->status == 2 ? 'selected' : '' }}>Menunggu</option>
                    <option value="1" {{ $temu->status == 1 ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('resepsionis.temu.index') }}" class="btn btn-secondary px-4">Kembali</a>
                <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>

@endsection
