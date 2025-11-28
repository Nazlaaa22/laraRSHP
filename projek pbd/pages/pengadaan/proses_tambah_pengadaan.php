<?php
include "../../config/database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pengadaan.php");
    exit;
}

// DATA DARI FORM
$idvendor   = $_POST['vendor'];
$produk     = $_POST['produk'];
$qty        = $_POST['qty'];
$harga      = $_POST['harga'];

$subtotal   = str_replace('.', '', $_POST['subtotal']);
$total      = str_replace('.', '', $_POST['total']);
$iduser     = $_SESSION['iduser'];
$tanggal    = date("Y-m-d");

// HITUNG PPN 11%
$ppn = $total - $subtotal;

// VALIDASI
if (empty($produk)) {
    echo "<script>alert('Minimal 1 produk!'); history.back();</script>";
    exit;
}

// 1. INSERT KE PENGADAAN
$q1 = mysqli_query($conn, "
    INSERT INTO pengadaan (idvendor, iduser, tanggal, subtotal_nilai, ppn, total_nilai, status)
    VALUES ('$idvendor', '$iduser', '$tanggal', '$subtotal', '$ppn', '$total', 'a')
");

$idpengadaan = mysqli_insert_id($conn);

// 2. INSERT DETAIL
for ($i = 0; $i < count($produk); $i++) {

    $idbarang   = $produk[$i];
    $jumlah     = $qty[$i];
    $hrg        = $harga[$i];
    $subdet     = $jumlah * $hrg;

    mysqli_query($conn, "
        INSERT INTO detail_pengadaan (idpengadaan, idbarang, jumlah, harga, sub_total)
        VALUES ('$idpengadaan', '$idbarang', '$jumlah', '$hrg', '$subdet')
    ");

    // UPDATE STOK
    mysqli_query($conn, "
        UPDATE barang SET stok = stok + $jumlah WHERE idbarang = '$idbarang'
    ");
}

echo "<script>
    alert('Pengadaan berhasil disimpan!');
    window.location='pengadaan.php';
</script>";
?>
