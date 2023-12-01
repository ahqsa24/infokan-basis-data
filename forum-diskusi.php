<?php
require_once 'cek-akses.php';
date_default_timezone_set('Asia/Jakarta');

if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    $sql = "insert into topik (judul, deskripsi, tanggal, id_user) 
    values (:judul, :deskripsi, now(), :id_user)";
    $query = $pdo->prepare($sql);
    $query->execute(array(
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'id_user' => $_SESSION['user']['id'],
    ));
    header("Location: forum-diskusi.php?sukses=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>

    <link rel="stylesheet" href="Frontend/forum-diskusi.css">
</head>
<body>
    <?php
    $__menuAktif = 'forum';
    include 'menu.php';
    ?>
    <div class="semua-page">
        <div class="forum-page">
            <h1>Pertanyaan</h1>
            <button class="button-tambah"><a href="#popup">+ Buat Pertanyaan</a></button>
        </div>

        <form class="search-form" action="forum-diskusi.php" method="get">
            <input type="text" name="search" id="search" placeholder="Cari pertanyaan...">
            <button type="submit">CARI</button>
        </form>
    
        <div class="popup" id="popup">
            <form method="POST" action="" class="modal-box">
                <h3>Buat Pertanyaan</h3>
                <div class="form-group form-title">
                    <label for="title">Judul</label>
                    <input type="text" id="judul" name="judul" required>
                </div>
                <div class="form-group form-title">
                    <label for="notes">Deskripsi</label>
                    <textarea type="text" id="deskripsi" name="deskripsi" style="resize: none;" rows="5"></textarea>
                </div>
                <div class="buttons">
                    <button class="btn-close"><a href="#">Batal</a></button>
                    <button type="submit "class="btn-submit">Submit</button>
                </div>
            </div>
        </div>

        <div class="wrapper-jawaban">
            <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                $pdo = require 'koneksi.php';
                $sql = "select id_user, topik.id, judul, nama, tanggal FROM topik
                INNER JOIN users ON topik.id_user = users.id
                ORDER BY tanggal DESC";
                $query = $pdo->prepare($sql);
                $query->execute();
          
            ?>
            
            <?php
            while($data = $query->fetch()) {
            ?>
                <figure class="kotak-jawaban">
                    <div class="judul-hapus">
                        <blockquote class="judul-jawaban">
                            <p>
                                <a href="jawaban.php?id=<?php echo htmlentities($data['id']);?>"><?php echo htmlentities($data['judul']);?></a>
                            </p>
                        </blockquote>
                        <?php
                        if ($_SESSION['user']['id'] == $data['id_user']) {?>
                        <div class="hapus-aja">
                            <a href="edit-pertanyaan.php?id=<?php echo $data['id']?>">Edit</a>
                            <a href="hapus-topik.php?id=<?php echo $data['id']?>"
                            onclick="return confirm('Apa anda yakin menghapus topik ini?')">Hapus</a>
                        </div>
                        <?php } ?>
                    </div>
                    <figcaption class="nama-tanggal">
                        <?php echo htmlentities($data['nama']); ?>
                        - <?php echo date('d M Y H:i', strtotime($data['tanggal']));?>
                    </figcaption>
                    
                </figure>
            <?php } ?>
            <?php } ?>
            
            
        </div>
        
    </div>
</body>
<<footer class="bagian-bawah">
    <p>&#169; Infokan <strong>Tempatnya orang habat!</strong></p>
</footer>
</html>