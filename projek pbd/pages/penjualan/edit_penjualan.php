<?php
include "../../config/database.php";
session_start();

$id = $_GET['id'];

// Ambil master penjualan
$qPenj = mysqli_query($conn, "
    SELECT * FROM penjualan WHERE idpenjualan='$id'
");
$penj = mysqli_fetch_assoc($qPenj);

// Ambil detail
$qDetail = mysqli_query($conn, "
    SELECT dp.*, b.nama, b.harga
    FROM detail_penjualan dp
    LEFT JOIN barang b ON b.idbarang = dp.idbarang
    WHERE dp.idpenjualan = '$id'
");

// Ambil admin & barang
$qUsers = mysqli_query($conn, "SELECT iduser, nama_lengkap FROM user WHERE status='y'");
$qBarang = mysqli_query($conn, "SELECT * FROM barang WHERE status=1 ORDER BY nama ASC");

// PROSES UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $iduser = $_POST['iduser'];
    $ppn    = $_POST['ppn'];
    $idbarang = $_POST['idbarang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // hitung ulang subtotal & total
    $subtotal_nilai = 0;
    for ($i=0; $i < count($idbarang); $i++) {
        if ($idbarang[$i] == "" || $jumlah[$i] == 0) continue;
        $subtotal_nilai += ($harga[$i] * $jumlah[$i]);
    }

    $ppn_nilai   = ($subtotal_nilai * $ppn) / 100;
    $total_nilai = $subtotal_nilai + $ppn_nilai;

    // Update master penjualan
    mysqli_query($conn, "
        UPDATE penjualan SET
            subtotal_nilai = '$subtotal_nilai',
            ppn = '$ppn_nilai',
            total_nilai = '$total_nilai',
            iduser = '$iduser'
        WHERE idpenjualan = '$id'
    ");

    // Hapus detail lama
    mysqli_query($conn, "DELETE FROM detail_penjualan WHERE idpenjualan='$id'");

    // Insert detail baru
    for ($i=0; $i < count($idbarang); $i++) {
        if ($idbarang[$i] == "" || $jumlah[$i] == 0) continue;

        $idb = $idbarang[$i];
        $j   = (int)$jumlah[$i];
        $h   = (int)$harga[$i];
        $sub = $h * $j;

        mysqli_query($conn, "
            INSERT INTO detail_penjualan (idpenjualan, idbarang, jumlah, harga_satuan, subtotal)
            VALUES ('$id', '$idb', '$j', '$h', '$sub')
        ");
    }

    echo "<script>alert('Penjualan berhasil diupdate!');window.location='penjualan.php';</script>";
    exit;
}
?>
