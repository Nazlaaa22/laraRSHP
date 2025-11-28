<?php
include "../../config/database.php";
session_start();
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM vendor WHERE idvendor='$id'");

echo "<script>alert('Vendor berhasil dihapus!'); window.location='vendor.php';</script>";
?>
