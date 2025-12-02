@extends('layouts.resepsionis')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Pet</h4>

    <div>
        <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary me-2">⬅ Kembali</a>
        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-primary">Tambah Pet</a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama Hewan</th>
            <th>Ras Hewan</th>
            <th>Nama Pemilik</th>
            <th>No WA</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pet as $p)
        <tr>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->ras->nama_ras ?? '-' }}</td>
            <td>{{ $p->pemilik->user->nama ?? '-' }}</td>
            <td>{{ $p->pemilik->no_wa ?? '-' }}</td>
            <td>{{ $p->pemilik->alamat ?? '-' }}</td>
            <td>
                <a href="{{ route('resepsionis.pet.edit', $p->idpet) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('resepsionis.pet.destroy', $p->idpet) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
