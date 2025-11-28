<?php
include "../../config/database.php";
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: retur.php");
    exit;
}

$idpenerimaan = $_POST['idpenerimaan'];
$iduser = $_SESSION['iduser'];

$id_detail = $_POST['id_detail_penerimaan'];
$jumlah = $_POST['jumlah_retur'];
$alasan = $_POST['alasan'];

if(empty($id_detail)){
    echo "<script>alert('Tidak ada barang yang diretur!'); history.back();</script>";
    exit;
}

// Insert header retur (WAJIB isi created_at)
$q1 = mysqli_query($conn, "
    INSERT INTO retur (idpenerimaan, iduser, created_at)
    VALUES ('$idpenerimaan', '$iduser', NOW())
");

if(!$q1){
    die("Error insert retur: " . mysqli_error($conn));
}

$idretur = mysqli_insert_id($conn);

// Insert detail retur
for($i = 0; $i < count($id_detail); $i++){

    if($jumlah[$i] == "" || $jumlah[$i] == 0) continue;

    $iddetail = $id_detail[$i];
    $jml = $jumlah[$i];
    $als = $alasan[$i];

    mysqli_query($conn, "
        INSERT INTO detail_retur (idretur, iddetail_penerimaan, jumlah, alasan)
        VALUES ('$idretur', '$iddetail', '$jml', '$als')
    ");
}

// redirect
echo "<script>
    alert('Retur berhasil disimpan!');
    window.location='retur.php';
</script>";
