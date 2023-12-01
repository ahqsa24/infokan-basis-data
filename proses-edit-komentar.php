<?php
require_once 'cek-akses.php';

if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    $sql = "UPDATE komentar SET komentar = :komentar WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(array(
        'komentar' => $_POST['komentar'],
        'id' => $_POST['id_komentar'],
    ));

    // Redirect kembali ke halaman dengan komentar setelah diedit
    header("Location: jawaban.php?id=" . $_POST['id_topik']);
    exit;
} else {
    // Formulir tidak dikirimkan, handle error atau redirect ke halaman lain
}
?>
