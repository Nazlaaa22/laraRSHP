@extends('layouts.lte.main')

@section('content')
<div class="app-content">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Kategori Klinis</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item active">Kategori Klinis</li>
            </ol>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Data Kategori Klinis</h5>

            <a href="{{ route('admin.kategori_klinis.create') }}" class="btn btn-primary">
            + Tambah Kategori Klinis
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Kategori Klinis</th>
                        <th>Deskripsi</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategoriKlinis as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $k->nama_kategori_klinis }}</td>
                            <td>{{ $k->deskripsi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.kategori_klinis.edit', $k->idkategori_klinis) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.kategori_klinis.destroy', $k->idkategori_klinis) }}"
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
                            <td colspan="4" class="text-muted">Belum ada data kategori klinis.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
