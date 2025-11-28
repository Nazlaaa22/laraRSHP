<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'] ?? 0;

// Ambil data user
$qUser = mysqli_query($conn, "
    SELECT u.iduser, u.username, u.nama_lengkap, u.status, r.nama_role
    FROM user u
    LEFT JOIN role r ON r.idrole = u.idrole
    WHERE u.iduser = '$id'
");

$data = mysqli_fetch_assoc($qUser);

// jika user tidak ditemukan
if (!$data) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

$statusView = ($data['status'] == 'y')
    ? '<span class="badge bg-success">Aktif</span>'
    : '<span class="badge bg-danger">Nonaktif</span>';
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail User</title>

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
        <h4 class="fw-bold mb-3">Detail User</h4>
        <hr>

        <div class="mb-3">
            <div class="label">ID User</div>
            <div class="value"><?= $data['iduser'] ?></div>
        </div>

        <div class="mb-3">
            <div class="label">Nama Lengkap</div>
            <div class="value"><?= htmlspecialchars($data['nama_lengkap']) ?></div>
        </div>

        <div class="mb-3">
            <div class="label">Username</div>
            <div class="value"><?= htmlspecialchars($data['username']) ?></div>
        </div>

        <div class="mb-3">
            <div class="label">Role</div>
            <div class="value"><?= htmlspecialchars($data['nama_role']) ?></div>
        </div>

        <div class="mb-3">
            <div class="label">Status</div>
            <div class="value"><?= $statusView ?></div>
        </div>

        <hr>
        <a href="user.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

</body>
</html>
