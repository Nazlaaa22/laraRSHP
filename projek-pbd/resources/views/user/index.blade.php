@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data User</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama User</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->iduser }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td>{{ $item->nama_role }}</td>
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
                        <td colspan="6">Belum ada data user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
