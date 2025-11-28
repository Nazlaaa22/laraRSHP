@extends('layouts.lte.main')

@section('content')
<div class="container-fluid">

    {{-- Breadcrumb --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Jenis Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item active">Jenis Hewan</li>
            </ol>
        </div>
    </div>

    {{-- Card Tabel --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tabel Data Jenis Hewan</h5>
            <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary btn-sm">
                + Tambah Jenis
            </a>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="50">No</th>
                        <th>Nama</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jenis as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_jenis_hewan }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.jenis.edit', $item->idjenis_hewan) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.jenis.destroy', $item->idjenis_hewan) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Tidak ada data jenis hewan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
