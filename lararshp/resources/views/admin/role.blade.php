@extends('layouts.admin')
@section('title', 'Daftar Role')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold" style="color: var(--primary)">👑 Daftar Role</h3>
    <p class="text-muted">Menampilkan semua role pengguna di sistem RSHP</p>
</div>

<div class="card shadow-sm border-0 rounded-4 p-3" style="background: var(--card-bg);">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-primary text-dark">
                <tr>
                    <th class="text-start ps-3" style="width: 80px;">ID</th>
                    <th class="text-start ps-3">Nama Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-start ps-3">{{ $item->idrole }}</td>
                    <td class="text-start ps-3">{{ $item->nama_role }}</td>
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
