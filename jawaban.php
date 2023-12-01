<?php
require_once 'cek-akses.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolom Jawaban</title>

    <link rel="stylesheet" href="Frontend/jawaban.css">
</head>
<body>
<?php
    $__menuAktif = '';
    include 'menu.php';
    ?>
    <div class="container">
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $pdo = require 'koneksi.php';
            $sql = "SELECT topik.*, users.nama, users.username, users.email FROM topik
            INNER JOIN users ON topik.id_user = users.id
            WHERE topik.id = :id";
            $query = $pdo->prepare($sql);
            $query->execute(array('id' => $_GET['id']));
            $topik = $query->fetch();
            if (empty($topik)) {
                echo '<p>Pertanyaan tidak ditemukan</p>';
            } else {
                ?>
                <div class="jawaban-user">
                    <div class="nama-user">
                        <img src="Frontend/Assets/User.svg" alt="">
                        <h2 class="username"><?php echo htmlentities ($topik['nama']); ?></h2>
                    </div>
                    <p class="tanggal-1"><?php echo date('d M Y H:i', strtotime($topik['tanggal']));?></p>
                    <div class="isi-pertanyaan">
                        <h4><?php echo htmlentities($topik['judul']); ?></h4>
                        <p><?php echo nl2br(htmlentities($topik['deskripsi'])); ?></p>
                    </div>
                    <hr>
                    <?php 
                    $sql2 = "SELECT komentar. *, users.nama, users.username FROM komentar
                    INNER JOIN users ON users.id = komentar.id_user
                    WHERE id_topik = :id_topik";
                    $query2 = $pdo->prepare($sql2);
                    $query2->execute(array(
                        'id_topik' => $_GET['id'],
                    ));
                    while($komentar = $query2->fetch()) {
                    ?>
                    <div class="wrapper-komentar">
                        <div class="kotak-jawaban">
                            <div class="hapus-tanggal">
                                <div class="nama-user-jawab">
                                    <img src="Frontend/Assets/UserPutih.svg" alt="">
                                    <h2><?php echo htmlentities ($komentar['nama']); ?></h2>
                                </div>
                                <?php
                                if ($_SESSION['user']['id'] == $komentar['id_user']) {?>
                                <div class="tombol-hapus">
                                    <a href="edit-jawaban.php?id=<?php echo $komentar['id']; ?>">Edit</a>
                                    <a href="hapus-komentar.php?id=<?php echo $komentar['id'];?>"
                                    onclick = "return confirm('Apakah anda yakin menghapus komentar ini?')">Hapus</a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="">
                                <p class="tanggal"><?php echo date('d M Y H:i', strtotime($topik['tanggal']));?></p>
                            </div>
                            <div class="jawab-pertanyaan">
                               <p><?php echo nl2br(htmlentities($komentar['komentar'])); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="kolom-jawaban">
                        <div class="kolom-header">
                            <p>Jawaban</p>
                        </div>
                        <form method="POST" action="jawab-pertanyaan.php">
                            <div class="kolom-komentar">
                                <textarea type="text" id="komentar" name="komentar" style="resize: none;" rows="5" placeholder="Tuliskan jawaban kamu disini"></textarea>
                                <input type="hidden" value="<?php echo $topik['id'];?>" name="id_topik">
                            </div>      
                            <div class="btn-submit">
                                <button type="submit">Kirim</button>
                            </div>          
                        </form>
                    </div>
                </div>
                <?php
                }
            }
            ?>
        
</body>
<footer class="bagian-bawah">
    <p>&#169; Infokan <strong>Tempatnya orang habat!</strong></p>
</footer>
</html>