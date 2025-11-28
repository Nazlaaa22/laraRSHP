<?php
include "../../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";

/* ambil vendor */
$qVendor = mysqli_query($conn, "SELECT idvendor, nama_vendor FROM vendor WHERE status='1'");

/* ambil semua barang */
$qBarang = mysqli_query($conn, "SELECT idbarang, nama, harga FROM barang WHERE status='1'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Pengadaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f3f4f6; font-family:Inter,sans-serif; }
:root { --sidebar-w:260px; }

.sidebar {
    position:fixed; top:0; left:0;
    width:var(--sidebar-w); height:100vh;
    background:linear-gradient(180deg,#6a11cb,#c61fab);
    padding:25px; color:white;
}
.sidebar nav a {
    display:flex; align-items:center;
    padding:12px 0; color:white; text-decoration:none;
}
.sidebar nav a i { margin-right:10px; }
.main { margin-left:var(--sidebar-w); padding:30px; }
.table input { border:1px solid #ddd; }
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <h4>Glow Skincare</h4>
    <small>Dashboard Admin</small>

    <nav class="mt-4">
        <a href="../dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="../produk/produk.php"><i class="bi bi-box-seam"></i> Kategori Produk</a>
        <a href="../satuan/satuan.php"><i class="bi bi-tags"></i> Satuan</a>
        <a href="../vendor/vendor.php"><i class="bi bi-shop"></i> Vendor</a>
        <a href="../pengadaan/pengadaan.php"><i class="bi bi-truck"></i> Pengadaan</a>
        <a href="../transaksi.php"><i class="bi bi-receipt"></i> Transaksi</a>
        <a href="../pelanggan.php"><i class="bi bi-people"></i> Pelanggan</a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="main">
    <h2 class="fw-bold">Tambah Pengadaan</h2>
    <div class="text-muted mb-4">Selamat datang kembali, <?= $nama_admin ?>! 👋</div>

    <form action="proses_tambah_pengadaan.php" method="POST">

        <!-- vendor -->
        <label class="fw-bold">Vendor</label>
        <select class="form-control mb-4" name="vendor" required>
            <option value="">-- Pilih Vendor --</option>
            <?php while($v = mysqli_fetch_assoc($qVendor)): ?>
                <option value="<?= $v['idvendor'] ?>"><?= $v['nama_vendor'] ?></option>
            <?php endwhile; ?>
        </select>

        <h4 class="fw-bold">Produk Dibeli</h4>

        <!-- BUTTON TAMBAH PRODUK -->
        <button type="button" class="btn btn-success mb-3" onclick="addRow()">
            + Tambah Produk
        </button>

        <!-- TABEL PRODUK -->
        <table class="table table-bordered" id="produkTable">
            <thead class="table-light">
                <tr>
                    <th width="40%">Produk</th>
                    <th width="15%">Jumlah</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Subtotal</th>
                    <th width="5%">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- subtotal -->
        <label class="fw-bold">Subtotal</label>
        <input id="subtotal" class="form-control mb-3" readonly>
        <input id="subtotal_raw" type="hidden" name="subtotal">

        <!-- ppn -->
        <label class="fw-bold">PPN (11%)</label>
        <input id="ppn" class="form-control mb-3" readonly>
        <input id="ppn_raw" type="hidden" name="ppn">

        <!-- total -->
        <label class="fw-bold">Total</label>
        <input id="total" class="form-control mb-4" readonly>
        <input id="total_raw" type="hidden" name="total">

        <!-- submit -->
        <button class="btn btn-primary w-100 py-3 fw-bold">Simpan Pengadaan</button>
    </form>

</div>

<script>
// barang list harga
let barangList = {
    <?php
    mysqli_data_seek($qBarang, 0);
    while($b = mysqli_fetch_assoc($qBarang)){
        echo "'{$b['idbarang']}': {$b['harga']},";
    }
    ?>
};

// fungsi format angka
function formatRupiah(num) {
    return num.toLocaleString('id-ID');
}

function addRow() {
    let table = document.querySelector("#produkTable tbody");
    let tr = document.createElement("tr");

    tr.innerHTML = `
        <td>
            <select name="produk[]" class="form-control" onchange="updateHarga(this)">
                <option value="">-- Pilih --</option>
                <?php
                mysqli_data_seek($qBarang, 0);
                while($b = mysqli_fetch_assoc($qBarang)){
                    echo "<option value='{$b['idbarang']}' data-harga='{$b['harga']}'>{$b['nama']}</option>";
                }
                ?>
            </select>
        </td>
        <td><input name="qty[]" type="number" min="1" class="form-control" oninput="hitung()"></td>
        <td><input name="harga[]" class="form-control" readonly></td>
        <td>
            <input name="sub[]" class="form-control" readonly>
            <input name="sub_raw[]" type="hidden">
        </td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove(); hitung();">x</button></td>
    `;

    table.appendChild(tr);
}

function updateHarga(select) {
    let harga = select.options[select.selectedIndex].dataset.harga || 0;
    let row = select.parentNode.parentNode;
    row.querySelector("input[name='harga[]']").value = harga;
    hitung();
}

function hitung() {
    let rows = document.querySelectorAll("#produkTable tbody tr");
    let subtotal = 0;

    rows.forEach(r => {
        let qty = parseInt(r.querySelector("input[name='qty[]']").value) || 0;
        let harga = parseInt(r.querySelector("input[name='harga[]']").value) || 0;
        let sub = qty * harga;

        r.querySelector("input[name='sub[]']").value = formatRupiah(sub);
        r.querySelector("input[name='sub_raw[]']").value = sub;

        subtotal += sub;
    });

    let ppn = Math.round(subtotal * 0.11);
    let total = subtotal + ppn;

    document.getElementById("subtotal").value = formatRupiah(subtotal);
    document.getElementById("subtotal_raw").value = subtotal;

    document.getElementById("ppn").value = formatRupiah(ppn);
    document.getElementById("ppn_raw").value = ppn;

    document.getElementById("total").value = formatRupiah(total);
    document.getElementById("total_raw").value = total;
}
</script>

</body>
</html>
