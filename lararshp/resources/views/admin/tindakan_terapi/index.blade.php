@extends('layouts.lte.main')

@section('content')

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Tindakan Terapi</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item active">Tindakan Terapi</li>
            </ol>
        </div>
    </div>

<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold m-0">Data Tindakan Terapi</h5>
        <a href="{{ route('admin.tindakan_terapi.create') }}" class="btn btn-primary">
            + Tambah Tindakan Terapi
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Deskripsi Tindakan</th>
                        <th>Kategori</th>
                        <th>Kategori Klinis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tindakan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->deskripsi_tindakan_terapi ?? '-' }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>

                            <td>
                                <a href="{{ route('admin.tindakan_terapi.edit', $item->idkode_tindakan_terapi) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.tindakan_terapi.destroy', $item->idkode_tindakan_terapi) }}"
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
                            <td colspan="6" class="text-muted">Belum ada data tindakan terapi.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
