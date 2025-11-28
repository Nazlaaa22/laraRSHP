<?php
// pages/penerimaan/detail_penerimaan.php
include "../../config/database.php";
session_start();

if(!isset($_GET['id'])) { header("Location: penerimaan.php"); exit; }
$id = intval($_GET['id']);

// header info
$qh = mysqli_query($conn, "
    SELECT pm.*, pg.idpengadaan, v.nama_vendor, u.nama_lengkap
    FROM penerimaan pm
    LEFT JOIN pengadaan pg ON pg.idpengadaan = pm.idpengadaan
    LEFT JOIN vendor v ON v.idvendor = pg.idvendor
    LEFT JOIN user u ON u.iduser = pm.iduser
    WHERE pm.idpenerimaan = $id
");
$h = mysqli_fetch_assoc($qh);
if(!$h){ echo "Penerimaan tidak ditemukan"; exit; }

// details
$qd = mysqli_query($conn, "
    SELECT dp.*, b.nama
    FROM detail_penerimaan dp
    JOIN barang b ON b.idbarang = dp.barang_idbarang
    WHERE dp.idpenerimaan = $id
");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Detail Penerimaan #<?= $id ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <a href="penerimaan.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card mb-4 p-3">
        <h4>Detail Penerimaan</h4>
        <table class="table">
            <tr><th>Tanggal</th><td><?= $h['created_at'] ?></td></tr>
            <tr><th>ID Pengadaan</th><td><?= $h['idpengadaan'] ?></td></tr>
            <tr><th>Vendor</th><td><?= htmlspecialchars($h['nama_vendor']) ?></td></tr>
            <tr><th>Admin</th><td><?= htmlspecialchars($h['nama_lengkap']) ?></td></tr>
            <tr><th>Status</th><td><?= $h['status'] == 'a' ? 'Aktif' : 'Nonaktif' ?></td></tr>
        </table>
    </div>

    <div class="card p-3">
        <h5>Barang yang Diterima</h5>
        <table class="table table-bordered">
            <thead class="table-dark"><tr><th>Nama</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php $total = 0; while($d = mysqli_fetch_assoc($qd)): 
                    $total += $d['sub_total_terima'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($d['nama']) ?></td>
                    <td><?= $d['jumlah_terima'] ?></td>
                    <td>Rp <?= number_format($d['harga_satuan_terima'],0,',','.') ?></td>
                    <td>Rp <?= number_format($d['sub_total_terima'],0,',','.') ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-end fw-bold fs-5">Total: Rp <?= number_format($total,0,',','.') ?></div>

        <div class="mt-3">
            <a href="print_penerimaan_pdf.php?id=<?= $id ?>" class="btn btn-success" target="_blank">Cetak PDF</a>
        </div>
    </div>
</div>
</body>
</html>
