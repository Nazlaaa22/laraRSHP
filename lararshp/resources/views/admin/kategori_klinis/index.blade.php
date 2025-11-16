@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary">🧫 Daftar Kategori Klinis</h3>
        <a href="{{ route('admin.kategori_klinis.create') }}" class="btn btn-success">+ Tambah Kategori Klinis</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4 p-3">
        <table class="table table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoriKlinis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.kategori_klinis.edit', $item->idkategori_klinis) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.kategori_klinis.destroy', $item->idkategori_klinis) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
