<?php
require_once 'cek-akses.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $pdo = require 'koneksi.php';
    $sql = "SELECT * FROM komentar WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(array('id' => $_GET['id']));
    $komentar = $query->fetch();

    if (empty($komentar)) {
        // Komentar tidak ditemukan, handle error atau redirect ke halaman lain
    }

    if ($_SESSION['user']['id'] != $komentar['id_user']) {
        // Komentar tidak dimiliki oleh pengguna yang sedang login, handle error atau redirect ke halaman lain
    }
} else {
    // Parameter id tidak tersedia, handle error atau redirect ke halaman lain
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
    <link rel="stylesheet" href="Frontend/jawaban.css">
</head>
<body>
    <?php
    $__menuAktif = '';
    include 'menu.php';
    ?>
    <div class="container">
        <div class="kolom-jawaban">
            <div class="kolom-header">
                <p>Edit Jawaban</p>
            </div>
            <form method="POST" action="proses-edit-komentar.php">
                <div class="kolom-komentar">
                    <textarea type="text" id="komentar" name="komentar" style="resize: none;" rows="5" placeholder="Edit jawaban kamu disini"><?php echo htmlentities($komentar['komentar']); ?></textarea>
                    <input type="hidden" value="<?php echo $komentar['id']; ?>" name="id_komentar">
                    <input type="hidden" value="<?php echo $komentar['id_topik']; ?>" name="id_topik">
                </div>      
                <div class="btn-submit">
                    <button type="submit">Simpan Perubahan</button>
                </div>          
            </form>
        </div>
    </div>
</body>

</html>
