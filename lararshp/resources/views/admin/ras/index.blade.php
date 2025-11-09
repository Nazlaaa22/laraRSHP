@extends('layouts.admin')

@section('title', 'Daftar Ras Hewan')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-4">
        <h3 class="fw-bold text-primary">🧬 Daftar Ras Hewan</h3>
        <p class="text-muted">Menampilkan semua ras hewan dari sistem RSHP</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-primary">Data Ras Hewan</h5>
        <a href="{{ route('admin.ras.create') }}" class="btn btn-success">
            + Tambah Ras Hewan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Ras</th>
                            <th>Jenis Hewan</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ras as $index => $r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $r->nama_ras }}</td>
                                <td>{{ $r->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.ras.edit', $r->idras_hewan) }}" 
                                       class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.ras.destroy', $r->idras_hewan) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">Belum ada data ras hewan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/admin" class="btn btn-primary" 
           style="border-radius: 8px; font-weight: 600;">
           ← Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
