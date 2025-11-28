<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = intval($_GET['id']);

$q = mysqli_query($conn, "SELECT 
        b.*, 
        s.nama_satuan 
    FROM barang b
    LEFT JOIN satuan s ON s.idsatuan = b.idsatuan
    WHERE idbarang = $id");

if (mysqli_num_rows($q) == 0) {
    echo "<h3>Produk tidak ditemukan!</h3>";
    exit;
}

$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <a href="produk.php" class="btn btn-secondary mb-4">← Kembali</a>

    <div class="card shadow-sm p-4">

        <h3 class="fw-bold mb-4">Detail Produk</h3>

        <table class="table table-bordered">
            <tr>
                <th width="200">Nama Produk</th>
                <td><?= $data['nama'] ?></td>
            </tr>

            <tr>
                <th>Jenis</th>
                <td><?= $data['jenis'] ?></td>
            </tr>

            <tr>
                <th>Satuan</th>
                <td><?= $data['nama_satuan'] ?></td>
            </tr>

            <tr>
                <th>Stok</th>
                <td><?= $data['stok'] ?> unit</td>
            </tr>

            <tr>
                <th>Harga</th>
                <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <?php if ($data['status'] == 1): ?>
                        <span class="badge bg-success">Aktif</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Nonaktif</span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Dibuat Pada</th>
                <td><?= $data['created_at'] ?></td>
            </tr>
        </table>

        <div class="mt-4">
            <a href="edit_produk.php?id=<?= $data['idbarang'] ?>" class="btn btn-warning">
                ✏ Edit Produk
            </a>

            <a href="hapus_produk.php?id=<?= $data['idbarang'] ?>"
               onclick="return confirm('Hapus produk ini?')"
               class="btn btn-danger">
                🗑 Hapus Produk
            </a>
        </div>

    </div>
</div>

</body>
</html>
