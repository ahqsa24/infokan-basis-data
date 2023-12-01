<?php
require_once 'cek-akses.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header ("Location: notes.php");
    exit;
}

$pdo = require 'koneksi.php';
$sql = "SELECT * FROM notes WHERE id=:id and id_user=:id_user";
$query = $pdo->prepare($sql);
$query->execute(array(
    'id' => $_GET['id'],
    'id_user' => $_SESSION['user']['id'],
));
$notes = $query->fetch();
if (!$notes) {
    header ("Location: notes.php");
    exit;
}

$sqlHapus = "DELETE FROM notes WHERE id=:id and id_user=:id_user";
$queryHapus = $pdo->prepare($sqlHapus);
$queryHapus->execute(array(
    'id' => $_GET['id'],
    'id_user' => $_SESSION['user']['id'],
));

header ("Location: notes.php?id=".$notes['id_topik']);

?>