@extends('layouts.resepsionis')

@section('title', 'Data Pendaftaran Pasien')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color: var(--primary)">📋 Data Pendaftaran Pasien</h3>

        <div>
            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary px-4 me-2">
                ⬅ Kembali
            </a>
            <a href="{{ route('resepsionis.pendaftaran.create') }}" class="btn btn-primary px-4">
                + Tambah Pendaftaran
            </a>
        </div>
    </div>

    <div class="card shadow-sm" style="border-radius: 18px; background: var(--card-bg)">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary text-white">
                        <tr>
                            <th>ID Pendaftaran</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pendaftaran as $p)
                        <tr>
                            <td>{{ $p->idreservasi_dokter }}</td>

                            {{-- Jika tidak ada hewan, tampilkan '-' --}}
                            <td>{{ $p->pet->nama ?? '-' }}</td>

                            {{-- Pemilik -> User -> nama --}}
                            <td>{{ $p->pet->pemilik->user->nama ?? '-' }}</td>

                            {{-- Tanggal daftar --}}
                            <td>{{ $p->waktu_daftar ?? '-' }}</td>

                            {{-- Status --}}
                            <td>
                                @if ($p->status == 1)
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($p->status == 2)
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @else
                                    <span class="badge bg-secondary">Belum Diproses</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('resepsionis.pendaftaran.edit', $p->idreservasi_dokter) }}"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <form action="{{ route('resepsionis.pendaftaran.destroy', $p->idreservasi_dokter) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin menghapus?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada data pendaftaran.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

{{-- STYLE TAMBAHAN --}}
<style>
.table thead th {
    background-color: #0d6efd !important;
    color: white;
    border: none;
}
.card {
    border: none;
}
.badge {
    font-size: 0.9rem;
    padding: 6px 10px;
    border-radius: 10px;
}
</style>

@endsection
