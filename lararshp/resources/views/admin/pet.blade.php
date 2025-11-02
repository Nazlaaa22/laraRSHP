@extends('layouts.admin')
@section('title', 'Daftar Pet')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">🐕 Daftar Pet</h3>
    <p class="text-muted">Menampilkan semua data hewan peliharaan yang terdaftar</p>
</div>

<div class="card shadow-sm border-0 rounded-4 p-3" style="background: var(--card-bg);">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-primary text-dark">
                <tr>
                    <th class="text-start ps-4">ID</th>
                    <th class="text-start">Nama Pet</th>
                    <th class="text-start">Ras Hewan</th>
                    <th class="text-start">Pemilik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-start ps-4">{{ $item->idpet }}</td>
                    <td class="text-start">{{ $item->nama_pet }}</td>
                    <td class="text-start">{{ $item->idras_hewan }}</td>
                    <td class="text-start">{{ $item->idpemilik }}</td>
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
