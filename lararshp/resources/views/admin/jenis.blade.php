@extends('layouts.lte.main')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">Jenis Hewan</h3>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary btn-sm">Tambah Jenis</a>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th width="150px">Aksi</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <a href="{{ route('admin.jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
