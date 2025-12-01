<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - RSHP</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        nav {
            background-color: #004aad;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            color: #fff;
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
            padding: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffc107;
        }

        /* Hero */
        .hero {
            background: linear-gradient(180deg, #1e56b4, #4b7bec);
            color: white;
            text-align: center;
            padding: 70px 20px;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        /* Konten Struktur */
        .struktur-container {
            text-align: center;
            padding: 60px 20px;
        }

        .struktur-container h2 {
            color: #004aad;
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .struktur {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .direktur img {
            width: 180px;
            height: auto;
            border-radius: 10px;
            border: 3px solid #004aad;
        }

        .direktur h3 {
            margin: 15px 0 5px 0;
            color: #004aad;
        }

        .direktur p {
            margin: 0;
        }

        .wakil-wrapper {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 60px;
        }

        .wakil {
            width: 250px;
            text-align: center;
        }

        .wakil img {
            width: 150px;
            height: auto;
            border-radius: 10px;
            border: 3px solid #004aad;
        }

        .wakil h4 {
            margin-top: 15px;
            color: #004aad;
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
            <li><a href="{{ route('site.layanan') }}">Layanan</a></li>
            <li><a href="{{ route('site.kontak') }}">Kontak</a></li>
            <li><a href="{{ route('site.struktur') }}">Struktur Organisasi</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
    </nav>

    <section class="hero">
        <h1>Struktur Pimpinan RSHP Universitas Airlangga</h1>
    </section>

    <section class="struktur-container">
        <div class="struktur">
            <div class="direktur">
                <img src="/images/direktur.jpg" alt="Direktur RSHP">
                <h3>Dr. Ira Sari Yudaniyanti, M.P., drh.</h3>
                <p><strong>Direktur</strong></p>
            </div>

            <div class="wakil-wrapper">
                <div class="wakil">
                    <img src="/images/wadir1.jpg" alt="Wakil Direktur 1">
                    <h4>Dr. Nusianto Triakoso, M.P., drh.</h4>
                    <p>Wakil Direktur I<br>Pelayanan Medis, Pendidikan dan Penelitian</p>
                </div>
                <div class="wakil">
                    <img src="/images/wadir2.jpg" alt="Wakil Direktur 2">
                    <h4>Dr. Miyayu Soneta S., M.Vet., drh.</h4>
                    <p>Wakil Direktur II<br>Sumber Daya Manusia, Sarana Prasarana dan Keuangan</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
    </footer>

</body>
</html>
