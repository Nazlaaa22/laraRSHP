@extends('layouts.perawat')

@section('content')
<div class="container py-4">

    <a href="{{ route('perawat.pasien') }}" class="text-success fw-bold mb-3 d-inline-block">
        ← Kembali ke Daftar Pasien
    </a>

    {{-- DETAIL PASIEN --}}
    <div class="card p-4 rounded-3 shadow-sm mb-4">
        <div class="d-flex align-items-center gap-3 mb-3">

            {{-- ICON HEWAN --}}
            @php
                $icon = '🐾';
                switch ($pet->jenis->nama_jenis_hewan ?? '') {
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

            <span style="font-size:40px">{{ $icon }}</span>

            <div>
                <h3 class="fw-bold m-0">{{ $pet->nama }}</h3>
                <span class="text-muted">{{ $pet->ras->nama_ras ?? '-' }}</span>
            </div>
        </div>

        <div class="row text-sm mt-3">
            <div class="col-md-4 mb-2">
                <strong>ID Pasien</strong>
                <p>PH00{{ $pet->idpet }}</p>
            </div>

            <div class="col-md-4 mb-2">
                <strong>Spesies</strong>
                <p>{{ $pet->jenis->nama_jenis_hewan ?? '-' }}</p>
            </div>

            <div class="col-md-4 mb-2">
                <strong>Usia</strong>
                <p>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun</p>
            </div>

            <div class="col-md-4 mb-2">
                <strong>Ras</strong>
                <p>{{ $pet->ras->nama_ras ?? '-' }}</p>
            </div>

            <div class="col-md-4 mb-2">
                <strong>Pemilik</strong>
                <p>{{ $pet->pemilik->user->nama ?? '-' }}</p>
            </div>

            <div class="col-md-4 mb-2">
                <strong>Status</strong>
                <p>
                    <span class="badge bg-success">
                        {{ $pet->status ?? 'Stabil' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- REKAM MEDIS --}}
    <div class="card p-4 rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Rekam Medis</h4>

            <a href="#" class="btn btn-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#tambahRekamMedis">
                + Tambah Rekam Medis
            </a>
        </div>

        <!-- Modal Tambah Rekam Medis -->
        <div class="modal fade" id="tambahRekamMedis" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('perawat.rekam.store', $pet->idpet) }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">➕ Tambah Rekam Medis</h5>
                </div>

                <div class="modal-body">

                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control mb-3" required>

                    <label>Diagnosis</label>
                    <input type="text" name="diagnosis" class="form-control mb-3" placeholder="Contoh: Infeksi Saluran Pernapasan" required>

                    <label>Kategori Klinis</label>
                    <select name="kategori_klinis" class="form-control mb-3">
                        @foreach($kategori as $k)
                            <option value="{{ $k->idkategori_klinis }}">{{ $k->nama_kategori_klinis }}</option>
                        @endforeach
                    </select>

                    <label>Perawatan / Tindakan</label>
                    <select name="perawatan" class="form-control mb-3">
                        @foreach($tindakan as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}">
                                {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>

                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

                </form>
            </div>
        </div>

        {{-- LIST REKAM MEDIS --}}
        @forelse ($rekamMedis as $r)
            <div class="border rounded-3 p-3 mb-3 shadow-sm bg-white">
                <h5 class="fw-bold m-0">{{ $r->diagnosa }}</h5>
                <p class="small text-muted mt-1">📅 {{ $r->tanggal }}</p>

                <p class="mt-2">
                    <strong>Perawatan:</strong>
                    @forelse ($r->detail as $d)
                        {{ $d->tindakan->deskripsi_tindakan_terapi ?? '-' }}
                    @empty
                        -
                    @endforelse
                    <p><strong>Catatan:</strong> {{ $r->anamnesa ?? '-' }}</p>
                </p>

                <div class="d-flex gap-3 mt-2">
                    <a href="{{ route('perawat.rekam.detail', $r->idrekam_medis) }}" class="text-primary">👁 Lihat</a>
                    <a href="{{ route('perawat.rekam.edit', $r->idrekam_medis) }}" class="text-success">✏ Edit</a>
                    <form action="{{ route('perawat.rekam.delete', $r->idrekam_medis) }}" method="POST" onsubmit="return confirm('Hapus rekam medis ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link text-danger p-0 m-0">🗑 Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada rekam medis untuk pasien ini</p>
        @endforelse
    </div>

</div>
@endsection
