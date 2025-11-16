@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Barang</h2>

{{-- Tombol Tambah --}}
<a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($barang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->idbarang }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->jenis ?? '-' }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>

                    {{-- Status diperbaiki (karena di DB status = 'A' atau 'N') --}}
                    <td>
                        @if($b->status == 'A')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>

                    <td>{{ $b->created_at }}</td>

                    {{-- Tombol Edit & Delete --}}
                    <td>
                        <a href="{{ route('barang.edit', $b->idbarang) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('barang.destroy', $b->idbarang) }}" 
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data barang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

