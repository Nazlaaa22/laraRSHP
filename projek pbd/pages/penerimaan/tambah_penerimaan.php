<?php
include "../../config/database.php";
session_start();

// Ambil semua pengadaan aktif
$qPengadaan = mysqli_query($conn, "
    SELECT p.idpengadaan, p.tanggal, v.nama_vendor
    FROM pengadaan p
    LEFT JOIN vendor v ON v.idvendor = p.idvendor
    WHERE p.status = 'a'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penerimaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <a href="penerimaan.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow-sm p-4">
        <h3 class="fw-bold mb-3">Tambah Penerimaan Barang</h3>

        <!-- FORM -->
        <form action="proses_tambah_penerimaan.php" method="POST">

            <!-- PILIH PENGADAAN -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Pengadaan</label>
                <select name="idpengadaan" id="idpengadaan" class="form-control" onchange="loadDetail()" required>
                    <option value="">-- Pilih Pengadaan --</option>

                    <?php while ($p = mysqli_fetch_assoc($qPengadaan)) : ?>
                    <option value="<?= $p['idpengadaan'] ?>">
                        ID <?= $p['idpengadaan'] ?> - <?= $p['nama_vendor'] ?> (<?= $p['tanggal'] ?>)
                    </option>
                    <?php endwhile; ?>

                </select>
            </div>

            <!-- DETAIL AKAN MUNCUL DI SINI -->
            <div id="detailArea"></div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Penerimaan</button>
        </form>
    </div>
</div>


<!-- AJAX LOAD DETAIL -->
<script>
function loadDetail() {
    let idpengadaan = document.getElementById("idpengadaan").value;

    if (idpengadaan === "") {
        document.getElementById("detailArea").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "load_detail_pengadaan.php?id=" + idpengadaan, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("detailArea").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>

</body>
</html>
