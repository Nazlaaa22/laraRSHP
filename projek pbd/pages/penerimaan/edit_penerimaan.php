<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: penerimaan.php");
    exit;
}

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM penerimaan WHERE idpenerimaan = $id");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Penerimaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container p-4">
    <a href="penerimaan.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card p-4">
        <h4>Edit Status Penerimaan</h4>

        <form action="proses_edit_penerimaan.php" method="POST">
            <input type="hidden" name="idpenerimaan" value="<?= $data['idpenerimaan'] ?>">

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="a" <?= $data['status']=='a' ? 'selected':'' ?>>Aktif</option>
                    <option value="n" <?= $data['status']=='n' ? 'selected':'' ?>>Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
        </form>

    </div>
</div>

</body>
</html>
