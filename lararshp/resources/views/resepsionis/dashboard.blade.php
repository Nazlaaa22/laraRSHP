@extends('layouts.resepsionis')
@section('title', 'Dashboard Resepsionis RSHP')

@section('content')
<div class="text-center">
    <h3 class="fw-bold" style="color: var(--primary)">Dashboard Resepsionis RSHP</h3>
    <p class="text-muted">Selamat datang, {{ session('nama') }} 👋</p>
</div>

{{-- MENU GRID --}}
<div class="menu-grid mt-5 d-grid gap-4" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
    <a href="/resepsionis/pendaftaran" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">📋</div>
        <h5>Pendaftaran Pasien</h5>
    </a>

    <a href="/resepsionis/pet" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🐾</div>
        <h5>Data Hewan</h5>
    </a>

    <a href="{{ route('resepsionis.temu.index') }}" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">👨‍⚕️</div>
        <h5>Temu Dokter</h5>
    </a>
</div>

{{-- DATA PENDAFTARAN PASIEN --}}
<div class="card shadow-sm p-4 mt-5" style="border-radius: 20px; background: var(--card-bg);">
    <h5 class="fw-bold mb-3 text-center" style="color: var(--primary)">📋 Data Pendaftaran Pasien</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-primary text-white">
                <tr>
                    <th>ID Pendaftaran</th>
                    <th>Nama Hewan</th>
                    <th>Pemilik</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $p)
                <tr>
                    {{-- ID Pendaftaran --}}
                    <td>{{ $p->idreservasi_dokter }}</td>

                    {{-- Nama Hewan --}}
                    <td>{{ $p->pet->nama ?? '-' }}</td>

                    {{-- Nama Pemilik --}}
                    <td>{{ $p->pet->pemilik->user->nama ?? '-' }}</td>

                    {{-- Tanggal Daftar --}}
                    <td>
                        {{ $p->waktu_daftar ? date('Y-m-d H:i:s', strtotime($p->waktu_daftar)) : '-' }}
                    </td>

                    {{-- Status --}}
                    <td>
                        @if($p->status == 1)
                            <span class="badge bg-success">Selesai</span>
                        @elseif($p->status == 2)
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @else
                            <span class="badge bg-secondary">Belum Diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted">Belum ada data pendaftaran pasien.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- STYLING --}}
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
    .badge {
        font-size: 0.9rem;
        padding: 6px 10px;
        border-radius: 10px;
    }
    body {
        background-color: #f7faff;
    }
</style>
@endsection
