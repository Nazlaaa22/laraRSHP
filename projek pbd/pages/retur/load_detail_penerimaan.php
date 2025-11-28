<?php
include "../../config/database.php";

if(!isset($_GET['id'])){
    echo "<p class='text-danger'>ID tidak valid.</p>";
    exit;
}

$id = $_GET['id'];

// ambil detail penerimaan
$q = mysqli_query($conn, "
    SELECT dp.*, b.nama 
    FROM detail_penerimaan dp
    JOIN barang b ON b.idbarang = dp.barang_idbarang
    WHERE dp.idpenerimaan = '$id'
");

if(mysqli_num_rows($q) == 0){
    echo "<p class='text-danger'>Tidak ada data detail penerimaan.</p>";
    exit;
}

?>

<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Diterima</th>
            <th>Jumlah Retur</th>
            <th>Alasan</th>
        </tr>
    </thead>
    <tbody>

<?php while($d = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['jumlah_terima'] ?></td>

    <td>
        <!-- ID detail penerimaan -->
        <input type="hidden" name="id_detail_penerimaan[]" value="<?= $d['iddetail_penerimaan'] ?>">

        <!-- JUMLAH RETUR -->
        <input type="number" 
               name="jumlah_retur[]" 
               min="0" 
               max="<?= $d['jumlah_terima'] ?>" 
               class="form-control">
    </td>

    <td>
        <!-- ALASAN -->
        <input type="text" class="form-control" name="alasan[]" placeholder="Alasan retur">
    </td>
</tr>
<?php endwhile; ?>

</tbody>
</table>
