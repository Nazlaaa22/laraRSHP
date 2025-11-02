@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Dashboard Dokter</h3>
    <p>Selamat datang, {{ session('user_name') }}</p>
</div>
@endsection
