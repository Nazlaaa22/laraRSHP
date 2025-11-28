<?php
include "../../config/database.php";

$nama     = $_POST['nama'];
$jenis    = $_POST['jenis'];
$idsatuan = $_POST['idsatuan'];
$stok     = $_POST['stok'];
$harga    = $_POST['harga'];

$status = 1;

$q = mysqli_query($conn, "
    INSERT INTO barang (nama, jenis, idsatuan, stok, harga, status)
    VALUES ('$nama', '$jenis', '$idsatuan', '$stok', '$harga', '$status')
");

if ($q) {
    echo "<script>
            alert('Produk berhasil ditambahkan!');
            window.location.href='produk.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menambah produk!');
            window.location.href='tambah_produk.php';
          </script>";
}
?>
