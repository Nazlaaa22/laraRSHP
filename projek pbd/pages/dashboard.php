<?php
include "../config/database.php";
session_start();

$nama_admin = $_SESSION['nama_lengkap'] ?? "Admin";
$inisial = strtoupper(substr($nama_admin, 0, 2));

// Format rupiah
function rupiah($angka) {
    if ($angka === null) $angka = 0;
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Bulan & tahun sekarang
$bulan = date("m");
$tahun = date("Y");

// ==========================
// RINGKASAN DASHBOARD
// ==========================

// kategori (distinct jenis barang)
$qKategori = mysqli_query($conn, "SELECT COUNT(DISTINCT jenis) AS total FROM barang");
$totalKategori = (int) (@mysqli_fetch_assoc($qKategori)['total'] ?? 0);

// total produk
$qProduk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang");
$totalProduk = (int) (@mysqli_fetch_assoc($qProduk)['total'] ?? 0);

// vendor aktif
$qVendor = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM vendor 
    WHERE TRIM(LOWER(status)) IN ('y','1','aktif')
");
$rowVendor = mysqli_fetch_assoc($qVendor);
$totalVendor = (int) ($rowVendor['total'] ?? 0);

// user aktif
$qUserAktif = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user WHERE LOWER(status)='y'");
$totalUserAktif = (int) (@mysqli_fetch_assoc($qUserAktif)['total'] ?? 0);

// PENGADAAN - pakai tabel pengadaan + detail_pengadaan
$qPengadaan = mysqli_query($conn, "
    SELECT SUM(dp.sub_total) AS total
    FROM pengadaan p
    JOIN detail_pengadaan dp ON dp.idpengadaan = p.idpengadaan
    WHERE MONTH(p.tanggal) = '$bulan' AND YEAR(p.tanggal) = '$tahun'
");
$totalPengadaan = (float) (@mysqli_fetch_assoc($qPengadaan)['total'] ?? 0);

// PENERIMAAN - pakai tabel penerimaan.created_at
$qPenerimaan = mysqli_query($conn, "
    SELECT SUM(dp.sub_total_terima) AS total
    FROM detail_penerimaan dp
    JOIN penerimaan pn ON pn.idpenerimaan = dp.idpenerimaan
    WHERE MONTH(pn.created_at) = '$bulan' AND YEAR(pn.created_at) = '$tahun'
");
$totalPenerimaan = (int) (@mysqli_fetch_assoc($qPenerimaan)['total'] ?? 0);

// Penjualan bulan ini (Rp)
$qPenjualan = mysqli_query($conn, "
    SELECT SUM(total_nilai) AS total
    FROM penjualan
    WHERE MONTH(created_at)='$bulan' AND YEAR(created_at)='$tahun'
");
$totalPenjualan = (float) (@mysqli_fetch_assoc($qPenjualan)['total'] ?? 0);

// RECENT TRANSACTIONS - created_at + total_nilai
$qRecent = mysqli_query($conn, "
    SELECT p.idpenjualan, p.created_at, p.total_nilai, p.status, 
           u.nama_lengkap, IFNULL(SUM(dp.jumlah),0) AS qty
    FROM penjualan p
    LEFT JOIN user u ON p.iduser = u.iduser
    LEFT JOIN detail_penjualan dp ON dp.idpenjualan = p.idpenjualan
    GROUP BY p.idpenjualan
    ORDER BY p.created_at DESC
    LIMIT 5
");

// laporan penjualan (jumlah transaksi)
$qLaporan = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM penjualan
    WHERE MONTH(created_at) = '$bulan' AND YEAR(created_at) = '$tahun'
");
$laporanPenjualan = (int) (@mysqli_fetch_assoc($qLaporan)['total'] ?? 0);

// ==========================
// CHART BULANAN (12 BULAN)
// ==========================
$chartLabels = [];
$chartData   = [];

for ($m = 1; $m <= 12; $m++) {
    $qMonth = mysqli_query($conn, "
        SELECT IFNULL(SUM(total_nilai),0) AS ttl
        FROM penjualan
        WHERE MONTH(created_at) = '$m' AND YEAR(created_at) = '$tahun'
    ");
    $rM = mysqli_fetch_assoc($qMonth);
    $chartLabels[] = date('M', mktime(0, 0, 0, $m, 1));
    $chartData[]   = (float) $rM['ttl'];
}

// ==========================
// CHART MINGGUAN (SEN–MIN)
// ==========================
$weeklyLabels = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
$weeklyData   = [];

$today  = new DateTime();
$w      = (int)$today->format('N');   // 1 = Senin
$monday = clone $today;
$monday->modify('-' . ($w - 1) . ' days');

for ($i = 0; $i < 7; $i++) {
    $d = (clone $monday)->modify("+$i days")->format('Y-m-d');
    $qW = mysqli_query($conn, "
        SELECT IFNULL(SUM(total_nilai),0) AS ttl
        FROM penjualan 
        WHERE DATE(created_at) = '$d'
    ");
    $rW = mysqli_fetch_assoc($qW);
    $weeklyData[] = (float) $rW['ttl'];
}

// ==========================
// RIWAYAT PENJUALAN TERAKHIR
// ==========================
$qRecent = mysqli_query($conn, "
    SELECT p.idpenjualan, p.created_at, p.total_nilai, p.status, 
           u.nama_lengkap, IFNULL(SUM(dp.jumlah),0) AS qty
    FROM penjualan p
    LEFT JOIN user u ON u.iduser = p.iduser
    LEFT JOIN detail_penjualan dp ON dp.idpenjualan = p.idpenjualan
    GROUP BY p.idpenjualan
    ORDER BY p.created_at DESC
    LIMIT 5
");

function human_time_diff($from){
    if(!$from) return "-";
    $from_ts = strtotime($from);
    if(!$from_ts) return "-";
    $diff = time() - $from_ts;
    if ($diff < 60)    return $diff." detik lalu";
    if ($diff < 3600)  return floor($diff/60)." menit lalu";
    if ($diff < 86400) return floor($diff/3600)." jam lalu";
    return floor($diff/86400)." hari lalu";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard Admin - Glow Skincare</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
:root{
    --sidebar-w:260px;
    --card-radius:14px;
    --muted:#6b7280;
    --shadow:0 12px 30px rgba(2,6,23,0.06);
}

*{box-sizing:border-box}
body{
    font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;
    background:#f3f4f6;
    margin:0;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    top:0;left:0;
    width:var(--sidebar-w);
    height:100vh;
    background:linear-gradient(180deg,#6a11cb,#c61fab);
    color:#fff;
    padding:25px;
    transition:.3s;
    z-index:999;
    overflow-y: auto;  
    overflow-x: hidden;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.4);
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar.closed{width:80px;}
.sidebar .brand{display:flex;justify-content:space-between;align-items:center;}
.sidebar.closed h5,
.sidebar.closed small{display:none;}
.sidebar nav a{
    padding:12px 0;
    display:flex;
    align-items:center;
    color:#fff;
    text-decoration:none;
    font-size:16px;
}
.sidebar nav a i{margin-right:10px;}
.sidebar.closed nav a span{display:none;}
#toggleSidebar{
    background:rgba(255,255,255,.3);
    border:none;
    color:#fff;
    width:36px;
    height:36px;
    border-radius:10px;
    font-size:20px;
    cursor:pointer;
}

/* MAIN */
.main{
    margin-left:var(--sidebar-w);
    padding:30px;
    transition:.3s;
}
.sidebar.closed ~ .main{margin-left:80px;}

.header-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:22px;
}
.small-muted{color:var(--muted);font-size:13px}

.grid-cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-bottom:20px;
}
@media (max-width:1100px){
    .grid-cards{grid-template-columns:repeat(2,1fr);}
}
@media (max-width:768px){
    .grid-cards{grid-template-columns:1fr;}
    .main{margin-left:0;padding:16px;}
    .sidebar{position:relative;width:100%;height:auto;}
}

.card-stat{
    color:#fff;
    border-radius:var(--card-radius);
    box-shadow:var(--shadow);
    padding:22px;
    min-height:120px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}
.card-stat .title{font-size:14px;opacity:.95}
.card-stat .value{font-size:30px;font-weight:700;margin-top:8px}

.g1{background:linear-gradient(90deg,#3b82f6,#7c3aed)}
.g2{background:linear-gradient(90deg,#a21caf,#f43f5e)}
.g3{background:linear-gradient(90deg,#06b6d4,#10b981)}
.g4{background:linear-gradient(90deg,#ef4444,#fb7185)}
.g5{background:linear-gradient(90deg,#06b6d4,#06b6d4)}
.g6{background:linear-gradient(90deg,#f97316,#fb923c)}
.g7{background:linear-gradient(90deg,#ec4899,#f472b6)}
.g8{background:linear-gradient(90deg,#0ea5e9,#22c55e)}

.card-white{
    background:#fff;
    border-radius:14px;
    padding:18px;
    box-shadow:var(--shadow);
    margin-bottom:18px;
}
.chart-box{background:#fff;border-radius:14px;padding:18px;box-shadow:var(--shadow);margin-bottom:18px}
.chart-box small{color:var(--muted)}

.recent-item{
    background:#fafafa;
    border-radius:10px;
    padding:14px;
    display:flex;
    align-items:center;
    gap:14px;
    box-shadow:0 2px 0 rgba(0,0,0,.02);
}
.avatar-square{
    width:46px;height:46px;
    border-radius:10px;
    background:linear-gradient(135deg,#f3e8ff,#fce7f3);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#7c3aed;
    font-weight:600;
}
.badge-selesai{background:#d1fae5;color:#065f46;padding:6px 10px;border-radius:999px;font-size:13px}
.badge-diproses{background:#e0f2fe;color:#075985;padding:6px 10px;border-radius:999px;font-size:13px}
.badge-dikemas{background:#fce7f3;color:#831843;padding:6px 10px;border-radius:999px;font-size:13px}
.small-muted-2{color:#9ca3af;font-size:13px}

.logout-btn {
    background: rgba(450, 450, 450, 0.15);
    margin-top: 20px;
    border-radius: 15px;
    transition: .3s;
}

.logout-btn:hover {
    background: #ef4444 !important;
    color: #fff !important;
}
.logout-btn:hover i {
    color: #fff;
}



</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div>
            <h5>Glow Skincare</h5>
            <small>Dashboard SuperAdmin</small>
        </div>
        <button id="toggleSidebar">×</button>
    </div>

    <nav class="mt-4 d-flex flex-column">
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
        <a href="produk/produk.php"><i class="bi bi-box-seam"></i><span>Kategori Produk</span></a>
        <a href="satuan/satuan.php"><i class="bi bi-tags"></i><span>Satuan</span></a>
        <a href="vendor/vendor.php"><i class="bi bi-shop"></i><span>Vendor</span></a>
        <a href="pengadaan/pengadaan.php"><i class="bi bi-truck"></i><span>Pengadaan</span></a>
        <a href="penerimaan/penerimaan.php"><i class="bi bi-check2-square"></i><span>Penerimaan</span></a>
        <a href="retur/retur.php"><i class="bi bi-arrow-repeat"></i><span>Retur</span></a>
        <a href="penjualan/penjualan.php"><i class="bi bi-receipt"></i><span>Transaksi Penjualan</span></a>
        <a href="margin_penjualan/margin_penjualan.php"><i class="bi bi-graph-up-arrow"></i><span>Margin Penjualan</span></a>
        <a href="kartu_stok/kartu_stok.php"><i class="bi bi-clipboard-data"></i><span>Kartu Stok</span></a>

        <hr style="opacity:.3">
        <a href="user/user.php" style="font-weight:700;"><i class="bi bi-people"></i><span>User</span></a>
        <a href="role/role.php"><i class="bi bi-shield-lock"></i><span>Role</span></a>

        <hr style="opacity:.3">
        <a href="../logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
    </nav>
</aside>

<!-- MAIN -->
<main class="main">
    <div class="header-row">
        <div>
            <h1 style="margin:0;font-size:36px;">Dashboard</h1>
            <div class="small-muted">Selamat datang kembali, <?= htmlspecialchars($nama_admin) ?>! 👋</div>
        </div>
        <div style="text-align:right">
            <div id="tanggal" class="small-muted"></div>
            <div id="jam" style="font-weight:700;font-size:20px"></div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="grid-cards">
        <div class="card-stat g1">
            <div class="title">Kategori Barang</div>
            <div class="value"><?= $totalKategori ?></div>
            <div class="small-muted-2">Kategori Aktif</div>
        </div>
        <div class="card-stat g2">
            <div class="title">Total Produk</div>
            <div class="value"><?= $totalProduk ?></div>
            <div class="small-muted-2">Produk Tersedia</div>
        </div>
        <div class="card-stat g3">
            <div class="title">Vendor Aktif</div>
            <div class="value"><?= $totalVendor ?></div>
            <div class="small-muted-2">Vendor Terdaftar</div>
        </div>
        <div class="card-stat g4">
            <div class="title">User Aktif</div>
            <div class="value"><?= $totalUserAktif ?></div>
            <div class="small-muted-2">User Terdaftar</div>
        </div>
        <div class="card-stat g5">
            <div class="title">Penerimaan Bulan Ini</div>
            <div class="value"><?= $totalPenerimaan ?></div>
            <div class="small-muted-2">Total Barang Masuk</div>
        </div>
        <div class="card-stat g6">
            <div class="title">Penjualan Bulan Ini</div>
            <div class="value"><?= rupiah($totalPenjualan) ?></div>
            <div class="small-muted-2">Total Rupiah</div>
        </div>
        <div class="card-stat g7">
            <div class="title">Laporan Penjualan</div>
            <div class="value"><?= $laporanPenjualan ?></div>
            <div class="small-muted-2">Total Transaksi</div>
        </div>
        <div class="card-stat g8">
            <div class="title">Pengadaan Bulan Ini</div>
            <div class="value"><?= rupiah($totalPengadaan) ?></div>
            <div class="small-muted-2">Total Pengeluaran</div>
        </div>
    </div>

    <!-- CHART BULANAN -->
    <div class="chart-box">
        <h5>Statistik Penjualan (Tahun <?= $tahun ?>)</h5>
        <small class="small-muted-2">Grafik penjualan bulanan</small>
        <div style="height:300px;margin-top:12px">
            <canvas id="areaChart" style="width:100%;height:100%"></canvas>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:18px;margin-bottom:20px">

        <!-- CHART MINGGUAN -->
        <div class="card-white">
            <div style="display:flex;justify-content:space-between;align-items:start">
                <div>
                    <h5 style="margin:0">Total Penjualan</h5>
                    <small class="small-muted-2">Minggu ini</small>
                </div>
                <div style="font-size:24px;color:#7c3aed"><i class="bi bi-currency-dollar"></i></div>
            </div>

            <div style="margin-top:12px">
                <div style="font-size:28px;font-weight:700"><?= rupiah(array_sum($weeklyData)) ?></div>
            </div>

            <div style="height:235px;margin-top:12px">
                <canvas id="barChartWeek" style="width:100%;height:100%"></canvas>
            </div>
        </div>

        <!-- RIWAYAT PENJUALAN -->
        <div class="card-white">
            <h5>Riwayat Penjualan Terakhir</h5>
            <p class="small-muted-2">Transaksi terbaru hari ini</p>

            <div style="display:flex;flex-direction:column;gap:12px;margin-top:12px">
            <?php if(mysqli_num_rows($qRecent) == 0): ?>
                <div class="text-muted">Belum ada transaksi.</div>
            <?php else: ?>
                <?php while($r = mysqli_fetch_assoc($qRecent)): 
                    $st = strtolower($r['status'] ?? '');
                    if ($st === 'selesai')      $badge = '<span class="badge-selesai">Selesai</span>';
                    elseif ($st === 'diproses') $badge = '<span class="badge-diproses">Diproses</span>';
                    elseif ($st === 'dikemas')  $badge = '<span class="badge-dikemas">Dikemas</span>';
                    else                        $badge = '<span class="badge-selesai">Selesai</span>';

                    $timeago = human_time_diff($r['created_at']);
                ?>
                <div class="recent-item">
                    <div class="avatar-square"><i class="bi bi-cart"></i></div>
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;gap:8px">
                            <div style="font-weight:700"><?= htmlspecialchars($r['nama_lengkap'] ?: 'Guest') ?></div>
                            <div class="small-muted-2">· <?= $timeago ?></div>
                        </div>
                        <div class="small-muted-2">Jumlah item: <?= (int)$r['qty'] ?></div>
                        <div class="small-muted-2" style="font-family:monospace;margin-top:6px">
                            TRX<?= str_pad($r['idpenjualan'],4,'0',STR_PAD_LEFT) ?>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-weight:700"><?= rupiah($r['total_nilai']) ?></div>
                        <div style="margin-top:8px"><?= $badge ?></div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<!-- JS CHART & JAM -->
<script>
const labelsMonthly = <?= json_encode($chartLabels) ?>;
const dataMonthly   = <?= json_encode($chartData) ?>;
const weeklyLabels  = <?= json_encode(array_values($weeklyLabels)) ?>;
const weeklyData    = <?= json_encode(array_values($weeklyData)) ?>;

// Area chart bulanan
const areaCtx = document.getElementById('areaChart').getContext('2d');
const grad = areaCtx.createLinearGradient(0,0,0,300);
grad.addColorStop(0,'rgba(124,58,237,0.18)');
grad.addColorStop(1,'rgba(124,58,237,0.02)');

new Chart(areaCtx,{
    type:'line',
    data:{
        labels:labelsMonthly,
        datasets:[{
            label:'Penjualan (Rp)',
            data:dataMonthly,
            borderColor:'#7c3aed',
            backgroundColor:grad,
            fill:true,
            tension:0.35,
            pointRadius:3,
            pointBackgroundColor:'#7c3aed',
            borderWidth:2
        }]
    },
    options:{
        responsive:true,
        plugins:{legend:{display:false}},
        scales:{
            y:{
                beginAtZero:true,
                ticks:{
                    callback:(v)=>{
                        if(v>=1000000)return(v/1000000).toFixed(0)+'M';
                        if(v>=1000)return(v/1000).toFixed(0)+'K';
                        return v;
                    }
                },
                grid:{color:'rgba(0,0,0,0.06)',borderDash:[4,6]}
            },
            x:{grid:{display:false}}
        }
    }
});

// Bar chart mingguan
const barCtx = document.getElementById('barChartWeek').getContext('2d');
new Chart(barCtx,{
    type:'bar',
    data:{
        labels:weeklyLabels,
        datasets:[{
            label:'Rp',
            data:weeklyData,
            backgroundColor:'#8b5cf6',
            borderRadius:8,
            barThickness:18
        }]
    },
    options:{
        responsive:true,
        plugins:{legend:{display:false}},
        scales:{
            y:{
                beginAtZero:true,
                grid:{color:'rgba(0,0,0,0.06)',borderDash:[4,6]},
                ticks:{
                    callback:(v)=>{
                        if(v>=1000000)return(v/1000000).toFixed(0)+'M';
                        if(v>=1000)return(v/1000).toFixed(0)+'K';
                        return v;
                    }
                }
            },
            x:{grid:{display:false}}
        }
    }
});

// Jam & tanggal
function updateTime(){
    const now = new Date();
    const opsi = {weekday:'long',year:'numeric',month:'long',day:'numeric'};
    document.getElementById('tanggal').innerText = now.toLocaleDateString('id-ID',opsi);
    document.getElementById('jam').innerText     = now.toLocaleTimeString('id-ID',{hour12:false});
}
setInterval(updateTime,1000);
updateTime();

// Sidebar toggle
const sidebar = document.getElementById("sidebar");
const btn = document.getElementById("toggleSidebar");
btn.addEventListener("click", () => {
    sidebar.classList.toggle("closed");
    btn.innerText = sidebar.classList.contains("closed") ? "☰" : "×";
});
</script>

</body>
</html>
