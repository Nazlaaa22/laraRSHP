<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

/* Ambil ID vendor dari parameter URL */
$id = $_GET['id'];

/* Ambil data vendor berdasarkan ID */
$q = mysqli_query($conn, "SELECT * FROM vendor WHERE idvendor='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>alert('Data vendor tidak ditemukan'); window.location='vendor.php';</script>";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Vendor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width: 65%; margin:auto; margin-top:40px; border-radius:15px; }
.label { font-weight:600; color:#555; }
</style>
</head>

<body>

<div class="container">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-4">Detail Vendor</h4>

        <div class="mb-3">
            <span class="label">ID Vendor:</span><br>
            <?= $data['idvendor'] ?>
        </div>

        <div class="mb-3">
            <span class="label">Nama Vendor:</span><br>
            <?= htmlspecialchars($data['nama_vendor']) ?>
        </div>

        <div class="mb-3">
            <span class="label">Legal / Badan Hukum:</span><br>
            <?= htmlspecialchars($data['badan_hukum']) == 'y' ? 'Ya' : 'Tidak' ?>
        </div>

        <div class="mb-3">
            <span class="label">Status Vendor:</span><br>
            <?php
            $status = strtolower(trim($data['status']));
            if ($status == 'y' || $status == '1' || $status == 'a') {
                echo '<span class="badge bg-success">Aktif</span>';
            } elseif ($status == 't') {
                echo '<span class="badge bg-warning text-dark">Tutup</span>';
            } else {
                echo '<span class="badge bg-secondary">Nonaktif</span>';
            }
            ?>
        </div>

        <div class="mt-4">
            <a href="vendor.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a href="edit_vendor.php?id=<?= $data['idvendor'] ?>" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    </div>
</div>

</body>
</html>
