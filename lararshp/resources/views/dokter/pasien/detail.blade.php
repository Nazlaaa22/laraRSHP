@extends('layouts.dokter')

@section('content')
<div class="card p-4">
    <h3>{{ $pet->nama }}</h3>
    <p><strong>Ras:</strong> {{ $pet->nama_ras }}</p>
    <p><strong>Jenis:</strong> {{ $pet->nama_jenis_hewan }}</p>
    <p><strong>Umur:</strong> {{ $pet->umur }} tahun</p>
    <p><strong>Pemilik:</strong> {{ $pet->nama_pemilik }} - {{ $pet->no_wa }}</p>
    <p><strong>Alamat:</strong> {{ $pet->alamat }}</p>

    <a href="{{ route('dokter.pasien') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
