@extends('layouts.dokter')

@section('content')
<div class="container mt-4 mb-5">

    <h2 class="fw-bold mb-4">Data Pasien</h2>

    {{-- Search --}}
    <div class="mb-4">
        <input type="text" class="form-control form-control-lg rounded-pill px-4"
            placeholder="Cari nama pasien atau pemilik...">
    </div>

    {{-- List Pasien --}}
    @foreach ($pasien as $item)
    <div class="card shadow-sm rounded-4 p-4 mb-4 border-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold m-0">{{ $item->nama_hewan }}</h3>
            <span class="badge bg-primary px-3 py-2 rounded-pill">
                {{ $item->jenis }} ({{ $item->ras }})
            </span>
        </div>

        <p class="m-0"><strong>Ras:</strong> {{ $item->ras }}</p>
        <p class="m-0"><strong>Umur:</strong> {{ $item->umur }} tahun</p>
        <p class="m-0"><strong>Jenis Kelamin:</strong>
            {{ $item->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
        </p>

        <hr>

        <p class="fw-bold mb-1">Pemilik:</p>
        <p class="m-0">{{ $item->nama_pemilik }}</p>
        <p class="m-0">
            <i class="bi bi-telephone-fill me-2"></i> {{ $item->telepon }}
        </p>
        <p class="m-0">{{ $item->alamat }}</p>

    </div>
    @endforeach

</div>
@endsection
