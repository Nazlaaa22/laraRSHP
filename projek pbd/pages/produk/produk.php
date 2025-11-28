<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

/* ==== SEARCH FILTER ==== */
$cari = $_GET['cari'] ?? '';

$where = "";
if ($cari != "") {
    $where = "WHERE nama LIKE '%$cari%'";
}

$jenis = $_GET['jenis'] ?? '';
$status = $_GET['status'] ?? '';

$where = [];

if ($cari != "") {
    $where[] = "nama LIKE '%$cari%'";
}

if ($jenis != "") {
    $where[] = "jenis = '$jenis'";
}

if ($status != "") {
    $where[] = "status = '$status'";
}

$whereSql = "";
if (!empty($where)) {
    $whereSql = "WHERE " . implode(" AND ", $where);
}

/* ==== QUERY PRODUK ==== */
$qProduk = mysqli_query($conn, "
    SELECT idbarang, nama, jenis, stok, harga, status
    FROM barang
    $whereSql
    ORDER BY idbarang DESC
");

?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manajemen Produk</title>

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

<!-- ======== SIDEBAR ======== -->
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



<!-- ======== MAIN CONTENT ======== -->
<div class="main">

    <h2 class="fw-bold">Produk</h2>
    <div class="text-muted mb-4">
        Selamat datang kembali, <?= htmlspecialchars($nama_admin) ?>! 👋
    </div>

    <h4 class="fw-bold mb-3">Manajemen Produk</h4>

    <a href="tambah_produk.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>

    <div class="card p-3 mb-4">
        <form method="GET">
            <input type="text" name="cari" value="<?= $_GET['cari'] ?? '' ?>" class="form-control mb-3" placeholder="Cari produk..."></form>
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-5">
                <select name="jenis" class="form-control">
                    <option value="">-- Filter Jenis --</option>
                    <option value="S">Serum</option>
                    <option value="M">Moisturizer</option>
                    <option value="T">Toner</option>
                    <option value="C">Cleanser</option>
                </select>
            </div>

            <div class="col-md-5">
                <select name="status" class="form-control">
                    <option value="">-- Filter Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-secondary w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
        </form>

        <a href="export_produk.php" class="btn btn-outline-secondary"><i class="bi bi-download"></i> Export</a>

    </div>

    <div class="card p-3">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php while($row = mysqli_fetch_assoc($qProduk)): ?>
                <tr>
                    <td><strong><?= $row['nama'] ?></strong></td>

                    <td><?= $row['jenis'] ?></td>

                    <td><?= $row['stok'] ?> unit</td>

                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>

                    <td>
                        <?php if($row['status'] == 1): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="detail_produk.php?id=<?= $row['idbarang'] ?>" class="text-primary me-2"><i class="bi bi-eye"></i></a>
                        <a href="edit_produk.php?id=<?= $row['idbarang'] ?>" class="text-success me-2"><i class="bi bi-pencil"></i></a>
                        <a href="hapus_produk.php?id=<?= $row['idbarang'] ?>" class="text-danger"onclick="return confirm('Yakin ingin menghapus produk ini?');"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
