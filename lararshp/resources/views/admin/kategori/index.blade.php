@extends('layouts.lte.main')

@section('content')

<div class="app-content">

    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="mb-0">Kategori Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                <li class="breadcrumb-item active">Kategori Hewan</li>
            </ol>
        </div>
    </div>

    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0 rounded-3">
        
        {{-- HEADER TABLE --}}
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0">Data Kategori</h5>

            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                + Tambah Kategori
            </a>
        </div>

        {{-- BODY TABLE --}}
        <div class="card-body">

            {{-- Pesan sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>Nama Kategori</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $k->nama_kategori }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" 
                                       class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>

@endsection
