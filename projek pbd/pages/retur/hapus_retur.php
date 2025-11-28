<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: retur.php");
    exit;
}

$idretur = intval($_GET['id']);

// CEK RETUR ADA / TIDAK
$cek = mysqli_query($conn, "SELECT idretur FROM retur WHERE idretur = '$idretur'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>alert('Data retur tidak ditemukan!'); window.location='retur.php';</script>";
    exit;
}

// ===========================
// HAPUS DETAIL RETUR
// ===========================
mysqli_query($conn, "DELETE FROM detail_retur WHERE idretur = '$idretur'");

// ===========================
// HAPUS HEADER RETUR
// ===========================
mysqli_query($conn, "DELETE FROM retur WHERE idretur = '$idretur'");

// ===========================
// SELESAI
// ===========================
echo "<script>
    alert('Retur berhasil dihapus!');
    window.location='retur.php';
</script>";
?>
