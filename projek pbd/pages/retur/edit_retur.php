<?php
include "../../config/database.php";
session_start();

if(!isset($_GET['id'])){
    echo "ID retur tidak ada!";
    exit;
}

$idretur = $_GET['id'];

// ambil header retur
$q = mysqli_query($conn, "
    SELECT r.*, p.created_at AS tgl_penerimaan, v.nama_vendor,
           u.nama_lengkap
    FROM retur r
    JOIN penerimaan p ON p.idpenerimaan = r.idpenerimaan
    JOIN pengadaan pg ON pg.idpengadaan = p.idpengadaan
    JOIN vendor v ON v.idvendor = pg.idvendor
    JOIN user u ON u.iduser = r.iduser
    WHERE r.idretur = '$idretur'
");

$h = mysqli_fetch_assoc($q);

// ambil detail retur
$d = mysqli_query($conn, "
    SELECT dr.*, b.nama 
    FROM detail_retur dr
    JOIN detail_penerimaan dp ON dp.iddetail_penerimaan = dr.iddetail_penerimaan
    JOIN barang b ON b.idbarang = dp.barang_idbarang
    WHERE dr.idretur = '$idretur'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Retur</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

<a href="retur.php" class="btn btn-secondary mb-3">← Kembali</a>

<div class="card p-4 shadow-sm">

<h3 class="fw-bold mb-3">Edit Retur</h3>

<form action="proses_edit_retur.php" method="POST">
    <input type="hidden" name="idretur" value="<?= $idretur ?>">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah Diretur</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($d)): ?>
            <tr>
                <td><?= $row['nama'] ?></td>

                <!-- ID detail retur DIPAKAI UNTUK UPDATE -->
                <input type="hidden" name="id_detail_retur[]" value="<?= $row['iddetail_retur'] ?>">

                <td>
                    <input type="number" name="jumlah[]" class="form-control"
                           value="<?= $row['jumlah'] ?>" min="1" required>
                </td>

                <td>
                    <input type="text" name="alasan[]" class="form-control"
                           value="<?= $row['alasan'] ?>" required>
                </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>

    <button class="btn btn-primary w-100">Simpan Perubahan</button>
</form>

</div>
</div>

</body>
</html>
