<?php
include "../../config/database.php";
session_start();

// Jika tidak ada ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID user tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

$id = $_GET['id'];

// cek apakah data ada
$cek = mysqli_query($conn, "SELECT iduser FROM user WHERE iduser = '$id'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

// proses delete
$delete = mysqli_query($conn, "DELETE FROM user WHERE iduser = '$id'");

if ($delete) {
    echo "<script>alert('User berhasil dihapus!'); window.location='user.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus user: ".mysqli_error($conn)."'); window.location='user.php';</script>";
}
?>
