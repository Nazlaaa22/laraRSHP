@extends('layouts.admin')
@section('title', 'Data Jenis Hewan')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">🐾 Daftar Jenis Hewan</h3>
    <p class="text-muted">Menampilkan semua jenis hewan yang terdaftar di sistem RSHP</p>
</div>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">Data Jenis Hewan</h4>
        <a href="{{ route('admin.jenis.create') }}" class="btn btn-success">+ Tambah Jenis Hewan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenis as $index => $j)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $j->nama_jenis_hewan }}</td>
                        <td>
                            <a href="{{ route('admin.jenis.edit', $j->idjenis_hewan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.jenis.destroy', $j->idjenis_hewan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-muted">Belum ada data jenis hewan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<a href="/admin" class="btn mt-4" 
   style="background: var(--primary); color: white; border-radius: 8px; font-weight: 600;">
   ← Kembali ke Dashboard
</a>
@endsection
