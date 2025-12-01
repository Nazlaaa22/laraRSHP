@extends('layouts.lte.main')

@section('content')

{{-- Header --}}
<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">Data Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
            <li class="breadcrumb-item active">Pet</li>
        </ol>
    </div>
</div>

{{-- Card --}}
<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold m-0">Daftar Pet</h5>
        <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
            + Tambah Pet
        </a>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Pet</th>
                        <th>Jenis Kelamin</th>
                        <th>Jenis Hewan</th>
                        <th>Ras Hewan</th>
                        <th>Umur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pet as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama_pet }}</td>
                            <td>{{ $p->jenis_kelamin }}</td>
                            <td>{{ $p->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $p->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $p->umur ?? '-' }}</td>

                            <td>
                                <a href="{{ route('admin.pet.edit', $p->idpet) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.pet.destroy', $p->idpet) }}"
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
                            <td colspan="7" class="text-muted">Belum ada data pet.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
