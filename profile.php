<?php
require_once 'cek-akses.php';
$pdo = include 'koneksi.php';
$sql = "SELECT * FROM users WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array('id' => $_SESSION['user']['id']));
$user = $query->fetch();


$error = '';
if (!empty($_POST)) {
    // Validasi username harus unik
    $sqlUsername = "SELECT count(*) FROM users
        WHERE username = :username AND id != :id";
    $queryUsername = $pdo->prepare($sqlUsername);
    $queryUsername->execute(array(
        'username' => $_POST['username'],
        'id' => $_SESSION['user']['id'],
    ));
    $count = $queryUsername->fetchColumn();
    if ($count > 0) {
        $error = 'Username telah digunakan, silahkan gunakan username lain';
    } else {
        $queryUpdate = "UPDATE users SET nama = :nama, username = :username, email = :email
            WHERE id=:id";
        $queryUpdate = $pdo->prepare($queryUpdate);
        $queryUpdate->execute(array(
            'nama' => $_POST['nama'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'id' => $_SESSION['user']['id'],
        ));

        // Update data session
        $_SESSION['user']['nama'] = $_POST['nama'];
        $_SESSION['user']['usernmae'] = $_POST['username'];
        $_SESSION['user']['email'] = $_POST['email'];

        if (!empty($_POST['password_lama']) && !empty($_POST['password_baru'])) {
            if (sha1($_POST['password_lama']) != $user['password']) {
                $error = 'Password lama salah';
            } else if (strlen($_POST['password_baru']) < 8) {
                $error = 'Password minimal 8 karakter';
            } else {
                if ($_POST['password_baru'] != $_POST['password_baru2']) {
                    $error = 'Password baru tidak sama';
                } else {
                    $sqlPassword = "UPDATE users set password = :password
                        WHERE id = :id";
                    $queryPassword = $pdo->prepare($sqlPassword);
                    $queryPassword->execute(array(
                        'password' => sha1($_POST['password_baru']),
                        'id' => $_SESSION['user']['id'],
                    ));
                }
            }
        } else {
            header("Location: profile.php");
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>

    <link rel="stylesheet" href="Frontend/profil.css">
</head>
<body>
    <?php
    $__menuAktif = 'profil';
    include 'menu.php';
    ?>
    <div class="container">
        <div class="profile-container">
            <div class="container-header">
                <div class="user-picture">
                    <img src="Assets/UserPutih.svg" alt="">
                </div>
                <div class="user-name">
                    <h2><?php echo htmlentities ($user['nama']);?></h2>
                </div>
            </div>
            <div class="profile-form">
                <?php
                    if ($error != '') {
                        echo '<p class="text-register">'.$error.'</p>';
                    }
                ?>
                    <form method="POST" action="">
                    <div class="form-user">
                        <div class="container-kiri">
                            <div class="form-container">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-input" name="nama" 
                                    value="<?php echo isset ($_POST['nama']) ? $_POST['nama'] : $user['nama'];?>" required>
                            </div>
                            <div class="form-container">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-input" name="username"
                                    value="<?php echo isset ($_POST['username']) ? $_POST['username'] : $user['username'];?>" required>
                            </div>
                            <div class="form-container">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-input" name="email"
                                    value="<?php echo isset ($_POST['email']) ? $_POST['email'] : $user['email'];?>" required>
                            </div>
                        </div>
                        <div class="container-kanan">
                            <div class="form-container">
                                <label class="form-label">Password Lama</label>
                                <input type="password" class="form-input" name="password_lama">
                            </div>
                            <div class="form-container">
                                <label class="form-label">Password Baru</label>
                                <input type="password" class="form-input" name="password_baru">
                            </div>
                            <div class="form-container">
                                <label class="form-label">Ketik ulang password baru</label>
                                <input type="password" class="form-input" name="password_baru2">
                            </div>
                            <div class="text-end">
                                <button class="btn-submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>

    
</body>
</html>