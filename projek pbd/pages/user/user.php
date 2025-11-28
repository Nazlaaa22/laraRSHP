<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

// Ambil data user
$qUser = mysqli_query($conn, "
    SELECT u.iduser, u.username, u.nama_lengkap, u.status, r.nama_role
    FROM user u 
    LEFT JOIN role r ON r.idrole = u.idrole
    ORDER BY u.iduser ASC
");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manajemen User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }

:root { --sidebar-w:260px; }

.sidebar{
    position:fixed;
    top:0;left:0;
    width:var(--sidebar-w);
    height:100vh;
    background:linear-gradient(180deg,#6a11cb,#c61fab);
    color:#fff;
    padding:25px;
    transition:.3s;
    z-index:999;
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

.sidebar.closed{width:80px;}
.sidebar .brand{display:flex;justify-content:space-between;align-items:center;}
.sidebar.closed h5,
.sidebar.closed small{display:none;}
.sidebar nav a{
    padding:12px 0;
    display:flex;
    align-items:center;
    color:#fff;
    text-decoration:none;
    font-size:16px;
}
.sidebar nav a i{margin-right:10px;}
.sidebar.closed nav a span{display:none;}
#toggleSidebar{
    background:rgba(255,255,255,.3);
    border:none;
    color:#fff;
    width:36px;
    height:36px;
    border-radius:10px;
    font-size:20px;
    cursor:pointer;
}

.main{
    margin-left:var(--sidebar-w);
    padding:30px;
    transition:.3s;
}
.sidebar.closed ~ .main{margin-left:80px;}
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
        <a href="../../logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
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

<!-- MAIN CONTENT -->
<div class="main">
    <h2 class="fw-bold">User</h2>
    <div class="text-muted mb-4">Selamat datang kembali, <?= htmlspecialchars($nama_admin) ?>! 👋</div>

    <a href="tambah_user.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>

    <div class="card p-3">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($u = mysqli_fetch_assoc($qUser)): ?>
                <tr>
                    <td><?= $u['iduser'] ?></td>
                    <td><?= htmlspecialchars($u['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['nama_role']) ?></td>
                    <td>
                        <?= ($u['status'] == 'y') 
                            ? '<span class="badge bg-success">Aktif</span>'
                            : '<span class="badge bg-danger">Nonaktif</span>' ?>
                    </td>
                    <td class="text-end">
                        <a href="detail_user.php?id=<?= $u['iduser'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <a href="edit_user.php?id=<?= $u['iduser'] ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                        <a href="hapus_user.php?id=<?= $u['iduser'] ?>" class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Yakin hapus user ini?')">
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
