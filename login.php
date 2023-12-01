<?php 
session_start();
$hasil = true;
if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    $sql = "select * from users where username = :username";
    $query = $pdo->prepare($sql); 
    $query->execute(array('username' => $_POST['username']));
    $user = $query->fetch();
    if (!$user) {
        $hasil = false;
    } elseif (sha1($_POST['password']) != $user['password']) {
        $hasil = false;
    } else {
        $hasil = true;
        $_SESSION['user'] = array(
            'id' => $user['id'],
            'nama' => $user['nama'],
            'username' => $user['username'],
            'email' => $user['email'],
        );

        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Frontend/login.css">
</head>
<body>
    <div class="container">
        <div class="login-left">
            <div class="login-header">
                <img src="Frontend/Assets/Logo.svg" alt="Logo Infokan">
            </div>
            <?php
            if (!$hasil) {
                echo '<p class="text-register">Email atau password salah</p>';
            }
            ?>
            <form class="login-form" method="POST" action="">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="emailForm">Username</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="button-login">
                        <button>LOG-IN</button>
                    </div>
                    <div class="register-text">
                        Belum punya akun? <a href="register.php">Daftar disini</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-right">
            <p class="login-text">Selamat <br> Datang <br> Siswa <br> Hebat!</p>
        </div>
    </div>
</body>
</html>