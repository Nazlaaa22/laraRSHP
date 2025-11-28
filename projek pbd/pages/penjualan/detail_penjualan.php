<?php
include "../../config/database.php";
session_start();

// CEK PARAMETER ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Penjualan tidak ditemukan!');window.location='penjualan.php';</script>";
    exit;
}

$id = $_GET['id'];

// QUERY DATA PENJUALAN
$qPenj = mysqli_query($conn, "
    SELECT p.*, u.nama_lengkap
    FROM penjualan p
    LEFT JOIN user u ON u.iduser = p.iduser
    WHERE p.idpenjualan='$id'
");
$p = mysqli_fetch_assoc($qPenj);

// QUERY DETAIL PRODUK
$qDetail = mysqli_query($conn, "
    SELECT dp.*, b.nama
    FROM detail_penjualan dp
    LEFT JOIN barang b ON b.idbarang = dp.idbarang
    WHERE dp.idpenjualan='$id'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Penjualan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container py-4">

<a href="penjualan.php" class="btn btn-secondary mb-3">← Kembali</a>
<div class="card p-4 shadow-sm">

<h3 class="fw-bold mb-3">Detail Penjualan</h3>

<p><strong>ID #:</strong> <?= $p['idpenjualan'] ?></p>
<p><strong>Tanggal:</strong> <?= $p['created_at'] ?></p>
<p><strong>Admin:</strong> <?= $p['nama_lengkap'] ?></p>

<hr>

<table class="table table-bordered table-hover">
<thead>
<tr class="table-dark">
    <th>No</th>
    <th>Produk</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
</tr>
</thead>

<tbody>
<?php 
$no=1;
while($d = mysqli_fetch_assoc($qDetail)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama'] ?></td>
    <td>Rp <?= number_format($d['harga_satuan'],0,',','.') ?></td>
    <td><?= $d['jumlah'] ?></td>
    <td>Rp <?= number_format($d['subtotal'],0,',','.') ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<div class="text-end">
<p>Subtotal: <strong>Rp <?= number_format($p['subtotal_nilai'],0,',','.') ?></strong></p>
<p>PPN: <strong>Rp <?= number_format($p['ppn'],0,',','.') ?></strong></p>
<h4>Total: <strong>Rp <?= number_format($p['total_nilai'],0,',','.') ?></strong></h4>
</div>

<a href="print_penjualan.php?id=<?= $p['idpenjualan'] ?>" target="_blank" class="btn btn-primary mt-3">🖨 Cetak Invoice</a>

</div>
</div>
</body>
</html>
