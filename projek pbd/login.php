<?php
include "config/database.php";
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "
        SELECT * FROM user 
        WHERE username='$user' AND password='$pass'
        LIMIT 1
    ");

    if (mysqli_num_rows($q) > 0) {
        $d = mysqli_fetch_assoc($q);

        $_SESSION['iduser'] = $d['iduser'];
        $_SESSION['nama_lengkap'] = $d['nama_lengkap'];

        echo "<script>
                alert('Login berhasil!');
                window.location.href='pages/dashboard.php';
              </script>";
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login - Glow Skincare</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }

    .left-pane {
        flex: 1.3;
        background: linear-gradient(135deg, #6a11cb, #c61fab);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-left: 70px;
        color: white;
        animation: fadeInLeft 1.2s ease;
    }

    .left-pane h1 {
        font-size: 55px;
        font-weight: 800;
        margin-bottom: 10px;
        line-height: 1.1;
    }

    .left-pane p {
        font-size: 20px;
        opacity: .9;
    }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .right-pane {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeInUp 1.2s ease;
        background: #f8f9fc;
    }

    .login-box {
        width: 80%;
        max-width: 350px;
        background: white;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,.1);
        animation: fadeInUp 1.3s ease;
    }

    .login-box h3 {
        font-weight: 700;
        text-align: center;
        margin-bottom: 10px;
    }

    .btn-login {
        background: #6a11cb;
        border: none;
        width: 100%;
        height: 48px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #5509aa;
    }
</style>

</head>
<body>

<div class="left-pane">
    <h1>Glow<br>Skincare</h1>
    <p>Cerahkan Kulitmu<br>Dengan Berbelanja Disini</p>
</div>

<div class="right-pane">
    <form class="login-box" action="cek_login.php" method="POST">

        <h3>Login</h3>

        <label class="mt-3">Username</label>
        <input type="text" name="username" class="form-control" required>

        <label class="mt-3">Password</label>
        <input type="password" name="password" class="form-control" required>

        <button class="btn-login" name="login">Login</button>
    </form>
</div>

</body>
</html>
