<?php
include "../../config/database.php";

$id = $_POST['idpenerimaan'];
$status = $_POST['status'];

mysqli_query($conn, "
    UPDATE penerimaan SET status = '$status'
    WHERE idpenerimaan = $id
");

echo "<script>
    alert('Status penerimaan berhasil diperbarui!');
    window.location='penerimaan.php';
</script>";
