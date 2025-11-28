<?php
include "../../config/database.php";
session_start();

$id = $_POST['idpengadaan'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];

mysqli_query($conn, "
    UPDATE pengadaan 
    SET tanggal='$tanggal', status='$status'
    WHERE idpengadaan='$id'
");

echo "<script>
        alert('Pengadaan berhasil diperbarui!');
        window.location='pengadaan.php';
      </script>";
?>
