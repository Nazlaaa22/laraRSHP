@extends('layouts.resepsionis')
@section('title','Pendaftaran Pasien')

@section('content')
<h3 class="fw-bold mb-4">Data Pendaftaran Pasien</h3>

<a href="{{ route('resepsionis.pendaftaran.create') }}" class="btn btn-primary mb-3">+ Tambah Pendaftaran</a>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Nama Hewan</th>
            <th>Pemilik</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendaftaran as $p)
        <tr>
            <td>{{ $p->idreservasi_dokter }}</td>
            <td>{{ $p->pet->nama }}</td>
            <td>{{ $p->pet->pemilik->user->nama }}</td>
            <td>{{ $p->waktu_daftar }}</td>
            <td>
                @if($p->status == 1)
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
