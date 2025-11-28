<?php
include "../../config/database.php";
session_start();

// CEK ID
if (!isset($_GET['id'])) {
    header("Location: pengadaan.php");
    exit;
}

$idpengadaan = $_GET['id'];

// ================================
// AMBIL DATA PENGADAAN
// ================================
$qHead = mysqli_query($conn, "
    SELECT p.*, v.nama_vendor, u.nama_lengkap 
    FROM pengadaan p
    LEFT JOIN vendor v ON v.idvendor = p.idvendor
    LEFT JOIN user u ON u.iduser = p.iduser
    WHERE p.idpengadaan = '$idpengadaan'
");

if (mysqli_num_rows($qHead) == 0) {
    echo "<h3>Pengadaan tidak ditemukan!</h3>";
    exit;
}

$head = mysqli_fetch_assoc($qHead);

// Prevent NULL values
$subtotal = isset($head['subtotal_nilai']) ? (int)$head['subtotal_nilai'] : 0;
$ppn      = isset($head['ppn']) ? (int)$head['ppn'] : 0;
$total    = isset($head['total_nilai']) ? (int)$head['total_nilai'] : 0;

// ================================
// DETAIL BARANG
// ================================
$qDetail = mysqli_query($conn, "
    SELECT dp.*, b.nama 
    FROM detail_pengadaan dp
    LEFT JOIN barang b ON b.idbarang = dp.idbarang
    WHERE dp.idpengadaan = '$idpengadaan'
");
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Detail Pengadaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <a href="pengadaan.php" class="btn btn-secondary mb-4">← Kembali</a>
    <a href="cetak_pengadaan.php?id=<?= $idpengadaan ?>"target="_blank"class="btn btn-success mb-4">🖨 Cetak Pengadaan</a>

    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold">Detail Pengadaan</h3>

        <table class="table table-bordered mt-3">
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
            <tr>
                <th>Status</th>
                <td>
                    <?= ($head['status'] == 'a') 
                        ? '<span class="badge bg-success">Aktif</span>' 
                        : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="card shadow-sm p-4">

        <h4 class="fw-bold mb-3">Produk Dibeli</h4>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($d = mysqli_fetch_assoc($qDetail)): ?>

                <?php
                    $hargaItem = isset($d['harga']) ? (int)$d['harga'] : 0;
                    $subItem   = isset($d['subtotal']) ? (int)$d['subtotal'] : 0;
                ?>

                <tr>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['jumlah'] ?></td>
                    <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($d['jumlah'] * $d['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>

        <hr>

        <div class="text-end">
            <p><strong>Subtotal:</strong> Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
            <p><strong>PPN (11%):</strong> Rp <?= number_format($ppn, 0, ',', '.') ?></p>
            <h4><strong>Total:</strong> Rp <?= number_format($total, 0, ',', '.') ?></h4>
        </div>

    </div>

</div>

</body>
</html>
