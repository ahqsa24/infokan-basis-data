<?php
require_once 'cek-akses.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_notes = $_GET['id'];

    if (!empty($_POST)) {
        $pdo = require 'koneksi.php';
        $sql = "UPDATE notes SET materi = :materi, judul = :judul, isi = :isi WHERE id = :id AND id_user = :id_user";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            'materi' => $_POST['materi'],
            'judul' => $_POST['judul'],
            'isi' => $_POST['isi'],
            'id' => $id_notes,
            'id_user' => $_SESSION['user']['id'],
        ));
        header("Location: edit-notes.php?sukses=1");
        exit;
    } else {
        // Ambil data catatan yang akan disunting
        $pdo = require 'koneksi.php';
        $sql = "SELECT * FROM notes WHERE id = :id AND id_user = :id_user";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            'id' => $id_notes,
            'id_user' => $_SESSION['user']['id'],
        ));
        $notes = $query->fetch();
    }
} else {
    // Redirect ke halaman catatan jika tidak ada ID yang diberikan
    header("Location: notes.php");
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
$__menuAktif = '';
include 'menu.php';
?>

    <div class="wrapper">
        <div class="container bg-white shadow">
            <h2 class="container-header text-center">NOTES</h2>

            <form class="form" method="POST" action="">
                <select class="matkul" name="materi" required>
                    <option value="<?php echo $notes['materi']; ?>"><?php echo $notes['materi']; ?></option>
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
                    <input type="text" id="title" name="judul" value="<?php echo ($notes['judul']);?>" required>
                </div>
                <div class="form-group form-title">
                    <label for="notes">Masukkan Notes</label>
                    <textarea type="text" id="notes" name="isi" style="resize: none;" rows="5"><?php echo ($notes['isi']);?></textarea>
                </div>
               
                <button class="btn-submit">SIMPAN PERUBAHAN</button>
            </form>
        </div>