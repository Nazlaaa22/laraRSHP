<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_satuan'];

    mysqli_query($conn, "INSERT INTO satuan (nama_satuan) VALUES ('$nama')");
    echo "<script>alert('Satuan berhasil ditambahkan');window.location='satuan.php';</script>";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Satuan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width: 50%; margin:auto; margin-top:50px; }
</style>
</head>
<body>

<div class="container">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Tambah Satuan</h4>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Satuan</label>
                <input type="text" name="nama_satuan" class="form-control" placeholder="Contoh: ml, gr, pcs" required>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>

            <a href="satuan.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

</body>
</html>
