@extends('layouts.admin')
@section('title', 'Dashboard Admin RSHP')

@section('content')
<div class="text-center">
    <h3 class="fw-bold" style="color: var(--primary)">Dashboard Admin RSHP</h3>
</div>

<div class="menu-grid mt-5 d-grid gap-4" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
    <a href="/admin/jenis" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🐾</div>
        <h5>Jenis Hewan</h5>
    </a>

    <a href="/admin/ras" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🧬</div>
        <h5>Ras Hewan</h5>
    </a>

    <a href="/admin/kategori" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">📦</div>
        <h5>Kategori</h5>
    </a>

    <a href="/admin/kategori-klinis" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🧫</div>
        <h5>Kategori Klinis</h5>
    </a>

    <a href="/admin/tindakan-terapi" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">💉</div>
        <h5>Kode Tindakan Terapi</h5>
    </a>

    <a href="/admin/pet" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">🐕</div>
        <h5>Pet</h5>
    </a>

    <a href="/admin/role" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">👑</div>
        <h5>Role</h5>
    </a>

    <a href="/admin/user" class="menu-card text-decoration-none">
        <div class="menu-icon fs-2">👤</div>
        <h5>User + Role</h5>
    </a>
</div>

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
</style>
@endsection
