<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

// Ambil id barang dari URL
$idbarang = $_GET['id'] ?? 0;

// Ambil info barang
$qBarang = mysqli_query($conn, "
    SELECT 
        b.idbarang,
        b.nama,
        b.stok,
        s.nama_satuan AS satuan
    FROM barang b
    LEFT JOIN satuan s ON b.idsatuan = s.idsatuan
    WHERE b.idbarang = '$idbarang'
");

$barang = mysqli_fetch_assoc($qBarang);

if (!$barang) {
    echo "<script>alert('Barang tidak ditemukan'); window.location='kartu_stok.php';</script>";
    exit;
}

// Ambil mutasi masuk/keluar
$qMutasi = mysqli_query($conn, "
    SELECT * FROM (
        -- MASUK
        SELECT 
            pn.created_at AS tanggal,
            CONCAT('Penerimaan #', pn.idpenerimaan) AS keterangan,
            dp.jumlah_terima AS masuk,
            0 AS keluar
        FROM detail_penerimaan dp
        JOIN penerimaan pn ON pn.idpenerimaan = dp.idpenerimaan
        WHERE dp.barang_idbarang = '$idbarang'

        UNION ALL

        -- KELUAR
        SELECT
            pj.created_at AS tanggal,
            CONCAT('Penjualan #', pj.idpenjualan) AS keterangan,
            0 AS masuk,
            dj.jumlah AS keluar
        FROM detail_penjualan dj
        JOIN penjualan pj ON pj.idpenjualan = dj.idpenjualan
        WHERE dj.idbarang = '$idbarang'
    ) AS mutasi
    ORDER BY tanggal ASC
");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Detail Kartu Stok - Glow Skincare</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
    --sidebar-w:260px;
    --card-radius:14px;
    --shadow:0 12px 30px rgba(2,6,23,0.06);
}
body{
    font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto;
    background:#f3f4f6;
    margin:0;
}

/* Sidebar */
.sidebar {
    position: fixed; top:0; left:0;
    width: var(--sidebar-w); height: 100vh;
    background: linear-gradient(180deg,#6a11cb,#c61fab);
    color: #fff; padding: 25px; transition:.3s;
    overflow-y:auto; z-index:999;
}
.sidebar.closed { width:80px; }
.sidebar .brand{display:flex;justify-content:space-between;align-items:center;}
.sidebar.closed h5, .sidebar.closed small {display:none;}
.sidebar nav a{padding:12px 0;display:flex;align-items:center;color:white;text-decoration:none;font-size:16px}
.sidebar nav a i{margin-right:10px}
.sidebar.closed nav a span{display:none}
#toggleSidebar{background:rgba(255,255,255,.3);border:none;color:#fff;width:36px;height:36px;border-radius:10px;font-size:20px;cursor:pointer}

.main{margin-left:var(--sidebar-w);padding:30px;transition:.3s;}
.sidebar.closed ~ .main{margin-left:80px;}

.card-white{
    background:#fff;border-radius:var(--card-radius);
    padding:20px;box-shadow:var(--shadow);
}

th{text-align:center;background:#9333ea;color:#fff}
td{text-align:center;}
</style>
</head>

<body>

<!-- SIDEBAR -->
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
        <a href="../penerimaan/penerimaan.php"><i class="bi bi-box-arrow-in-down"></i><span>Penerimaan</span></a>
        <a href="../retur/retur.php"><i class="bi bi-arrow-repeat"></i><span>Retur</span></a>
        <a href="../penjualan/penjualan.php"><i class="bi bi-receipt"></i><span>Transaksi Penjualan</span></a>
        <a href="../margin_penjualan/margin_penjualan.php"><i class="bi bi-graph-up-arrow"></i><span>Margin Penjualan</span></a>
        <a href="kartu_stok.php"><i class="bi bi-clipboard-data"></i><span>Kartu Stok</span></a>

        <hr style="opacity:.3">
        <a href="../user/user.php"><i class="bi bi-people"></i><span>User</span></a>
        <a href="../role/role.php"><i class="bi bi-shield-lock"></i><span>Role</span></a>

        <hr style="opacity:.3">
        <a href="../../logout.php"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="main">
    <h2 class="fw-bold">Detail Kartu Stok</h2>
    <small class="text-muted">
        Barang: <strong><?= htmlspecialchars($barang['nama']) ?></strong>
        | Satuan: <?= $barang['satuan'] ?> |
        Stok Akhir: <strong><?= $barang['stok'] ?></strong>
    </small>

    <a href="kartu_stok.php" class="btn btn-secondary btn-sm mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card-white mt-3">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Stok Berjalan</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            $running = 0; 

            if (mysqli_num_rows($qMutasi) == 0): ?>
                <tr>
                    <td colspan="6" class="text-muted">Belum ada riwayat pergerakan stok.</td>
                </tr>
            <?php else: ?>
                <?php while($m = mysqli_fetch_assoc($qMutasi)): 
                    $running = $running + $m['masuk'] - $m['keluar'];
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $m['tanggal'] ?></td>
                    <td class="text-start"><?= $m['keterangan'] ?></td>
                    <td class="text-success fw-bold"><?= $m['masuk'] ?></td>
                    <td class="text-danger fw-bold"><?= $m['keluar'] ?></td>
                    <td class="fw-bold"><?= $running ?></td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
const sb = document.getElementById("sidebar");
document.getElementById("toggleSidebar").addEventListener("click",()=>sb.classList.toggle("closed"));
</script>

</body>
</html>
