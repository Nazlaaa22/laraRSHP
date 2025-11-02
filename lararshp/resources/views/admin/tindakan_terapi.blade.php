@extends('layouts.admin')
@section('title', 'Kode Tindakan Terapi')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">💉 Kode Tindakan Terapi</h3>
    <p class="text-muted">Menampilkan daftar kode tindakan terapi dan biayanya</p>
</div>

<div class="card shadow-sm border-0 rounded-4 p-3" style="background: var(--card-bg);">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-primary text-dark">
                <tr>
                    <th class="text-start ps-4">ID</th>
                    <th class="text-start">Nama Tindakan</th>
                    <th class="text-start">Biaya (Rp)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td class="text-start ps-4">{{ $item->idkode_tindakan_terapi }}</td>
                    <td class="text-start">{{ $item->kode }}</td>
                    <td class="text-start">{{ $item->deskripsi_tindakan_terapi }}</td>
                    <td class="text-start">{{ $item->idkategori }}</td>
                    <td class="text-start">{{ $item->idkategori_klinis }}</td>
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
