@extends('layouts.dokter')

@section('content')
<div class="card p-4">
    <h3 class="fw-bold">Detail Rekam Medis</h3>
    <hr>

    <pre>{{ print_r($rekam, true) }}</pre>

    <a href="{{ route('dokter.rekam.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>
</div>
@endsection
