@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Dashboard Overview</h2>

{{-- KARTU ATAS --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Total Penjualan</h6>
                <h3>{{ $totalPenjualan }}</h3>
                <small>Bulan ini</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6>Total Barang</h6>
                <h3>{{ $totalBarang }}</h3>
                <small>Stok tersedia</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6>Total Vendor</h6>
                <h3>{{ $totalVendor }}</h3>
                <small>Vendor aktif</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Nilai Penjualan</h6>
                <h3>Rp {{ number_format($nilaiPenjualan, 0, ',', '.') }}</h3>
                <small>Bulan ini</small>
            </div>
        </div>
    </div>
</div>

{{-- LAPORAN BULAN INI --}}
<div class="row mt-4">
    <div class="col-md-3">
        <div class="p-3 rounded text-white" style="background:#0057e7;">
            <h4>Laporan Penjualan</h4>
            <p class="fs-5">{{ $lap_penjualan }}</p>
            <small>Bulan ini</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 rounded text-white" style="background:#ff8c00;">
            <h4>Laporan Pengadaan</h4>
            <p class="fs-5">{{ $lap_pengadaan }}</p>
            <small>Bulan ini</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 rounded text-white" style="background:#28a745;">
            <h4>Laporan Penerimaan</h4>
            <p class="fs-5">{{ $lap_penerimaan }}</p>
            <small>Bulan ini</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 rounded text-white" style="background:#6f42c1;">
            <h4>Laporan Retur</h4>
            <p class="fs-5">{{ $lap_retur }}</p>
            <small>Bulan ini</small>
        </div>
    </div>
</div>

{{-- GRAFIK --}}
<div class="card shadow-sm mb-4 mt-4">
    <div class="card-body">
        <h5 class="fw-bold">Penjualan (6 Bulan Terakhir)</h5>
        <canvas id="salesChart"></canvas>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Distribusi Barang</h5>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Penjualan Terbaru</h5>
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama User</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualanTerbaru as $p)
                            <tr>
                                <td>{{ $p->idpenjualan }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                                <td>
                                    @if ($p->status == 'A')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($p->status == 'B')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const salesCtx = document.getElementById('salesChart');

new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($grafik_bulan) !!},
        datasets: [{
            label: 'Total Penjualan',
            data: {!! json_encode($grafik_penjualan) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)'
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

// PIE CHART
const pieCtx = document.getElementById('pieChart');

new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: {!! json_encode(array_column($distribusi, 'jenis')) !!},
        datasets: [{
            data: {!! json_encode(array_column($distribusi, 'jumlah')) !!},
            backgroundColor: ['#007bff','#6610f2','#e83e8c','#fd7e14','#20c997']
        }]
    },
    options: { responsive: true }
});
</script>
@endsection
