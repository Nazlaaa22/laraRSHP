<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    echo "ID retur tidak ditemukan!";
    exit;
}

$idretur = intval($_GET['id']);

// =====================
//  QUERY HEADER RETUR
// =====================
$qHeader = mysqli_query($conn, "
    SELECT r.*, p.created_at AS tgl_penerimaan,
           p.idpenerimaan,
           v.nama_vendor,
           u.nama_lengkap
    FROM retur r
    JOIN penerimaan p ON p.idpenerimaan = r.idpenerimaan
    JOIN pengadaan pg ON pg.idpengadaan = p.idpengadaan
    JOIN vendor v ON v.idvendor = pg.idvendor
    JOIN user u ON u.iduser = r.iduser
    WHERE r.idretur = '$idretur'
");

$data = mysqli_fetch_assoc($qHeader);

if (!$data) {
    echo "Data retur tidak ditemukan!";
    exit;
}

// =====================
//  QUERY DETAIL RETUR
// =====================
$qDetail = mysqli_query($conn, "
    SELECT dr.*, 
           dp.jumlah_terima,
           dp.harga_satuan_terima,
           b.nama AS nama_barang
    FROM detail_retur dr
    JOIN detail_penerimaan dp ON dp.iddetail_penerimaan = dr.iddetail_penerimaan
    JOIN barang b ON b.idbarang = dp.barang_idbarang
    WHERE dr.idretur = '$idretur'
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Retur Barang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.sidebar {
    position:fixed; top:0; left:0; width:260px; height:100vh;
    background: linear-gradient(180deg, #6a11cb, #c61fab);
    color:white; padding:25px;
}
.sidebar a { color:white; text-decoration:none; display:flex; padding:12px 0; }
.sidebar a i { margin-right:10px; }
.main { margin-left:260px; padding:30px; }
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <h4>Glow Skincare</h4>
    <small>Dashboard Admin</small>

    <nav class="mt-4 d-flex flex-column">
        <a href="../dashboard.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
        <a href="../produk/produk.php"><i class="bi bi-box-seam"></i>Kategori Produk</a>
        <a href="../satuan/satuan.php"><i class="bi bi-tags"></i>Satuan</a>
        <a href="../vendor/vendor.php"><i class="bi bi-shop"></i>Vendor</a>
        <a href="../pengadaan/pengadaan.php"><i class="bi bi-truck"></i>Pengadaan</a>
        <a href="../penerimaan/penerimaan.php"><i class="bi bi-check2-square"></i>Penerimaan</a>
        <a href="retur.php"><i class="bi bi-arrow-return-left"></i>Retur</a>
        <a href="../transaksi.php"><i class="bi bi-receipt"></i>Transaksi</a>
        <a href="../pelanggan.php"><i class="bi bi-people"></i>Pelanggan</a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="main">

    <a href="retur.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card p-4 shadow-sm">
        <h3 class="fw-bold mb-3">Detail Retur Barang</h3>

        <table class="table table-bordered">
            <tr>
                <th width="200">ID Retur</th>
                <td><?= $data['idretur'] ?></td>
            </tr>
            <tr>
                <th>Tanggal Retur</th>
                <td><?= $data['created_at'] ?></td>
            </tr>
            <tr>
                <th>ID Penerimaan</th>
                <td><?= $data['idpenerimaan'] ?></td>
            </tr>
            <tr>
                <th>Vendor</th>
                <td><?= $data['nama_vendor'] ?></td>
            </tr>
            <tr>
                <th>Admin</th>
                <td><?= $data['nama_lengkap'] ?></td>
            </tr>
        </table>

        <h4 class="mt-4">Barang yang Diretur</h4>

        <table class="table table-striped table-hover mt-2">
            <thead class="table-dark">
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Diterima</th>
                    <th>Jumlah Retur</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal Retur</th>
                    <th>Alasan</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $total = 0;
                while($row = mysqli_fetch_assoc($qDetail)):
                    $sub = $row['jumlah'] * $row['harga_satuan_terima'];
                    $total += $sub;
                ?>
                <tr>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah_terima'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>Rp <?= number_format($row['harga_satuan_terima'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($sub, 0, ',', '.') ?></td>
                    <td><?= $row['alasan'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h4 class="text-end mt-3">
            <strong>Total Retur: Rp <?= number_format($total, 0, ',', '.') ?></strong>
        </h4>
    </div>

</div>
</body>
</html>
