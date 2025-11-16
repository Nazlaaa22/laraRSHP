@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Penjualan</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>Nama User</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualan as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->idpenjualan }}</td>
                        <td>{{ $p->nama_user }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                        <td>
                            @if ($p->status == 'A')
                                <span class="badge bg-success">Aktif</span>
                            @elseif ($p->status == 'B')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data penjualan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
