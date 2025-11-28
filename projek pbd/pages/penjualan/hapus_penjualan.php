<?php
include "../../config/database.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM detail_penjualan WHERE idpenjualan='$id'");
mysqli_query($conn, "DELETE FROM penjualan WHERE idpenjualan='$id'");

echo "<script>alert('Penjualan berhasil dihapus!');window.location='penjualan.php';</script>";
?>
