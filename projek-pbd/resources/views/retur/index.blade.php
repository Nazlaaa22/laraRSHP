@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Retur</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Retur</th>
                    <th>ID Penerimaan</th>
                    <th>Nama User</th>
                    <th>Tanggal</th>
                    <th>Alasan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($retur as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idretur }}</td>
                        <td>{{ $item->idpenerimaan }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->alasan ?? '-' }}</td>
                        <td>
                            @if ($item->status == 'A')
                                <span class="badge bg-success">Aktif</span>
                            @elseif ($item->status == 'P')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada data retur</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
