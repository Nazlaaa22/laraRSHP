@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Pengadaan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Pengadaan</th>
                    <th>Vendor</th>
                    <th>Nama User</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th> <!-- ✅ pindahkan ke sini -->
                </tr>
            </thead>
            <tbody>
                @forelse ($pengadaan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idpengadaan }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>
                            @if ($item->status == 'A')
                                <span class="badge bg-success">Aktif</span>
                            @elseif ($item->status == 'P')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pengadaan.show', $item->idpengadaan) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada data pengadaan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
