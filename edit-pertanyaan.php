<?php
require_once 'cek-akses.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_topik = $_GET['id'];

    if (!empty($_POST)) {
        $pdo = require 'koneksi.php';
        $sql = "UPDATE topik SET judul = :judul, deskripsi = :deskripsi WHERE id = :id AND id_user = :id_user";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            'judul' => $_POST['judul'],
            'deskripsi' => $_POST['deskripsi'],
            'id' => $id_topik,
            'id_user' => $_SESSION['user']['id'],
        ));
        header("Location: edit-pertanyaan.php?sukses=1");
        exit;
    } else {
        // Ambil data catatan yang akan disunting
        $pdo = require 'koneksi.php';
        $sql = "SELECT * FROM topik WHERE id = :id AND id_user = :id_user";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            'id' => $id_topik,
            'id_user' => $_SESSION['user']['id'],
        ));
        $topik = $query->fetch();
    }
} else {
    // Redirect ke halaman catatan jika tidak ada ID yang diberikan
    header("Location: forum-diskusi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pertanyaan</title>

    <link rel="stylesheet" href="Frontend/pertanyaan.css">
</head>
<body>
<?php
$__menuAktif = '';
include 'menu.php';
?>
        <div class="position" id="popup">
            <form method="POST" action="" class="modal-box">
                <h3>Edit Pertanyaan</h3>
                <div class="form-group form-title">
                    <label for="title">Judul</label>
                    <input type="text" id="judul" name="judul" value="<?php echo ($topik['judul']);?>" required>
                </div>
                <div class="form-group form-title">
                    <label for="notes">Deskripsi</label>
                    <textarea type="text" id="deskripsi" name="deskripsi" style="resize: none;" rows="5"><?php echo ($topik['deskripsi']);?></textarea>
                </div>
                <div class="buttons">
                    <button class="btn-close"><a href="forum-diskusi.php">Batal</a></button>
                    <button type="submit "class="btn-submit">Submit</button>
                </div>
            </div>
        </div>
</body>
</html>