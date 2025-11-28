<?php
include "../../config/database.php";
session_start();

if(!isset($_GET['id'])){ echo "ID dibutuhkan"; exit; }
$id = intval($_GET['id']);

// AMBIL DATA HEADER
$qh = mysqli_query($conn, "
    SELECT pm.*, pg.idpengadaan, v.nama_vendor, u.nama_lengkap
    FROM penerimaan pm
    LEFT JOIN pengadaan pg ON pg.idpengadaan = pm.idpengadaan
    LEFT JOIN vendor v ON v.idvendor = pg.idvendor
    LEFT JOIN user u ON u.iduser = pm.iduser
    WHERE pm.idpenerimaan = $id
");
$h = mysqli_fetch_assoc($qh);

// AMBIL DETAIL
$qd = mysqli_query($conn, "
    SELECT dp.*, b.nama
    FROM detail_penerimaan dp
    JOIN barang b ON b.idbarang = dp.barang_idbarang
    WHERE dp.idpenerimaan = $id
");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cetak Penerimaan #<?= $id ?></title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, sans-serif;
    margin: 40px;
    color: #333;
}

.header-title {
    text-align: center;
    margin-bottom: 10px;
}

.line {
    border-top: 2px solid #000;
    margin: 10px 0 20px 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}

.table th {
    background: #f0f0f0;
    padding: 8px;
    border: 1px solid #999;
}

.table td {
    padding: 8px;
    border: 1px solid #ccc;
}

.summary {
    text-align: right;
    margin-top: 15px;
    font-size: 16px;
    font-weight: bold;
}

.footer {
    margin-top: 50px;
    text-align: right;
}

.signature {
    margin-top: 60px;
    text-align: right;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header-title">
    <h2>🧾 Bukti Penerimaan Barang</h2>
    <div>Glow Skincare</div>
</div>

<div class="line"></div>

<!-- INFORMASI -->
<table style="width: 100%; margin-bottom: 20px;">
    <tr><td><strong>ID Penerimaan</strong></td><td>: <?= $h['idpenerimaan'] ?></td></tr>
    <tr><td><strong>Tanggal</strong></td><td>: <?= $h['created_at'] ?></td></tr>
    <tr><td><strong>ID Pengadaan</strong></td><td>: <?= $h['idpengadaan'] ?></td></tr>
    <tr><td><strong>Vendor</strong></td><td>: <?= $h['nama_vendor'] ?></td></tr>
    <tr><td><strong>Admin</strong></td><td>: <?= $h['nama_lengkap'] ?></td></tr>
</table>

<!-- TABLE BARANG -->
<table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
    <?php $total=0; while($d=mysqli_fetch_assoc($qd)): $total+=$d['sub_total_terima']; ?>
        <tr>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['jumlah_terima'] ?></td>
            <td>Rp <?= number_format($d['harga_satuan_terima'],0,",",".") ?></td>
            <td>Rp <?= number_format($d['sub_total_terima'],0,",",".") ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<!-- TOTAL -->
<div class="summary">
    Total: Rp <?= number_format($total,0,",",".") ?>
</div>

<!-- SIGNATURE -->
<div class="signature">
    __________________________ <br>
    <?= $h['nama_lengkap'] ?><br>
    Admin Penerima
</div>

<script>
window.print();
</script>

</body>
</html>
