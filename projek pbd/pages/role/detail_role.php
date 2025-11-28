<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'] ?? 0;

// Ambil data role berdasarkan idrole
$qRole = mysqli_query($conn, "
    SELECT idrole, nama_role 
    FROM role 
    WHERE idrole = '$id'
");

$data = mysqli_fetch_assoc($qRole);

// Jika role tidak ditemukan
if (!$data) {
    echo "<script>alert('Role tidak ditemukan!'); window.location='role.php';</script>";
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Role</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width:60%; margin:auto; margin-top:50px; border-radius:14px; }
.label { font-weight:600; color:#555; }
.value { font-size:18px; }
</style>
</head>

<body>

<div class="container">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Detail Role</h4>
        <hr>

        <div class="mb-3">
            <div class="label">ID Role</div>
            <div class="value"><?= $data['idrole'] ?></div>
        </div>

        <div class="mb-3">
            <div class="label">Nama Role</div>
            <div class="value"><?= htmlspecialchars($data['nama_role']) ?></div>
        </div>

        <hr>

        <a href="role.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

</body>
</html>
