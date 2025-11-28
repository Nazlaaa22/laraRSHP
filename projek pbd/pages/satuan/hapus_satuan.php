<?php
include "../../config/database.php";
session_start();
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM satuan WHERE idsatuan='$id'");

echo "<script>alert('Data berhasil dihapus');window.location='satuan.php';</script>";
?>
