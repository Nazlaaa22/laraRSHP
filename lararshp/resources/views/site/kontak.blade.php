<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - RSHP</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Navbar tetap sama seperti halaman home */
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
            transition: color 0.3s;
            font-weight: 500;
        }

        nav ul li a:hover {
            color: #ffc107;
        }

        /* Hero mini di atas */
        .hero {
            background: linear-gradient(180deg, #1e56b4, #4b7bec);
            color: white;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        /* Konten utama */
        .kontak-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            padding: 60px 20px;
        }

        /* Formulir */
        .form-box {
            background-color: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        .form-box h2 {
            color: #004aad;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-family: inherit;
            font-size: 1rem;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button {
            background-color: #004aad;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #003c8a;
        }

        /* Info kontak */
        .info-box {
            background-color: #004aad;
            color: white;
            border-radius: 15px;
            padding: 30px 40px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .info-box h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .info-item {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .info-item span {
            font-weight: bold;
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
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda dalam layanan kesehatan hewan</p>
    </section>

    <div class="kontak-container">
        <!-- Formulir -->
        <div class="form-box">
            <h2>Kirim Pesan</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda">
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda..."></textarea>
                </div>

                <button type="submit">Kirim</button>
            </form>
        </div>

        <!-- Info Kontak -->
        <div class="info-box">
            <h3>Informasi Kontak</h3>
            <div class="info-item">
                <span>Alamat:</span><br>
                Kampus C Universitas Airlangga, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115
            </div>
            <div class="info-item">
                <span>Telepon:</span><br>
                +62 315927832
            </div>
            <div class="info-item">
                <span>Email:</span><br>
                rshp@fkh.unair.ac.id
            </div>
        </div>
    </div>

</body>
</html>
