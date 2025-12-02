@extends('layouts.perawat')

@section('content')
<div class="container-fluid py-4">

    <h2 class="fw-bold text-white mb-2 text-center">Selamat Datang, {{ session('nama') }} 🐾</h2>
    <p class="text-light text-center mb-4">Mari rawat hewan-hewan kesayangan dengan penuh kasih sayang 💙</p>

    <!-- STATISTIC CARD -->
    <div class="row g-4 justify-content-center">

        <!-- CARD TOTAL PASIEN -->
        <div class="col-md-3">
            <div class="stat-card">
                <p class="title">Total Pasien</p>
                <h1 class="value">{{ $totalPasien }}</h1>
                <p class="sub">Hewan dalam perawatan</p>
                <div class="icon">🐾</div>
            </div>
        </div>

        <!-- CARD REKAM MEDIS -->
        <div class="col-md-3">
            <div class="stat-card">
                <p class="title">Rekam Medis</p>
                <h1 class="value">{{ $totalRekam }}</h1>
                <p class="sub">Total catatan</p>
                <div class="icon">📄</div>
            </div>
        </div>

        <!-- CARD SHIFT -->
        <div class="col-md-3">
            <div class="stat-card">
                <p class="title">Shift Hari Ini</p>
                <h3 class="shift">Pagi (07:00 - 15:00)</h3>
                <div class="icon">⏰</div>
            </div>
        </div>

    </div>

    <!-- TABLE PASIEN -->
    <div class="card mt-5 shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="fw-bold mb-3">🐾 Pasien Dalam Perawatan</h4>

            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasien as $p)
                    <tr>
                        <td>{{ $p->nama ?? '-' }}</td>
                        <td>{{ $p->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $p->dokter?->nama ?? '-' }}</td>
                        <td><span class="badge bg-success px-3 py-2">Stabil</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Belum ada pasien dalam perawatan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

<!-- CUSTOM STYLE -->
<style>
body {
    background: linear-gradient(135deg, #0d6efd, #0a3d91);
}

/* CARD STYLE */
.stat-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    text-align: left;
    position: relative;
    box-shadow: 0 10px 18px rgba(0,0,0,0.12);
    transition: transform .3s ease, box-shadow .3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 22px rgba(0,0,0,0.18);
}

.stat-card .title {
    color: #626262;
    font-weight: 600;
    font-size: 17px;
}

.stat-card .value {
    font-size: 42px;
    font-weight: 800;
    margin: 8px 0;
}

.stat-card .sub {
    color: #6c757d;
    margin: 0;
}

.stat-card .shift {
    font-size: 22px;
    font-weight: 700;
    margin-top: 10px;
    color: #5b26dd;
}

.stat-card .icon {
    position: absolute;
    bottom: 15px;
    right: 15px;
    font-size: 36px;
    opacity: .7;
}
</style>
