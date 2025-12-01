@extends('layouts.lte.main')

@section('content')

<div class="app-content-header mb-3">
    <h3 class="app-content-headerText">Daftar Ras Hewan</h3>
    <span class="app-content-headerSubtext">
        Menampilkan semua ras hewan dari sistem RSHP
    </span>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="text-start ps-3">ID</th>
                        <th class="text-start">Nama Ras</th>
                        <th class="text-start">Jenis Hewan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-start ps-3">{{ $item->idras_hewan }}</td>
                            <td class="text-start">{{ $item->nama_ras }}</td>
                            <td class="text-start">{{ $item->idjenis_hewan }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

<div class="mt-4">
    <a href="/admin" class="btn btn-primary" style="border-radius: 8px;">
        ← Kembali ke Dashboard
    </a>
</div>

@endsection
