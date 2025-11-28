<?php
include "../../config/database.php";
session_start();

// Nama admin
$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

// Query daftar penjualan
$qPenjualan = mysqli_query($conn, "
    SELECT pj.idpenjualan, pj.created_at, pj.subtotal_nilai, pj.ppn, pj.total_nilai,
           u.nama_lengkap
    FROM penjualan pj
    LEFT JOIN user u ON u.iduser = pj.iduser
    ORDER BY pj.idpenjualan DESC
");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Penjualan</title>

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
        <a href="penjualan.php"><i class="bi bi-receipt"></i><span>Transaksi Penjualan</span></a>
        <a href="../margin_penjualan/margin_penjualan.php"><i class="bi bi-graph-up-arrow"></i><span>Margin Penjualan</span></a>
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

    <h2 class="fw-bold">Penjualan Barang</h2>
    <div class="text-muted mb-4">Selamat datang kembali, <?= $nama_admin ?>! 👋</div>

    <a href="tambah_penjualan.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Penjualan
    </a>

    <div class="card p-3">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Total</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php while($p = mysqli_fetch_assoc($qPenjualan)): ?>
                <tr>
                    <td><?= $p['idpenjualan'] ?></td>
                    <td><?= $p['created_at'] ?></td>
                    <td>Rp <?= number_format($p['subtotal_nilai'],0,',','.') ?></td>
                    <td>Rp <?= number_format($p['ppn'],0,',','.') ?></td>
                    <td>Rp <?= number_format($p['total_nilai'],0,',','.') ?></td>
                    <td><?= $p['nama_lengkap'] ?></td>
                    <td>
                        <a href="detail_penjualan.php?id=<?= $p['idpenjualan'] ?>" class="btn btn-info btn-sm">Detail</a>
                        <a href="edit_penjualan.php?id=<?= $p['idpenjualan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus?')"
                           href="hapus_penjualan.php?id=<?= $p['idpenjualan'] ?>"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
