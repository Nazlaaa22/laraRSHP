<?php
include "../../config/database.php";
session_start();

// Jika tidak membawa ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID role tidak ditemukan!'); window.location='role.php';</script>";
    exit;
}

$id = $_GET['id'];

// cek apakah role ada
$cek = mysqli_query($conn, "SELECT idrole FROM role WHERE idrole = '$id'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>alert('Role tidak ditemukan!'); window.location='role.php';</script>";
    exit;
}

// hapus role
$delete = mysqli_query($conn, "DELETE FROM role WHERE idrole = '$id'");

if ($delete) {
    echo "<script>alert('Role berhasil dihapus!'); window.location='role.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus role: ".mysqli_error($conn)."'); window.location='role.php';</script>";
}
?>
