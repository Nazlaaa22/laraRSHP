@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Data Role</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Role</th>
                    <th>Nama Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($role as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idrole }}</td>
                        <td>{{ $item->nama_role }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada data role</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
