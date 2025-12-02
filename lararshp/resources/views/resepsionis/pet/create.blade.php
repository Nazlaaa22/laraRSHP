@extends('layouts.resepsionis')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Tambah Data Hewan</h3>

    <form action="{{ route('resepsionis.pet.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Hewan</label>
            <input type="text" name="nama_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Warna / Tanda Khusus</label>
            <input type="text" name="warna_tanda" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="J">Jantan</option>
                <option value="B">Betina</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ras Hewan</label>
            <select name="idras_hewan" class="form-select" required>
                <option value="">-- Pilih Ras --</option>
                @foreach($ras as $r)
                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h5 class="fw-bold mt-4">Data Pemilik</h5>

        <div class="mb-3">
            <label class="form-label">Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Pemilik</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Login</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No. WA</label>
            <input type="text" name="no_wa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
