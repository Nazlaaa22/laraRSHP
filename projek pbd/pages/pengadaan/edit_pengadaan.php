<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'];
$q = mysqli_query($conn, "
    SELECT p.*, v.nama_vendor 
    FROM pengadaan p
    LEFT JOIN vendor v ON v.idvendor = p.idvendor
    WHERE idpengadaan='$id'
");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengadaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container p-4">
    <h3>Edit Pengadaan</h3>
    <form action="proses_edit_pengadaan.php" method="POST">

        <input type="hidden" name="idpengadaan" value="<?= $data['idpengadaan'] ?>">

        <label>Vendor</label>
        <input class="form-control mb-3" readonly value="<?= $data['nama_vendor'] ?>">

        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control mb-3"
               value="<?= $data['tanggal'] ?>">

        <label>Status</label>
        <select name="status" class="form-control mb-3">
            <option value="a" <?= $data['status']=='a'?'selected':'' ?>>Aktif</option>
            <option value="n" <?= $data['status']=='n'?'selected':'' ?>>Nonaktif</option>
        </select>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="pengadaan.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

</body>
</html>
