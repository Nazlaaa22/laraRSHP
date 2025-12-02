@extends('layouts.perawat')

@section('content')
<div class="container py-4">
    
    <h2 class="fw-bold mb-1">Data Pasien Hewan 🐾</h2>
    <p class="text-muted mb-4">Daftar hewan yang sedang dalam perawatan</p>

    <div class="row g-4">
        @foreach ($pasien as $p)
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm border-0 p-3 h-100">
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">

                        {{-- ================== ICON HEWAN ================== --}}
                        @php
                            $icon = '🐾';
                            switch ($p->jenis->nama_jenis_hewan ?? '') {
                                case 'Kucing (Felis catus)':
                                    $icon = '🐱'; break;
                                case 'Anjing (Canis lupus familiaris)':
                                    $icon = '🐶'; break;
                                case 'Kelinci (Oryctolagus cuniculus)':
                                    $icon = '🐰'; break;
                                case 'Burung':
                                    $icon = '🐦'; break;
                                case 'Reptil':
                                    $icon = '🦎'; break;
                                case 'Rodent / Hewan Kecil':
                                    $icon = '🐹'; break;
                            }
                        @endphp

                        <span style="font-size:32px">{{ $icon }}</span>
                        {{-- ================================================== --}}

                        <h5 class="fw-bold m-0">{{ $p->nama }}</h5>
                    </div>

                    @php
                        $badge = 'bg-success';
                        if($p->status == 'Pemulihan') $badge = 'bg-primary';
                        if($p->status == 'Observasi') $badge = 'bg-warning';
                    @endphp

                    <span class="badge text-white px-3 py-2 {{ $badge }}">{{ $p->status ?? 'Stabil' }}</span>
                </div>

                <p class="text-muted small mb-3">ID: PH00{{ $p->idpet }}</p>

                <div class="small mb-3">
                    <p><strong>Spesies:</strong> {{ $p->jenis->nama_jenis_hewan ?? '-' }}</p>
                    <p><strong>Ras:</strong> {{ $p->ras->nama_ras ?? '-' }}</p>
                    <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($p->tanggal_lahir)->age }} tahun</p>
                    <p><strong>Pemilik:</strong> {{ $p->pemilik->user->nama ?? '-' }}</p>

                    {{-- rekam medis aman tanpa error --}}
                    <p><strong>Rekam Medis:</strong> {{ $p->rekamMedis?->count() ?? 0 }} catatan</p>
                </div>

                <a href="{{ route('perawat.pasien.detail', $p->idpet) }}"
                   class="btn btn-teal w-100 fw-bold py-2"
                   style="background:#0d9488; color:white;">
                    Lihat Detail & Rekam Medis
                </a>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
