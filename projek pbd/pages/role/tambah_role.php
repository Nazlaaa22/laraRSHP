<?php
include "../../config/database.php";
session_start();

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nama_role = $_POST['nama_role'];

    $insert = mysqli_query($conn, "
        INSERT INTO role (nama_role)
        VALUES ('$nama_role')
    ");

    if ($insert) {
        echo "<script>alert('Role berhasil ditambahkan!'); window.location='role.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah role: ".mysqli_error($conn)."');</script>";
    }
}
?>
<!doctype html>
<html lang='id'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Tambah Role</title>

<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width:60%; margin:auto; margin-top:50px; border-radius:14px; }
</style>
</head>

<body>

<div class='container'>
    <div class='card shadow p-4'>
        <h4 class='fw-bold mb-3'>Tambah Role</h4>

        <form method='post'>
            <div class='mb-3'>
                <label class='form-label'>Nama Role</label>
                <input type='text' name='nama_role' class='form-control' placeholder='Contoh: Admin, Kasir, Gudang' required>
            </div>

            <button type='submit' name='simpan' class='btn btn-primary'>Simpan</button>
            <a href='role.php' class='btn btn-secondary'>Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
