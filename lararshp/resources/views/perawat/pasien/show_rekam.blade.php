@extends('layouts.perawat')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold">{{ $rekam->diagnosa }}</h4>
    <p><strong>Tanggal:</strong> {{ $rekam->tanggal }}</p>
    <p><strong>Catatan:</strong> {{ $rekam->anamnesa }}</p>

    <p><strong>Perawatan:</strong>
        @foreach($rekam->detail as $d)
            {{ $d->tindakan->deskripsi_tindakan_terapi ?? '-' }}
        @endforeach
    </p>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
