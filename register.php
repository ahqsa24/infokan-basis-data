<?php
$error = '';
$hasil = false;
if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    if ($_POST['password'] != $_POST['password2']) {
        $error = 'Password tidak sama';
    } else if (strlen($_POST['password']) < 8) {
        $error = 'Password minimal 8 karakter';
    } else {
        // Validasi email
        $sql = "select count(*) from users where email =:emailUser";
        $query = $pdo->prepare($sql);
        $query->execute(array('emailUser' => $_POST['email']));
        $count = $query->fetchColumn();
        if ($count > 0) {
            $error = 'Gunakan email lain';
        } else {
            $sql = "insert into users (nama, username, email, password) 
            values (:nama, :username, :email, :password)";
            $query2 = $pdo->prepare($sql);
            $query2->execute(array(
                'nama' => $_POST['nama'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => sha1($_POST['password']),
            ));
            $hasil = true;
            unset($_POST);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="Frontend/login.css" rel="stylesheet">
</head>
<body>
   
    <div class="container">
        <div class="login-left-reg">
            <div class="login-header">
                <img src="Frontend/Assets/Logo.svg" alt="Logo Infokan">
            </div>
            <?php if ($hasil == true) {?>
            <p class="text-register">
                Registrasi berhasil, silahkan login!
            </p>
            <?php } ?>
            <?php 
            if ($error != '') {
                echo '<p class="text-register">' . $error . '</p>';
            }
            ?>
            <form class="login-form" method="POST" action="">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="nameForm">Nama</label>
                        <input type="text" name="nama" required value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : '';?>">
                    </div>
                    <div class="form-item">
                        <label for="emailForm">Username</label>
                        <input type="text" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : '';?>">
                    </div>
                    <div class="form-item">
                        <label for="emailForm">Email</label>
                        <input type="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Konfirmasi Password</label>
                        <input type="password" name="password2" required>
                    </div>

                    <div class="button-login">
                        <button>REGISTER</button>
                    </div>
                    <div class="register-text">
                        Sudah punya akun? <a href="login.php">Login disini</a>
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