<?php
include "../../config/database.php";

if(!isset($_GET['id'])){
    echo "<p class='text-danger'>ID pengadaan tidak valid.</p>";
    exit;
}

$id = $_GET['id'];

$q = mysqli_query($conn, "
    SELECT dp.*, b.nama 
    FROM detail_pengadaan dp
    JOIN barang b ON b.idbarang = dp.idbarang
    WHERE dp.idpengadaan = '$id'
");

if(mysqli_num_rows($q) == 0){
    echo "<p class='text-danger'>Tidak ada detail pengadaan.</p>";
    exit;
}
?>

<table class='table table-bordered'>
    <thead class="table-dark">
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Subtotal</th>
            <th>Jumlah Diterima</th>
            <th>Kondisi</th>
        </tr>
    </thead>

    <tbody>
        <?php while($d = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td>Rp <?= number_format($d['harga'],0,',','.') ?></td>
            <td>Rp <?= number_format($d['sub_total'],0,',','.') ?></td>

            <!-- input untuk penerimaan -->
            <td width="150">
                <input type="hidden" name="idbarang[]" value="<?= $d['idbarang'] ?>">
                <input type="number" 
                       name="jumlah_terima[]" 
                       class="form-control"
                       min="0" 
                       max="<?= $d['jumlah'] ?>" 
                       required>
            </td>

            <!-- input kondisi barang -->
            <td width="200">
                <select name="kondisi[]" class="form-control" required>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="expired">Expired</option>
                </select>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
