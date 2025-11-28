<?php
include "../../config/database.php";
session_start();

// Ambil data role untuk dropdown
$qRole = mysqli_query($conn, "SELECT idrole, nama_role FROM role");

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['idrole'];
    $status   = $_POST['status'];

    $query = mysqli_query($conn, "
        INSERT INTO user (nama_lengkap, username, password, idrole, status) 
        VALUES ('$nama', '$username', '$password', '$role', '$status')
    ");

    if ($query) {
        echo "<script>alert('User berhasil ditambahkan!');window.location='user.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan user');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f3f4f6;font-family:Inter,sans-serif">

<div class="container mt-5" style="max-width:600px;">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-3">Tambah User</h4>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="idrole" class="form-control" required>
                    <option value=""> -- Pilih Role -- </option>
                    <?php while($r = mysqli_fetch_assoc($qRole)): ?>
                        <option value="<?= $r['idrole'] ?>"><?= $r['nama_role'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="y">Aktif</option>
                    <option value="n">Nonaktif</option>
                </select>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="user.php" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</div>

</body>
</html>
