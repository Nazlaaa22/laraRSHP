<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'] ?? 0;

// Ambil data role
$qRole = mysqli_query($conn, "
    SELECT idrole, nama_role 
    FROM role 
    WHERE idrole = '$id'
");

$data = mysqli_fetch_assoc($qRole);

// Role tidak ditemukan
if (!$data) {
    echo "<script>alert('Role tidak ditemukan!'); window.location='role.php';</script>";
    exit;
}

// Jika klik update
if (isset($_POST['update'])) {
    $nama_role = $_POST['nama_role'];

    $update = mysqli_query($conn, "
        UPDATE role SET nama_role = '$nama_role' 
        WHERE idrole = '$id'
    ");

    if ($update) {
        echo "<script>alert('Role berhasil diperbarui!'); window.location='role.php';</script>";
    } else {
        echo "<script>alert('Gagal update role: ".mysqli_error($conn)."');</script>";
    }
}
?>
<!doctype html>
<html lang='id'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Edit Role</title>

<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width:60%; margin:auto; margin-top:50px; border-radius:14px; }
</style>
</head>

<body>

<div class='container'>
    <div class='card shadow p-4'>
        <h4 class='fw-bold mb-3'>Edit Role</h4>

        <form method='post'>
            <div class='mb-3'>
                <label class='form-label'>Nama Role</label>
                <input type='text' name='nama_role' class='form-control'
                       value='<?= htmlspecialchars($data["nama_role"]) ?>' required>
            </div>

            <button type='submit' name='update' class='btn btn-primary'>Simpan Perubahan</button>
            <a href='role.php' class='btn btn-secondary'>Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
