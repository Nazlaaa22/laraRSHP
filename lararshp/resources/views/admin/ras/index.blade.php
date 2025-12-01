@extends('layouts.lte.main')

@section('content')
<div class="app-content">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Ras Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item active">Ras Hewan</li>
            </ol>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Data Ras Hewan</h5>

            <a href="{{ route('admin.ras.create') }}" class="btn btn-primary">
                + Tambah Ras Hewan
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Ras</th>
                            <th>Jenis Hewan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ras as $index => $r)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $r->nama_ras }}</td>
                            <td>{{ $r->jenisHewan->nama_jenis_hewan }}</td>

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

</div>

@endsection
