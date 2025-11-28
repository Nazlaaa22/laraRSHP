<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM barang WHERE idbarang = $id");
$p = mysqli_fetch_assoc($q);

if (!$p) {
    echo "Produk tidak ditemukan!";
    exit;
}

// PROSES UPDATE
if (isset($_POST['update'])) {

    $nama  = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $satuan = $_POST['idsatuan'];
    $stok  = $_POST['stok'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE barang SET
            nama = '$nama',
            jenis = '$jenis',
            idsatuan = $satuan,
            stok = $stok,
            harga = $harga,
            status = $status
        WHERE idbarang = $id
    ");

    header("Location: produk.php");
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Edit Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <a href="../produk/produk.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card p-4">
        <h3 class="mb-3">Edit Produk</h3>

        <form method="POST">

            <label class="fw-bold">Nama Produk</label>
            <input type="text" name="nama" value="<?= $p['nama'] ?>" class="form-control mb-3" required>

            <label class="fw-bold">Jenis</label>
            <select name="jenis" class="form-control mb-3" required>
                <option value="S" <?= $p['jenis']=='S'?'selected':'' ?>>Serum</option>
                <option value="M" <?= $p['jenis']=='M'?'selected':'' ?>>Moisturizer</option>
                <option value="C" <?= $p['jenis']=='C'?'selected':'' ?>>Cleanser</option>
                <option value="U" <?= $p['jenis']=='U'?'selected':'' ?>>Sunscreen</option>
                <option value="T" <?= $p['jenis']=='T'?'selected':'' ?>>Toner</option>
            </select>

            <label class="fw-bold">Satuan</label>
            <select name="idsatuan" class="form-control mb-3">
                <option value="1" <?= $p['idsatuan']==1?'selected':'' ?>>PCS</option>
                <option value="2" <?= $p['idsatuan']==2?'selected':'' ?>>BOX</option>
            </select>

            <label class="fw-bold">Stok</label>
            <input type="number" name="stok" value="<?= $p['stok'] ?>" class="form-control mb-3" required>

            <label class="fw-bold">Harga</label>
            <input type="number" name="harga" value="<?= $p['harga'] ?>" class="form-control mb-3" required>

            <label class="fw-bold">Status</label>
            <select name="status" class="form-control mb-3">
                <option value="1" <?= $p['status']==1?'selected':'' ?>>Aktif</option>
                <option value="0" <?= $p['status']==0?'selected':'' ?>>Nonaktif</option>
            </select>

            <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>

        </form>
    </div>
</div>

</body>
</html>
