<?php
include "../../config/database.php";
session_start();

// Nama admin login
$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

// Ambil daftar penjualan
$qPenjualan = mysqli_query($conn, "
    SELECT 
        pj.idpenjualan,
        pj.created_at,
        pj.subtotal_nilai,
        pj.ppn,
        pj.total_nilai,
        u.nama_lengkap
    FROM penjualan pj
    LEFT JOIN user u ON u.iduser = pj.iduser
    ORDER BY pj.idpenjualan DESC
");

// Hitung ringkasan margin (pakai asumsi margin 20% dari total penjualan)
$rows = [];
$total_omzet = 0;
$total_ppn = 0;
$total_margin = 0;
$MARGIN_PERSEN = 20; // asumsi margin 20%

while($p = mysqli_fetch_assoc($qPenjualan)){
    $margin = $p['total_nilai'] * ($MARGIN_PERSEN / 100);
    $p['margin_nilai'] = $margin;

    $rows[] = $p;

    $total_omzet += $p['total_nilai'];
    $total_ppn   += $p['ppn'];
    $total_margin += $margin;
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Margin Penjualan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }

:root { --sidebar-w: 260px; }

.sidebar {
    position: fixed; top:0; left:0;
    width: var(--sidebar-w); height: 100vh;
    background: linear-gradient(180deg,#6a11cb,#c61fab);
    color: #fff; padding: 25px;
    transition: .3s; z-index: 999;
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.4);
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar.closed { width: 80px; }
.sidebar .brand { display:flex; justify-content:space-between; align-items:center; }
.sidebar.closed h5, .sidebar.closed small { display:none; }

.sidebar nav a {
    padding: 12px 0; display:flex; align-items:center;
    color:white; text-decoration:none; font-size:16px;
}
.sidebar nav a i { margin-right:10px; }
.sidebar.closed nav a span { display:none; }

#toggleSidebar {
    background: rgba(255,255,255,0.3);
    border:none; color:#fff;
    width:36px; height:36px;
    border-radius:10px;
    font-size:20px; cursor:pointer;
}

.main {
    margin-left: var(--sidebar-w);
    padding: 30px;
    transition:.3s;
}
.sidebar.closed ~ .main { margin-left:80px; }

/* card ringkasan */
.summary-card {
    border-radius: 16px;
    border: none;
}
.summary-label {
    font-size: 13px;
    color: #6b7280;
}
.summary-value {
    font-size: 20px;
    font-weight: 700;
}
.badge-margin {
    background: rgba(16,185,129,0.15);
    color:#047857;
}
</style>
</head>

<body>

<!-- ================================= SIDEBAR ================================= -->
<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div>
            <h5>Glow Skincare</h5>
            <small>Dashboard Admin</small>
        </div>
        <button id="toggleSidebar">×</button>
    </div>

    <nav class="mt-4 d-flex flex-column">
        <a href="../dashboard.php"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
        <a href="../produk/produk.php"><i class="bi bi-box-seam"></i><span>Kategori Produk</span></a>
        <a href="../satuan/satuan.php"><i class="bi bi-tags"></i><span>Satuan</span></a>
        <a href="../vendor/vendor.php"><i class="bi bi-shop"></i><span>Vendor</span></a>
        <a href="../pengadaan/pengadaan.php"><i class="bi bi-truck"></i><span>Pengadaan</span></a>
        <a href="../penerimaan/penerimaan.php"><i class="bi bi-check2-square"></i><span>Penerimaan</span></a>
        <a href="../retur/retur.php"><i class="bi bi-arrow-repeat"></i><span>Retur</span></a>
        <a href="../penjualan/penjualan.php"><i class="bi bi-receipt"></i><span>Transaksi Penjualan</span></a>
        <a href="margin_penjualan.php"><i class="bi bi-graph-up-arrow"></i><span>Margin Penjualan</span></a>
        <a href="../kartu_stok/kartu_stok.php"><i class="bi bi-clipboard-data"></i><span>Kartu Stok</span></a>

        <hr style="opacity:.3">
        <a href="../user/user.php" style="font-weight:700;"><i class="bi bi-people"></i><span>User</span></a>
        <a href="../role/role.php"><i class="bi bi-shield-lock"></i><span>Role</span></a>

        <hr style="opacity:.3">
        <a href="../logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
    </nav>
</aside>

<script>
const sidebar = document.getElementById("sidebar");
const btn = document.getElementById("toggleSidebar");

btn.addEventListener("click", () => {
    sidebar.classList.toggle("closed");
    btn.innerText = sidebar.classList.contains("closed") ? "☰" : "×";
});
</script>

<!-- ================================= MAIN CONTENT ================================= -->
<div class="main">

    <h2 class="fw-bold">Margin Penjualan</h2>
    <div class="text-muted mb-4">
        Selamat datang kembali, <?= htmlspecialchars($nama_admin) ?>! 👋
    </div>

    <!-- RINGKASAN MARGIN -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card summary-card p-3 shadow-sm">
                <div class="summary-label">Total Omzet</div>
                <div class="summary-value">
                    Rp <?= number_format($total_omzet,0,',','.') ?>
                </div>
                <div class="mt-1 text-muted small">
                    Dari seluruh transaksi penjualan yang tercatat.
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card summary-card p-3 shadow-sm">
                <div class="summary-label">Total PPN Terkumpul</div>
                <div class="summary-value">
                    Rp <?= number_format($total_ppn,0,',','.') ?>
                </div>
                <div class="mt-1 text-muted small">
                    Akumulasi PPN dari semua transaksi.
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card summary-card p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="summary-label">Estimasi Margin Kotor</div>
                        <div class="summary-value">
                            Rp <?= number_format($total_margin,0,',','.') ?>
                        </div>
                    </div>
                    <span class="badge badge-margin"><?= $MARGIN_PERSEN ?>% dari total</span>
                </div>
                <div class="mt-1 text-muted small">
                    Perhitungan estimasi berdasarkan margin tetap <?= $MARGIN_PERSEN ?>% dari total penjualan.
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL DETAIL MARGIN PER TRANSAKSI -->
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Riwayat Margin Penjualan</h5>
            <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak Laporan
            </button>
        </div>
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Total</th>
                    <th>Estimasi Margin (<?= $MARGIN_PERSEN ?>%)</th>
                    <th>Admin</th>
                </tr>
            </thead>

            <tbody>
            <?php if(empty($rows)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data penjualan.</td>
                </tr>
            <?php else: ?>
                <?php foreach($rows as $p): ?>
                <tr>
                    <td><?= $p['idpenjualan'] ?></td>
                    <td><?= $p['created_at'] ?></td>
                    <td>Rp <?= number_format($p['subtotal_nilai'],0,',','.') ?></td>
                    <td>Rp <?= number_format($p['ppn'],0,',','.') ?></td>
                    <td>Rp <?= number_format($p['total_nilai'],0,',','.') ?></td>
                    <td class="text-success fw-semibold">
                        Rp <?= number_format($p['margin_nilai'],0,',','.') ?>
                    </td>
                    <td><?= htmlspecialchars($p['nama_lengkap']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
