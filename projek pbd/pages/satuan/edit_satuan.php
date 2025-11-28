<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

/* Ambil ID dari link */
$id = $_GET['id'];

/* Ambil data satuan yang akan diedit */
$query = mysqli_query($conn, "SELECT * FROM satuan WHERE idsatuan='$id'");
$data = mysqli_fetch_assoc($query);

/* Jika tombol update ditekan */
if (isset($_POST['update'])) {
    $nama = $_POST['nama_satuan'];

    mysqli_query($conn, "UPDATE satuan SET nama_satuan='$nama' WHERE idsatuan='$id'");
    echo "<script>alert('Data berhasil diperbarui');window.location='satuan.php';</script>";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Satuan</title>

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
        <h4 class="fw-bold mb-3">Edit Satuan</h4>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Satuan</label>
                <input type="text" name="nama_satuan" class="form-control" value="<?= $data['nama_satuan'] ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Update
            </button>

            <a href="satuan.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

</body>
</html>
