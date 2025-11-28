<?php
include "../../config/database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: penerimaan.php");
    exit;
}

$idpengadaan = $_POST['idpengadaan'];
$iduser      = $_SESSION['iduser'];

$idbarang       = $_POST['idbarang'];        
$jumlahTerima   = $_POST['jumlah_terima'];   

if (empty($idbarang)) {
    echo "<script>alert('Tidak ada barang yang diterima!'); history.back();</script>";
    exit;
}

// INSERT HEADER
$q1 = mysqli_query($conn, "
    INSERT INTO penerimaan (idpengadaan, iduser, status)
    VALUES ('$idpengadaan', '$iduser', 'a')
");

$idpenerimaan = mysqli_insert_id($conn);

// INSERT DETAIL
for ($i = 0; $i < count($idbarang); $i++) {

    $barang     = $idbarang[$i];
    $jmlTerima  = $jumlahTerima[$i];

    // Ambil harga dari detail_pengadaan
    $qHarga = mysqli_query($conn, "
        SELECT harga, sub_total 
        FROM detail_pengadaan 
        WHERE idpengadaan = '$idpengadaan' AND idbarang = '$barang'
        LIMIT 1
    ");

    $h = mysqli_fetch_assoc($qHarga);
    $hargaSatuan = $h['harga'];
    $subTotal = $hargaSatuan * $jmlTerima;

    // INSERT detail penerimaan — NAMA KOLOM SUDAH BENAR
    mysqli_query($conn, "
        INSERT INTO detail_penerimaan
        (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima, sub_total_terima)
        VALUES
        ('$idpenerimaan', '$barang', '$jmlTerima', '$hargaSatuan', '$subTotal')
    ");

    // Update stok
    mysqli_query($conn, "
        UPDATE barang SET stok = stok + $jmlTerima
        WHERE idbarang = '$barang'
    ");
}

echo "<script>
    alert('Penerimaan berhasil disimpan!');
    window.location='penerimaan.php';
</script>";
?>
