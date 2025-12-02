@extends('layouts.resepsionis')

@section('title', 'Edit Pendaftaran Pasien')

@section('content')
<div class="container mt-4">

    <h3 class="fw-bold mb-4" style="color: var(--primary)">✏️ Edit Pendaftaran Pasien</h3>

    <div class="card shadow-sm p-4" style="border-radius: 18px;">

        <form action="{{ route('resepsionis.pendaftaran.update', $pendaftaran->idreservasi_dokter) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- PILIH HEWAN --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Hewan</label>
                <select name="idpet" class="form-select" required>
                    @foreach ($pets as $pet)
                        <option value="{{ $pet->idpet }}"
                            {{ $pet->idpet == $pendaftaran->idpet ? 'selected' : '' }}>
                            {{ $pet->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PILIH DOKTER --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Dokter</label>
                <select name="idrole_user" class="form-select" required>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->idrole_user }}"
                            {{ $d->idrole_user == $pendaftaran->idrole_user ? 'selected' : '' }}>
                            {{ $d->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NO URUT --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nomor Urut</label>
                <input type="number" 
                       name="no_urut" 
                       class="form-control" 
                       value="{{ $pendaftaran->no_urut }}" required>
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="2" {{ $pendaftaran->status == 2 ? 'selected' : '' }}>Menunggu</option>
                    <option value="0" {{ $pendaftaran->status == 0 ? 'selected' : '' }}>Belum Diproses</option>
                    <option value="1" {{ $pendaftaran->status == 1 ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            {{-- SUBMIT --}}
            <button class="btn btn-primary px-4">Update</button>
            <a href="{{ route('resepsionis.pendaftaran.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>
@endsection
