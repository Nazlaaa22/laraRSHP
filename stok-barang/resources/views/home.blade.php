@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* 🌙 SIDEBAR */
    .sidebar {
        width: 250px;
        background: linear-gradient(180deg, #1e1b4b, #312e81);
        color: #fff;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 4px 0 12px rgba(0,0,0,0.15);
    }

    .sidebar h4 {
        font-weight: 700;
        margin-bottom: 40px;
        font-size: 22px;
    }

    .sidebar a {
        color: #bfc8ff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        transition: all 0.3s;
    }

    .sidebar a:hover {
        color: #fff;
        transform: translateX(6px);
    }

    /* 🌤️ MAIN AREA */
    .main {
        flex-grow: 1;
        padding: 40px 50px;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(15px);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .header h2 {
        font-weight: 700;
        color: #1e1b4b;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #ffffff;
        border-radius: 30px;
        padding: 6px 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .user-info img {
        width: 38px;
        height: 38px;
        border-radius: 50%;
    }

    /* 🧩 CARDS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
    }

    .card-stat {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.07);
        position: relative;
        overflow: hidden;
        transition: 0.3s;
    }

    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .card-stat .icon {
        font-size: 28px;
        position: absolute;
        top: 16px;
        right: 16px;
        opacity: 0.15;
    }

    .card-stat h6 {
        color: #666;
        font-weight: 600;
    }

    .card-stat .value {
        font-size: 28px;
        font-weight: 700;
        color: #1e1b4b;
    }

    /* 📊 CHART CONTAINER */
    .chart-section {
        margin-top: 50px;
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    }

    .chart-section h5 {
        font-weight: 600;
        color: #1e1b4b;
        margin-bottom: 20px;
    }

    footer {
        text-align: center;
        margin-top: 40px;
        color: #777;
        font-size: 14px;
    }
</style>

<div class="dashboard-wrapper">
    {{-- 🟣 SIDEBAR --}}
    <div class="sidebar">
        <div>
            <h4>💼 Stok Barang</h4>
            <a href="{{ url('/home') }}">🏠 Dashboard</a>
            <a href="{{ url('/barang') }}">📦 Barang</a>
            <a href="{{ url('/vendor') }}">🏭 Vendor</a>
            <a href="{{ url('/satuan') }}">⚖️ Satuan</a>
            <a href="{{ url('/user') }}">👤 User</a>
            <a href="{{ url('/role') }}">🔑 Role</a>
            <a href="{{ url('/kartu-stok') }}">📊 Kartu Stok</a>
        </div>
        <footer>© 2025 Sistem Stok Barang</footer>
    </div>

    {{-- 🟢 MAIN --}}
    <div class="main">
        <div class="header">
            <h2>Dashboard Master Data</h2>
            <div class="user-info">
                <span>Hai, Nazla 👋</span>
                <img src="https://ui-avatars.com/api/?name=Nazla+Khoiriyah&background=1e1b4b&color=fff" alt="Nazla">
            </div>
        </div>

        {{-- 🎯 STAT CARDS --}}
        <div class="stats-grid">
            <div class="card-stat">
                <i class="icon">📦</i>
                <h6>Barang</h6>
                <div class="value text-primary">{{ $barang ?? 7 }}</div>
            </div>
            <div class="card-stat">
                <i class="icon">🏭</i>
                <h6>Vendor</h6>
                <div class="value text-success">{{ $vendor ?? 6 }}</div>
            </div>
            <div class="card-stat">
                <i class="icon">⚖️</i>
                <h6>Satuan</h6>
                <div class="value text-warning">{{ $satuan ?? 5 }}</div>
            </div>
            <div class="card-stat">
                <i class="icon">👤</i>
                <h6>User</h6>
                <div class="value text-info">{{ $user ?? 5 }}</div>
            </div>
            <div class="card-stat">
                <i class="icon">🔑</i>
                <h6>Role</h6>
                <div class="value text-danger">{{ $role ?? 2 }}</div>
            </div>
            <div class="card-stat">
                <i class="icon">📊</i>
                <h6>Kartu Stok</h6>
                <div class="value text-secondary">{{ $kartu_stok ?? 0 }}</div>
            </div>
        </div>

        {{-- 📈 CHART --}}
        <div class="chart-section mt-4">
            <h5>Perbandingan Jumlah Barang per Satuan</h5>
            <canvas id="barangChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('barangChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Kg', 'Ltr', 'Pcs', 'Pack', 'Dus'],
            datasets: [{
                label: 'Jumlah Barang',
                data: [10, 5, 15, 3, 8],
                fill: true,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                tension: 0.4,
                pointBackgroundColor: '#4338ca'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
