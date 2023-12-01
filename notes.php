<?php
require_once 'cek-akses.php';
if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    $sql = "insert into notes (materi, judul, isi, id_user) 
    values (:materi, :judul, :isi, :id_user)";
    $query = $pdo->prepare($sql);
    $query->execute(array(
        'materi' => $_POST['materi'],
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi'],
        'id_user' => $_SESSION['user']['id'],
    ));
    header("Location: notes.php?sukses=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="Frontend/notes.css">
</head>

<body>
<?php
$__menuAktif = 'notes';
include 'menu.php';
?>
    <div class="wrapper">
        <div class="container bg-white shadow">
            <h2 class="container-header text-center">NOTES</h2>

            <form class="form" method="POST" action="">
                <select class="matkul" name="materi" required>
                    <option value="">Pilih Materi</option>
                    <option value="Algoritme dan Dasar Pemrograman">Algoritme dan Dasar Pemrograman</option>
                    <option value="Aljabar Linear untuk Komputasi">Aljabar Linear untuk Komputasi</option>
                    <option value="Basis Data">Basis Data</option>
                    <option value="Pengantar Matematika Komputasi">Pengantar Matematika Komputasi</option>
                    <option value="Teori Peluang">Teori Peluang</option>
                    <option value="Rangkaian Digital">Rangkaian Digital</option>
                    <option value="Struktur Diskret">Struktur Diskret</option>
                    <option value="Pemrograman">Pemrograman</option>
                </select>
                <p></p>
                <div class="form-group form-title">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="judul" required>
                </div>
                <div class="form-group form-title">
                    <label for="notes">Masukkan Notes</label>
                    <textarea type="text" id="notes" name="isi" style="resize: none;" rows="5"></textarea>
                </div>
               
                <button class="btn-submit">TAMBAHKAN NOTES</button>
            </form>
        </div>

        <div class="container-text">
            <p>YOUR NOTES</p>
        </div>
        <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                $pdo = require 'koneksi.php';
                $sql = "select id_user, notes.id, materi, judul, isi FROM notes
                INNER JOIN users ON notes.id_user = users.id
                ORDER BY judul DESC";
                $query = $pdo->prepare("select * from notes where id_user = :id_user");
                $query->execute(array(
                    'id_user' => $_SESSION['user']['id'],
                ));
            ?>
            
            <?php
            while($data = $query->fetch()) {
            ?>
                <div class="container">
                    <h2 class="container-header"><?php echo htmlentities ($data['materi']); ?></h2>
                    <div class="list-item" id="todos">
                        <h3><?php echo htmlentities ($data['judul']); ?></h3>
                        <h4><?php echo htmlentities ($data['isi']); ?></h4>
                    </div>
                    <div class="container-button">
                        <button class="buttons"><a href="edit-notes.php?id=<?php echo $data['id'];?>">Edit</a></button>
                        <button class="buttons"><a href="hapus-notes.php?id=<?php echo $data['id'];?>"
                            onclick = "return confirm('Apakah anda yakin menghapus notes ini?')">Hapus</a></button>
                    </div>
                </div>
            <?php } ?>
            <?php } ?>
        
    </div>
    
    
</body>
<footer class="bagian-bawah">
    <p>&#169; Infokan <strong>Tempatnya orang habat!</strong></p>
</footer>

</html>