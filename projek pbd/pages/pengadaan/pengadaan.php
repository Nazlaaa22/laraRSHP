<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

$qPengadaan = mysqli_query($conn, "
    SELECT p.idpengadaan, p.tanggal, v.nama_vendor, p.total_nilai 
    FROM pengadaan p
    LEFT JOIN vendor v ON v.idvendor = p.idvendor
    ORDER BY p.idpengadaan DESC
");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Pengadaan</title>

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

<!-- ===================== SIDEBAR ===================== -->
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
        <a href="pengadaan.php"><i class="bi bi-truck"></i><span>Pengadaan</span></a>
        <a href="../penerimaan/penerimaan.php"><i class="bi bi-check2-square"></i><span>Penerimaan</span></a>
        <a href="../retur/retur.php"><i class="bi bi-arrow-repeat"></i><span>Retur</span></a>
        <a href="../penjualan/penjualan.php"><i class="bi bi-receipt"></i><span>Transaksi Penjualan</span></a>
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

<!-- ===================== MAIN ===================== -->
<div class="main">
    <h2 class="fw-bold">Pengadaan</h2>
    <div class="text-muted mb-4">Selamat datang kembali, <?= $nama_admin ?>! 👋</div>

    <a href="tambah_pengadaan.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Pengadaan
    </a>

    <div class="card p-3">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Vendor</th>
                    <th>Total</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php while($r = mysqli_fetch_assoc($qPengadaan)): ?>
                    <tr>
                        <td><?= $r['idpengadaan'] ?></td>
                        <td><?= $r['tanggal'] ?></td>
                        <td><?= $r['nama_vendor'] ?></td>
                        <td>Rp <?= number_format($r['total_nilai'],0,',','.') ?></td>
                        <td class="text-end">
                            
                            <!-- DETAIL -->
                            <a href="detail_pengadaan.php?id=<?= $r['idpengadaan'] ?>" 
                            class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="edit_pengadaan.php?id=<?= $r['idpengadaan'] ?>" 
                            class="btn btn-sm btn-warning text-white">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <!-- HAPUS -->
                            <a href="hapus_pengadaan.php?id=<?= $r['idpengadaan'] ?>" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus pengadaan ini? Data stok akan dikembalikan!');">
                                <i class="bi bi-trash"></i>
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
