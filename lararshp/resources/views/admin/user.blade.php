<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar User dan Role | RSHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fbff;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #004aad;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        h2 {
            color: #004aad;
            font-weight: 700;
        }
        th {
            background-color: #cfe2ff;
        }
        td, th {
            vertical-align: middle !important;
            text-align: left;
        }
        .btn-back {
            background-color: #004aad;
            color: white;
            font-weight: 500;
        }
        .btn-back:hover {
            background-color: #003b91;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin">🐾 Admin RSHP</a>
    <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
  </div>
</nav>

<div class="container">
  <div class="text-center mt-5">
    <h2>👥 Daftar User dan Role</h2>
    <p class="text-muted">Menampilkan semua pengguna sistem beserta peran (role)-nya</p>
  </div>

<div class="card shadow-sm border-0 rounded-4 p-3" style="background: var(--card-bg);">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-primary text-dark">
        <tr>
          <th style="width: 10%">ID</th>
          <th style="width: 25%">Nama</th>
          <th style="width: 30%">Email</th>
          <th style="width: 25%">Role</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $item)
        <tr>
          <td class="text-start ps-4">{{ $item->iduser }}</td>
          <td class="text-start">{{ $item->nama }}</td>
          <td class="text-start">{{ $item->email }}</td>
          <td class="text-start">{{ $item->nama_role }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="text-start mt-3">
      <a href="/admin" class="btn btn-back">← Kembali ke Dashboard</a>
    </div>
  </div>
</div>

</body>
</html>
