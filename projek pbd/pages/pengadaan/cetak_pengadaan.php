<?php
include "../../config/database.php";
session_start();

// CEK ID
if (!isset($_GET['id'])) {
    die("ID pengadaan tidak ditemukan!");
}

$idpengadaan = $_GET['id'];

// AMBIL HEADER
$qHead = mysqli_query($conn, "
    SELECT p.*, v.nama_vendor, u.nama_lengkap
    FROM pengadaan p
    LEFT JOIN vendor v ON v.idvendor = p.idvendor
    LEFT JOIN user u ON u.iduser = p.iduser
    WHERE p.idpengadaan = '$idpengadaan'
");

$head = mysqli_fetch_assoc($qHead);

// AMBIL DETAIL PRODUK
$qDetail = mysqli_query($conn, "
    SELECT dp.*, b.nama
    FROM detail_pengadaan dp
    LEFT JOIN barang b ON b.idbarang = dp.idbarang
    WHERE dp.idpengadaan = '$idpengadaan'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Pengadaan #<?= $idpengadaan ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { padding: 30px; font-size: 14px; }
        .table th { background: #eee; }
        .header-title { font-size: 26px; font-weight: bold; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="no-print mb-3">
    <a onclick="window.print()" class="btn btn-primary">🖨 Cetak</a>
    <a href="detail_pengadaan.php?id=<?= $idpengadaan ?>" class="btn btn-secondary">← Kembali</a>
</div>

<div class="text-center mb-4">
    <div class="header-title">Glow Skincare</div>
    <div>Invoice Pengadaan</div>
    <hr>
</div>

<table class="table table-bordered">
    <tr>
        <th width="200">ID Pengadaan</th>
        <td><?= $head['idpengadaan'] ?></td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td><?= $head['tanggal'] ?></td>
    </tr>
    <tr>
        <th>Vendor</th>
        <td><?= $head['nama_vendor'] ?></td>
    </tr>
    <tr>
        <th>Admin Input</th>
        <td><?= $head['nama_lengkap'] ?></td>
    </tr>
</table>

<h5 class="mt-4 mb-2">Detail Produk</h5>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Produk</th>
            <th width="80">Qty</th>
            <th width="150">Harga</th>
            <th width="150">Subtotal</th>
        </tr>
    </thead>

    <tbody>
    <?php while ($d = mysqli_fetch_assoc($qDetail)): ?>
        <tr>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($d['sub_total'], 0, ',', '.') ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<div class="text-end mt-3">
    <p><strong>Subtotal:</strong> Rp <?= number_format($head['subtotal_nilai'], 0, ',', '.') ?></p>
    <p><strong>PPN (11%):</strong> Rp <?= number_format($head['ppn'], 0, ',', '.') ?></p>
    <h4><strong>Total:</strong> Rp <?= number_format($head['total_nilai'], 0, ',', '.') ?></h4>
</div>

<hr>
<p class="text-center">Terima kasih telah melakukan pengadaan di Glow Skincare 💜</p>

</body>
</html>
