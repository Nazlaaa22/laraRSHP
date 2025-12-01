<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - RSHP</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #1e56b4, #4b7bec);
            color: #fff;
        }

        nav {
            background-color: #004aad;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        nav .logo {
            font-size: 1.3rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
            margin: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
        }

        nav ul li a:hover {
            color: #ffc107;
        }

        section {
            text-align: center;
            margin-top: 60px;
            padding: 0 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.1rem;
            color: #f0f0f0;
            max-width: 800px;
            margin: 0 auto;
        }

        .layanan-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .layanan-card {
            background: #fff;
            color: #333;
            width: 260px;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }

        .layanan-card:hover {
            transform: translateY(-8px);
        }

        .layanan-card h3 {
            color: #004aad;
            margin-top: 15px;
            font-size: 1.2rem;
        }

        footer {
            background-color: #004aad;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">RSHP</div>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/layanan">Layanan</a></li>
            <li><a href="/kontak">Kontak</a></li>
            <li><a href="/struktur">Struktur Organisasi</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
    </nav>

    <section>
        <h1>Layanan RSHP</h1>
        <p>RSHP menyediakan berbagai layanan kesehatan hewan dengan tenaga medis profesional dan fasilitas modern.</p>

        <div class="layanan-container">
            <div class="layanan-card">
                🩺
                <h3>Rawat Jalan</h3>
                <p>Pelayanan pemeriksaan dan pengobatan hewan tanpa rawat inap.</p>
            </div>

            <div class="layanan-card">
                🏥
                <h3>Rawat Inap</h3>
                <p>Perawatan intensif dengan pemantauan 24 jam oleh dokter hewan.</p>
            </div>

            <div class="layanan-card">
                🚑
                <h3>Gawat Darurat</h3>
                <p>Pelayanan darurat 24 jam untuk hewan dengan kondisi kritis.</p>
            </div>

            <div class="layanan-card">
                💉
                <h3>Vaksinasi & Sterilisasi</h3>
                <p>Layanan pencegahan penyakit dan pengendalian populasi hewan.</p>
            </div>

            <div class="layanan-card">
                🔬
                <h3>Laboratorium Diagnostik</h3>
                <p>Pemeriksaan darah, urin, feses, dan patologi klinik lengkap.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
    </footer>

</body>
</html>
