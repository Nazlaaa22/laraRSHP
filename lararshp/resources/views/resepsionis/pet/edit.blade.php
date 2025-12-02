@extends('layouts.resepsionis')

@section('content')
<h3 class="mb-4">Edit Data Hewan</h3>

<a href="{{ route('resepsionis.pet.index') }}" class="btn btn-secondary mb-3">⬅ Kembali</a>

<form action="{{ route('resepsionis.pet.update', $pet->idpet) }}" method="POST">
    @csrf
    @method('PUT')

    <h5>Data Hewan</h5>
    <div class="mb-3">
        <label>Nama Hewan</label>
        <input type="text" name="nama" value="{{ $pet->nama }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $pet->tanggal_lahir }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Warna / Tanda Khusus</label>
        <input type="text" name="warna_tanda" value="{{ $pet->warna_tanda }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
            <option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Ras Hewan</label>
        <select name="idras_hewan" class="form-control" required>
            @foreach ($ras as $r)
                <option value="{{ $r->idras_hewan }}" {{ $pet->idras_hewan == $r->idras_hewan ? 'selected' : '' }}>
                    {{ $r->nama_ras }}
                </option>
            @endforeach
        </select>
    </div>

    <hr>
    <h5>Data Pemilik</h5>

    <div class="mb-3">
        <label>Nama Pemilik</label>
        <input type="text" name="nama_pemilik" value="{{ $pet->pemilik->nama }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $pet->pemilik->user->email ?? '' }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>No Wa</label>
        <input type="text" name="no_wa" value="{{ $pet->pemilik->no_wa }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $pet->pemilik->alamat }}</textarea>
    </div>

    <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
</form>
@endsection
