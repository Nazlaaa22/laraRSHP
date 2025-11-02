@extends('layouts.admin')
@section('title', 'Daftar Ras Hewan')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">🧬 Daftar Ras Hewan</h3>
    <p class="text-muted">Menampilkan semua ras hewan dari sistem RSHP</p>
</div>

<div class="card shadow-sm border-0 rounded-4 p-3" style="background: var(--card-bg);">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-primary text-dark">
                <tr>
                    <th class="text-start ps-4">ID</th>
                    <th class="text-start">Nama Ras</th>
                    <th class="text-start">ID Jenis Hewan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-start ps-4">{{ $item->idras_hewan }}</td>
                    <td class="text-start">{{ $item->nama_ras }}</td>
                    <td class="text-start">{{ $item->idjenis_hewan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<a href="/admin" class="btn mt-4" style="background: var(--primary); color: white; border-radius: 8px; font-weight: 600;">
   ← Kembali ke Dashboard
</a>
@endsection
