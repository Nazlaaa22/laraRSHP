@extends('layouts.lte.main')
@section('content')
<div class="container">
    <h2>Dashboard Administrator</h2>

    <h4>Data User</h4>
    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Nama</th><th>Email</th></tr>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->iduser }}</td>
            <td>{{ $u->nama }}</td>
            <td>{{ $u->email }}</td>
        </tr>
        @endforeach
    </table>

    <h4>Data Role</h4>
    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Nama Role</th></tr>
        @foreach($roles as $r)
        <tr><td>{{ $r->idrole }}</td><td>{{ $r->nama_role }}</td></tr>
        @endforeach
    </table>

    <h4>Data Pet</h4>
    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Nama Hewan</th><th>Pemilik</th></tr>
        @foreach($pets as $p)
        <tr>
            <td>{{ $p->idpet }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->pemilik->user->nama ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
