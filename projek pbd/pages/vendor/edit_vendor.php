<?php
include "../../config/database.php";
session_start();

/* ambil id vendor */
$id = $_GET['id'];

/* ambil data vendor berdasarkan id */
$q = mysqli_query($conn, "SELECT * FROM vendor WHERE idvendor='$id'");
$data = mysqli_fetch_assoc($q);

/* jika tombol update ditekan */
if (isset($_POST['update'])) {
    $nama_vendor = $_POST['nama_vendor'];
    $badan_hukum = $_POST['badan_hukum'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE vendor SET 
            nama_vendor='$nama_vendor',
            badan_hukum='$badan_hukum',
            status='$status'
        WHERE idvendor='$id'
    ");

    echo "<script>alert('Vendor berhasil diperbarui!');window.location='vendor.php';</script>";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Vendor</title>

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
        <h4 class="fw-bold mb-3">Edit Vendor</h4>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Vendor</label>
                <input type="text" name="nama_vendor" class="form-control"
                       value="<?= $data['nama_vendor'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Legal / Badan Hukum</label>
                <select name="badan_hukum" class="form-select" required>
                    <option value="y" <?= ($data['badan_hukum']=='y'?'selected':'') ?>>Ya</option>
                    <option value="t" <?= ($data['badan_hukum']=='t'?'selected':'') ?>>Tidak</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="y" <?= ($data['status']=='y'?'selected':'') ?>>Aktif</option>
                    <option value="n" <?= ($data['status']=='n'?'selected':'') ?>>Nonaktif</option>
                    <option value="t" <?= ($data['status']=='t'?'selected':'') ?>>Tutup</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Update
            </button>
            <a href="vendor.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

</body>
</html>
