<?php
require_once 'cek-akses.php';

if (empty($_POST)) {
    header ("Location: forum-diskusi.php");
    exit;
}

if (!isset($_POST['id_topik'])) {
    header ("Location: forum-diskusi.php");
    exit;
}

$pdo = require 'koneksi.php';

$sql = "INSERT into komentar (komentar, tanggal, id_topik, id_user)
VALUES (:komentar, now(), :id_topik, :id_user)";

$query = $pdo->prepare($sql);
$query->execute(array(
    'komentar' => $_POST['komentar'],
    'id_topik' => $_POST['id_topik'],
    'id_user' => $_SESSION['user']['id'],
));


header ("Location: jawaban.php?id=".$_POST['id_topik']);
exit;

?>