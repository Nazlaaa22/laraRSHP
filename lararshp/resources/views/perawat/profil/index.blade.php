@extends('layouts.perawat')

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold mb-4">Profil Saya</h2>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <table class="table table-bordered">
                <tr>
                    <th>ID User</th>
                    <td>{{ $profil->iduser }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $profil->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $profil->email }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>************</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
