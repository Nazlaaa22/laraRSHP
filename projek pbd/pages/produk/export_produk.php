<?php
include "../config/database.php";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=produk.csv");

$output = fopen("php://output", "w");

fputcsv($output, ['ID', 'Nama Produk', 'Jenis', 'Stok', 'Harga', 'Status']);

$q = mysqli_query($conn, "SELECT * FROM barang ORDER BY idbarang DESC");

while ($r = mysqli_fetch_assoc($q)) {
    fputcsv($output, [
        $r['idbarang'],
        $r['nama'],
        $r['jenis'],
        $r['stok'],
        $r['harga'],
        $r['status'] == 1 ? 'Aktif' : 'Nonaktif'
    ]);
}

fclose($output);
exit;
