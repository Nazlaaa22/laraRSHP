<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }

:root { --sidebar-w: 260px; }

.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: var(--sidebar-w);
    height: 100vh;
    background: linear-gradient(180deg,#6a11cb,#c61fab);
    color: #fff;
    padding: 25px;
    transition: 0.3s;
    z-index: 999;
}

.sidebar.closed { width: 80px; }

.sidebar .brand { display: flex; justify-content: space-between; align-items: center; }
.sidebar.closed h5, .sidebar.closed small { display: none; }

.sidebar nav a {
    padding: 12px 0;
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.sidebar nav a i { margin-right: 10px; }
.sidebar.closed nav a span { display: none; }

#toggleSidebar {
    background: rgba(255,255,255,0.3);
    border: none;
    color: #fff;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    font-size: 20px;
    cursor: pointer;
}

.main {
    margin-left: var(--sidebar-w);
    padding: 40px;
    transition: 0.3s;
}

.sidebar.closed ~ .main { margin-left: 80px; }

.card {
    max-width: 750px;
    margin: auto;
}
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
        <a href="produk.php"><i class="bi bi-box-seam"></i><span>Kategori Produk</span></a>
        <a href="transaksi.php"><i class="bi bi-receipt"></i><span>Transaksi</span></a>
        <a href="pelanggan.php"><i class="bi bi-people"></i><span>Pelanggan</span></a>
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


<!-- ================= MAIN ================= -->
<div class="main">

    <h2 class="fw-bold mb-3">Tambah Produk</h2>
    <p class="text-muted">Isi data produk skincare yang ingin ditambahkan.</p>

    <a href="produk.php" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card p-4 shadow-sm">

        <form action="proses_tambah_produk.php" method="POST">

            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control mb-3" required>

            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select mb-3" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="S">Serum</option>
                <option value="C">Cleanser</option>
                <option value="T">Toner</option>
                <option value="M">Moisturizer</option>
                <option value="U">Sunscreen</option>
                <option value="K">Krim</option>
            </select>

            <label class="form-label">Satuan</label>
            <select name="idsatuan" class="form-select mb-3">
                <option value="1">PCS</option>
                <option value="2">BOTOL</option>
                <option value="3">TUBE</option>
            </select>

            <label class="form-label">Stok Awal</label>
            <input type="number" name="stok" class="form-control mb-3" required>

            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control mb-3" required>

            <button class="btn btn-primary w-100">
                <i class="bi bi-save"></i> Simpan Produk
            </button>

        </form>
    </div>

</div>

</body>
</html>
