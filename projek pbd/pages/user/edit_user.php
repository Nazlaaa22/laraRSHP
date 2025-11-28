<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'] ?? 0;

// Ambil data user berdasarkan id
$qUser = mysqli_query($conn, "
    SELECT iduser, username, nama_lengkap, idrole, status 
    FROM user 
    WHERE iduser = '$id'
");

$data = mysqli_fetch_assoc($qUser);

// Ambil role
$qRole = mysqli_query($conn, "SELECT idrole, nama_role FROM role");

// jika tidak ditemukan
if (!$data) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
}

// update
if (isset($_POST['update'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username     = $_POST['username'];
    $password_raw = $_POST['password'];
    $idrole       = $_POST['idrole'];
    $status       = $_POST['status'];

    // jika password diubah
    if ($password_raw != "") {
        $password = password_hash($password_raw, PASSWORD_DEFAULT);
        $update = mysqli_query($conn, "
            UPDATE user SET
                username = '$username',
                password = '$password',
                nama_lengkap = '$nama_lengkap',
                idrole = '$idrole',
                status = '$status'
            WHERE iduser = '$id'
        ");
    } else {
        $update = mysqli_query($conn, "
            UPDATE user SET
                username = '$username',
                nama_lengkap = '$nama_lengkap',
                idrole = '$idrole',
                status = '$status'
            WHERE iduser = '$id'
        ");
    }

    if ($update) {
        echo "<script>alert('User berhasil diperbarui!'); window.location='user.php';</script>";
    } else {
        echo "<script>alert('Gagal update: ".mysqli_error($conn)."');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
.card { width:60%; margin:auto; margin-top:50px; border-radius:14px; }
</style>
</head>
<body>

<div class="container">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Edit User</h4>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="idrole" class="form-select" required>
                    <?php while($r = mysqli_fetch_assoc($qRole)): ?>
                        <option value="<?= $r['idrole'] ?>" <?= ($data['idrole'] == $r['idrole']) ? "selected" : "" ?>>
                            <?= htmlspecialchars($r['nama_role']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="y" <?= ($data['status']=='y')?"selected":"" ?>>Aktif</option>
                    <option value="n" <?= ($data['status']=='n')?"selected":"" ?>>Nonaktif</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a href="user.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
