@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Dashboard Resepsionis</h2>

    <h4>Data Pendaftaran Pasien</h4>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID Pendaftaran</th>
            <th>Nama Hewan</th>
            <th>Pemilik</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
        </tr>
        @foreach($pendaftaran as $p)
        <tr>
            <td>{{ $p->idtemu_dokter }}</td>
            <td>{{ $p->pet->nama ?? '-' }}</td>
            <td>{{ $p->pet->pemilik->user->nama ?? '-' }}</td>
            <td>{{ $p->tanggal ?? '-' }}</td>
            <td>{{ $p->status ?? 'Belum Ditetapkan' }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
