@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<div class="container mt-4">

    {{-- Search Bar --}}
    <div class="mb-3">
        <input type="text" class="form-control form-control-lg" placeholder="🔍 Cari nama pasien atau pemilik...">
    </div>

    {{-- List Pasien --}}
    @foreach ($pasien as $p)
        @php
            $umur = $p->tanggal_lahir ? Carbon::parse($p->tanggal_lahir)->age : '-';
        @endphp

        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">

                {{-- Header Nama Pasien + Badge Jenis Hewan --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="fw-bold">{{ $p->nama }}</h4>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        {{ $p->nama_jenis_hewan }}
                    </span>
                </div>

                {{-- Detail Hewan --}}
                <p class="mb-1"><strong>Ras:</strong> {{ $p->nama_ras }}</p>
                <p class="mb-1"><strong>Umur:</strong> {{ $umur }} tahun</p>
                <p class="mb-1">
                    <strong>Jenis Kelamin:</strong> {{ $p->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}
                </p>

                <hr>

                {{-- Pemilik --}}
                <p class="fw-semibold mb-1">Pemilik:</p>
                <p class="mb-0">{{ $p->nama_pemilik }}</p>
                <p class="mb-0">
                    📞 {{ $p->no_wa }}
                </p>
                <p class="mb-3">{{ $p->alamat }}</p>

                {{-- Tombol Detail --}}
                <a href="{{ route('dokter.rekam.detail', $p->idpet) }}" class="btn btn-primary w-100 rounded-3 py-2">
                    👁️  Lihat Detail
                </a>
            </div>
        </div>

    @endforeach

</div>
@endsection
