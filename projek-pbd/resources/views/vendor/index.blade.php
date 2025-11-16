@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Vendor</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Vendor</th>
                    <th>Nama Vendor</th>
                    <th>Badan Hukum</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendor as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idvendor }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->badan_hukum ?? '-' }}</td>
                        <td>
                            @if ($item->status == 'A')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data vendor</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
