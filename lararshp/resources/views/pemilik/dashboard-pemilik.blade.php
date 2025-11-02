@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Dashboard Pemilik</h2>
    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Nama Hewan</th><th>Jenis Kelamin</th><th>Warna</th></tr>
        @foreach($pets as $p)
        <tr>
            <td>{{ $p->idpet }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->warna_tanda }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
