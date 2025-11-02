@extends('layouts.admin')
@section('title', 'Dashboard Pemilik RSHP')

@section('content')
<div class="text-center">
    <h3 class="fw-bold" style="color: var(--primary)">Dashboard Pemilik RSHP</h3>
    <p class="text-muted">Selamat datang, {{ session('user_name') }} 👋</p>
</div>

{{-- MENU GRID --}}
<div class="menu-grid mt-5 d-grid gap-4" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
    <a href="/pemilik/pet" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🐶</div>
        <h5>Data Hewan Saya</h5>
    </a>

    <a href="/pemilik/riwayat" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🧾</div>
        <h5>Riwayat Pemeriksaan</h5>
    </a>
</div>

{{-- DATA HEWAN --}}
<div class="card shadow-sm p-4 mt-5" style="border-radius: 20px; background: var(--card-bg);">
    <h5 class="fw-bold mb-3 text-center" style="color: var(--primary)">🐾 Data Hewan Peliharaan Anda</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-primary text-white">
                <tr>
                    <th>ID Hewan</th>
                    <th>Nama Hewan</th>
                    <th>Jenis Kelamin</th>
                    <th>Warna / Tanda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $p)
                <tr>
                    <td>{{ $p->idpet }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->warna_tanda }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-muted">Belum ada data hewan yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- STYLE --}}
<style>
    .menu-card {
        background: var(--card-bg);
        border-radius: 18px;
        padding: 35px 20px;
        box-shadow: 0 4px 20px var(--shadow);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: 0.3s;
        color: var(--text-color);
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 80, 255, 0.15);
    }
    .table {
        border-radius: 10px;
        overflow: hidden;
    }
    .table thead th {
        background-color: #0d6efd !important;
        color: white;
        border: none;
    }
    .card {
        border: none;
    }
    body {
        background-color: #f7faff;
    }
</style>
@endsection
