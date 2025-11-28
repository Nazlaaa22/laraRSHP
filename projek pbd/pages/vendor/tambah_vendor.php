<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

if (isset($_POST['simpan'])) {
    $nama_vendor = $_POST['nama_vendor'];
    $badan_hukum = $_POST['badan_hukum'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        INSERT INTO vendor (nama_vendor, badan_hukum, status)
        VALUES ('$nama_vendor', '$badan_hukum', '$status')
    ");

    echo "<script>alert('Vendor berhasil ditambahkan!'); window.location='vendor.php';</script>";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Vendor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width: 60%; margin:auto; margin-top:50px; border-radius:15px; }
</style>
</head>
<body>

<div class="container">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Tambah Vendor</h4>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Vendor</label>
                <input type="text" name="nama_vendor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Legal / Badan Hukum</label>
                <select name="badan_hukum" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="y">Ya</option>
                    <option value="t">Tidak</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="y">Aktif</option>
                    <option value="n">Nonaktif</option>
                    <option value="t">Tutup</option>
                </select>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Simpan
            </button>
            <a href="vendor.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

</body>
</html>
