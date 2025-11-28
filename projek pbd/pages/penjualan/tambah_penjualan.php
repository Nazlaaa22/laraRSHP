<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include "../../config/database.php";
session_start();

// =============== PROSES SIMPAN ===============
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $iduser   = $_POST['iduser'];
    $ppn      = (int)$_POST['ppn'];
    $idbarang = $_POST['idbarang'];
    $harga    = $_POST['harga'];
    $jumlah   = $_POST['jumlah'];

    // Hitung subtotal awal
    $subtotal_nilai = 0;
    for ($i = 0; $i < count($idbarang); $i++) {
        if ($idbarang[$i] == "" || $jumlah[$i] == 0) continue;
        $subtotal_nilai += ($harga[$i] * $jumlah[$i]);
    }

    $ppn_nilai   = ($subtotal_nilai * $ppn) / 100;
    $total_nilai = $subtotal_nilai + $ppn_nilai;

    // Insert ke tabel penjualan
    mysqli_query($conn, "
        INSERT INTO penjualan (subtotal_nilai, ppn, total_nilai, iduser, status)
        VALUES ('$subtotal_nilai', '$ppn_nilai', '$total_nilai', '$iduser', 's')
    ") or die(mysqli_error($conn));

    $idpenjualan = mysqli_insert_id($conn);

    // Insert detail & kurangi stok
    for ($i = 0; $i < count($idbarang); $i++) {

        if ($idbarang[$i] == "" || $jumlah[$i] == 0) continue;

        $idb = $idbarang[$i];
        $j   = (int)$jumlah[$i];
        $h   = (int)$harga[$i];
        $sub = $h * $j;

        mysqli_query($conn, "
            INSERT INTO detail_penjualan (idpenjualan, idbarang, jumlah, harga_satuan, subtotal)
            VALUES ('$idpenjualan', '$idb', '$j', '$h', '$sub')
        ") or die(mysqli_error($conn));

        mysqli_query($conn, "UPDATE barang SET stok = stok - $j WHERE idbarang='$idb'");
    }

    echo "<script>alert('Penjualan berhasil disimpan!');window.location='penjualan.php';</script>";
    exit;
}

$qBarang = mysqli_query($conn, "SELECT * FROM barang WHERE status = 1 ORDER BY nama ASC");
$qUsers  = mysqli_query($conn, "SELECT iduser, nama_lengkap FROM user WHERE status='y' ORDER BY nama_lengkap ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Penjualan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4" style="max-width:900px;">
<a href="penjualan.php" class="btn btn-secondary mb-3">← Kembali</a>

<div class="card p-4 shadow-sm">
<h3 class="fw-bold mb-3">Tambah Penjualan</h3>

<form method="POST">

<div class="mb-3">
    <label>Admin</label>
    <select name="iduser" class="form-control" required>
        <option value="">-- Pilih Admin --</option>
        <?php while($u = mysqli_fetch_assoc($qUsers)): ?>
            <option value="<?= $u['iduser'] ?>"><?= $u['nama_lengkap'] ?></option>
        <?php endwhile; ?>
    </select>
</div>

<div class="mb-3">
    <label>PPN (%)</label>
    <input type="number" name="ppn" id="ppn" value="10" class="form-control">
</div>

<hr>
<h5>Item Produk</h5>

<table class="table" id="itemTable">
<thead>
<tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
</thead>
<tbody id="bodyItem">
<tr>
    <td>
        <select name="idbarang[]" class="form-control barangSelect" onchange="updateHarga(this)">
            <option value="">-- Pilih Produk --</option>
            <?php while($b = mysqli_fetch_assoc($qBarang)): ?>
                <option value="<?= $b['idbarang'] ?>" data-harga="<?= $b['harga'] ?>"><?= $b['nama'] ?></option>
            <?php endwhile; ?>
        </select>
    </td>

    <td><input type="number" name="harga[]" class="form-control hargaField" readonly></td>
    <td><input type="number" name="jumlah[]" class="form-control jumlahField" value="1" min="1" onchange="hitungTotal()"></td>
    <td><span class="subtotalText">Rp 0</span><input type="hidden" name="subtotal[]" class="subtotalField"></td>
    <td><button type="button" class="btn btn-danger" onclick="hapusRow(this)">Hapus</button></td>
</tr>
</tbody>
</table>

<button type="button" class="btn btn-outline-primary" onclick="tambahRow()">+ Tambah Item</button>

<hr>
<div class="text-end">
<p>Subtotal: <strong id="sumSubtotal">Rp 0</strong></p>
<p>PPN: <strong id="sumPPN">Rp 0</strong></p>
<h5>Total: <strong id="sumTotal">Rp 0</strong></h5>
</div>

<button type="submit" class="btn btn-primary w-100">Simpan Penjualan</button>
</form>
</div>
</div>

<script>
function updateHarga(select){
    let harga = select.options[select.selectedIndex].getAttribute("data-harga");
    let row = select.parentElement.parentElement;
    row.querySelector(".hargaField").value = harga;
    hitungTotal();
}

function hitungTotal(){
    let rows = document.querySelectorAll("#bodyItem tr");
    let subtotalAll = 0;

    rows.forEach(row => {
        let harga = parseInt(row.querySelector(".hargaField").value || 0);
        let jumlah = parseInt(row.querySelector(".jumlahField").value || 0);
        let subtotal = harga * jumlah;
        row.querySelector(".subtotalText").innerText = "Rp " + subtotal.toLocaleString();
        row.querySelector(".subtotalField").value = subtotal;
        subtotalAll += subtotal;
    });

    let ppn = document.getElementById("ppn").value;
    let ppnValue = subtotalAll * (ppn/100);
    document.getElementById("sumSubtotal").innerText = "Rp " + subtotalAll.toLocaleString();
    document.getElementById("sumPPN").innerText = "Rp " + ppnValue.toLocaleString();
    document.getElementById("sumTotal").innerText = "Rp " + (subtotalAll + ppnValue).toLocaleString();
}

function tambahRow(){
    let table = document.getElementById("bodyItem");
    let newRow = table.rows[0].cloneNode(true);
    newRow.querySelector(".barangSelect").value = "";
    newRow.querySelector(".hargaField").value = "";
    newRow.querySelector(".jumlahField").value = 1;
    newRow.querySelector(".subtotalText").innerText = "Rp 0";
    newRow.querySelector(".subtotalField").value = 0;
    table.appendChild(newRow);
}

function hapusRow(btn){
    let rows = document.querySelectorAll("#bodyItem tr");
    if(rows.length===1){ alert("Minimal 1 item!"); return;}
    btn.parentElement.parentElement.remove();
    hitungTotal();
}
</script>

</body>
</html>
