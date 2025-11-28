<?php
include "../../config/database.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: pengadaan.php");
    exit;
}

$id = $_GET['id'];

// hapus detail dulu
mysqli_query($conn, "DELETE FROM detail_pengadaan WHERE idpengadaan='$id'");

// hapus header pengadaan
mysqli_query($conn, "DELETE FROM pengadaan WHERE idpengadaan='$id'");

echo "<script>
        alert('Pengadaan berhasil dihapus!');
        window.location='pengadaan.php';
      </script>";
?>
