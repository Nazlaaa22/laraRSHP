@extends('layouts.admin')
@section('title', 'Daftar Kategori')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">📦 Daftar Kategori</h3>
    <p class="text-muted">Menampilkan semua kategori layanan di sistem RSHP</p>
</div>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">Data Kategori</h4>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-success">+ Tambah Kategori</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4 p-3">
        <table class="table table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}" method="POST" class="d-inline">
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

    <a href="/admin" class="btn btn-secondary mt-4">← Kembali ke Dashboard</a>
</div>
@endsection
