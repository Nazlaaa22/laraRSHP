<?php
include "../../config/database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: retur.php");
    exit;
}

$idretur = $_POST['idretur'];
$id_detail_retur = $_POST['id_detail_retur'];
$jumlah = $_POST['jumlah'];
$alasan = $_POST['alasan'];

if(empty($id_detail_retur)){
    echo "<script>alert('Detail retur tidak ditemukan!'); history.back();</script>";
    exit;
}

// UPDATE DETAIL RETUR
for ($i = 0; $i < count($id_detail_retur); $i++) {

    $iddetail = $id_detail_retur[$i];
    $jml = $jumlah[$i];
    $als = $alasan[$i];

    mysqli_query($conn, "
        UPDATE detail_retur
        SET jumlah = '$jml', alasan = '$als'
        WHERE iddetail_retur = '$iddetail'
    ");
}

echo "<script>
    alert('Retur berhasil diperbarui!');
    window.location='retur.php';
</script>";
?>
