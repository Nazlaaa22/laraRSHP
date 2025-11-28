<?php
session_start();
include "config/database.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, 
        "SELECT user.*, role.nama_role 
         FROM user 
         LEFT JOIN role ON role.idrole = user.idrole
         WHERE username='$username' AND password='$password'
         LIMIT 1"
    );

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        // simpan session
        $_SESSION['iduser'] = $user['iduser'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['nama_role'];

        // arahkan berdasarkan role
        if ($user['nama_role'] == "Superadmin") {
            header("Location: pages/dashboard.php?role=superadmin");
        } else {
            header("Location: pages/dashboard.php");
        }
        exit;

    } else {
        echo "<script>
                alert('Username atau password salah!');
                window.location.href='login.php';
              </script>";
    }
}
?>
