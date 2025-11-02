<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - RSHP</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        nav {
            background-color: #004aad;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: relative;
            z-index: 2;
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

        nav ul li {
            cursor: pointer;
            transition: color 0.3s;
            font-weight: 500;
        }

        nav ul li:hover {
            color: #ffc107;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffc107;
        }

        .hero {
            position: relative;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url("/images/rshp.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(30,86,180,0.85), rgba(75,123,236,0.85));
            z-index: 1;
        }

        .hero .content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .hero p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #f0f0f0;
            max-width: 800px;
            margin: 0 auto; 
        }

        .btn-layanan {
            display: inline-block;
            background-color: #e63946;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-layanan:hover {
            background-color: #d62828;
            transform: scale(1.05);
        }

        .layanan {
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px 20px;
        }

        .layanan h2 {
            font-size: 2rem;
            margin-bottom: 50px;
            color: #003b91;
        }

        .layanan-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .layanan-card {
            background-color: #fff;
            width: 250px;
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            font-size: 3rem;
        }

        .layanan-card h3 {
            margin-top: 15px;
            font-size: 1.2rem;
            color: #004aad;
        }

        .layanan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        footer {
            background-color: #004aad;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 200px;
        }

    </style>
</head>
<body>

    <nav>
        <div class="logo">RSHP</div>
        <ul>
            <li>Home</li>
            <li><a href="{{ route('site.layanan') }}">Layanan</a></li>
            <li><a href="{{ route('site.kontak') }}">Kontak</a></li>
            <li><a href="{{ route('site.struktur') }}">Struktur Organisasi</a></li>
            <li><a href="/login" style="text-decoration:none; color:white;">Login</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="content">
            <h1>Selamat Datang di RSHP</h1>
            <p>Rumah Sakit Hewan Pendidikan - Memberikan pelayanan kesehatan terbaik 
               dengan teknologi modern dan tenaga medis profesional untuk kesembuhan 
               dan kenyamanan Anda.</p>
            <a href="/layanan" class="btn-layanan">Lihat Layanan Kami</a>
        </div>
    </section>

    <section class="layanan">
        <h2>Layanan Kami</h2>

        <div class="layanan-container">
            <div class="layanan-card">
                🏥
                <h3>Rawat Inap</h3>
            </div>

            <div class="layanan-card">
                🚑
                <h3>Unit Gawat Darurat</h3>
            </div>

            <div class="layanan-card">
                👩‍⚕️
                <h3>Rawat Jalan</h3>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
    </footer>

</body>
</html>
