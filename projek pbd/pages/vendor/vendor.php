<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

$qVendors = mysqli_query($conn, "SELECT idvendor, nama_vendor, badan_hukum, status FROM vendor ORDER BY idvendor ASC");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manajemen Vendor</title>

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

.table thead th { vertical-align: middle; }
.table td.id-col { width: 80px; padding-left: 1.25rem; }
.table td.name-col { padding-left: 0.5rem; }
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

<!-- MAIN -->
<div class="main">
    <h2 class="fw-bold">Vendor</h2>
    <div class="text-muted mb-4">Selamat datang kembali, <?= htmlspecialchars($nama_admin) ?>! 👋</div>

    <h4 class="fw-bold mb-3">Daftar Vendor</h4>

    <!-- TOMBOL TAMBAH VENDOR -->
    <a href="tambah_vendor.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Vendor
    </a>

    <div class="card p-3 mb-4">
        <div class="row align-items-center">
            <div class="col-md-12">
                <input id="search" type="text" class="form-control" placeholder="Cari vendor (nama)..." onkeyup="filterTable()">
            </div>
        </div>
    </div>

    <div class="card p-3">
        <table id="vendorTable" class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th class="id-col">ID</th>
                    <th class="name-col">Nama Vendor</th>
                    <th>Legal / Badan Hukum</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($v = mysqli_fetch_assoc($qVendors)): ?>
                <tr>
                    <td class="id-col"><?= $v['idvendor'] ?></td>
                    <td class="name-col"><?= htmlspecialchars($v['nama_vendor']) ?></td>
                    <td><?= htmlspecialchars($v['badan_hukum']) ?></td>
                    <td class="text-center">
                        <?php
                        $status = strtolower(trim($v['status']));
                        if ($status == 'a' || $status == '1' || $status == 'y') {
                            echo '<span class="badge bg-success">Aktif</span>';
                        }
                        elseif ($status == 't') {
                            echo '<span class="badge bg-warning text-dark">Tutup</span>';
                        }
                        else {
                            echo '<span class="badge bg-secondary">Nonaktif</span>';
                        }
                        ?>
                    </td>
                    <td class="text-end">
                        <a href="detail_vendor.php?id=<?= $v['idvendor'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                        <a href="edit_vendor.php?id=<?= $v['idvendor'] ?>" class="btn btn-sm p-0 text-warning" title="Edit">
                            <i class="bi bi-pencil-square fs-5"></i></a>

                        <a href="hapus_vendor.php?id=<?= $v['idvendor'] ?>"
                        onclick="return confirm('Yakin hapus vendor ini?')"
                        class="btn btn-sm p-0 text-danger" title="Hapus"><i class="bi bi-trash3 fs-5"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function filterTable(){
    const q = document.getElementById('search').value.toLowerCase();
    const rows = document.querySelectorAll('#vendorTable tbody tr');
    rows.forEach(r=>{
        const name = r.cells[1].innerText.toLowerCase();
        r.style.display = name.indexOf(q) > -1 ? '' : 'none';
    });
}
</script>

</body>
</html>
