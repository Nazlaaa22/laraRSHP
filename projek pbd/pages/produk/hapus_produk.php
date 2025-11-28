<?php
include "../../config/database.php";
session_start();

if(!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = intval($_GET['id']);

$cek = mysqli_query($conn, "SELECT idbarang FROM barang WHERE idbarang = $id");
if(mysqli_num_rows($cek) == 0) {
    header("Location: produk.php?msg=notfound");
    exit;
}

$q = mysqli_query($conn, "DELETE FROM barang WHERE idbarang = $id");

if($q){
    header("Location: produk.php?msg=deleted");
} else {
    header("Location: produk.php?msg=error");
}
exit;
?>
