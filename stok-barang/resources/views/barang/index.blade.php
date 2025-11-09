@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Data Barang</h2>

    {{-- 🔹 Tombol Tambah + Filter di pojok kanan --}}
    <div class="d-flex justify-content-end align-items-center mb-3">
        <form method="GET" action="{{ url('/barang') }}" class="d-flex align-items-center me-2">
            <label class="me-2 fw-bold">Status:</label>
            <select name="status" class="form-select me-2" style="width: 180px;" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            <a href="{{ url('/barang') }}" class="btn btn-secondary me-2">Reset</a>
        </form>
        <a href="{{ route('barang.create') }}" class="btn btn-success">+ Tambah Barang</a>
    </div>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔹 Tabel Data Barang --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td> {{-- tampilkan nomor urut manual --}}
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nama_satuan }}</td>
                <td>{{ $row->stok }}</td>
                <td>{{ number_format($row->harga, 0, ',', '.') }}</td>
                <td>
                    @if($row->status == 1)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Tidak Aktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('barang.edit', $row->idbarang) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $row->idbarang) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
