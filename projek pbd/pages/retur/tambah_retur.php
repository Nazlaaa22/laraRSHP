<?php
include "../../config/database.php";
session_start();

// Ambil semua penerimaan aktif
$qPenerimaan = mysqli_query($conn, "
    SELECT pm.idpenerimaan, pm.created_at, pg.idpengadaan, v.nama_vendor
    FROM penerimaan pm
    LEFT JOIN pengadaan pg ON pg.idpengadaan = pm.idpengadaan
    LEFT JOIN vendor v ON v.idvendor = pg.idvendor
    WHERE pm.status = 'a'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Retur Barang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background:#f3f4f6;
    font-family:Inter,sans-serif;
}

.container-box {
    max-width: 900px;
    margin: auto;
}
</style>

</head>
<body class="bg-light">

<div class="container py-4 container-box">

    <a href="retur.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow-sm p-4">
        <h3 class="fw-bold mb-3">Tambah Retur Barang</h3>

        <!-- FORM -->
        <form action="proses_tambah_retur.php" method="POST">

            <!-- PILIH PENERIMAAN -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Penerimaan</label>
                <select name="idpenerimaan" id="idpenerimaan" class="form-control" onchange="loadDetail()" required>
                    <option value="">-- Pilih Penerimaan --</option>

                    <?php while($p = mysqli_fetch_assoc($qPenerimaan)): ?>
                        <option value="<?= $p['idpenerimaan'] ?>">
                            ID <?= $p['idpenerimaan'] ?> - <?= $p['nama_vendor'] ?> (Pengadaan <?= $p['idpengadaan'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- DETAIL AKAN MUNCUL DI SINI -->
            <div id="detailArea"></div>

            <button type="submit" class="btn btn-primary mt-3 w-100">
                Simpan Retur Barang
            </button>

        </form>

    </div>
</div>

<!-- AJAX -->
<script>
function loadDetail(){
    let id = document.getElementById("idpenerimaan").value;

    if(id === ""){
        document.getElementById("detailArea").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "load_detail_penerimaan.php?id=" + id, true);
    xhr.onload = function(){
        if(xhr.status === 200){
            document.getElementById("detailArea").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>

</body>
</html>
