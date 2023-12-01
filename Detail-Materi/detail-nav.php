<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../Frontend/menu.css">
</head>
<body>
    <nav class="navbar-container">
        <div class="nav-list">
            <ul class="nav-kiri">
                <li><img src="../Frontend/Assets/Logo.svg" alt="Infokan"></li>
            </ul>
            <ul class="nav-tengah">
                <li><a <?php echo $__menuAktif == 'home' ? 'active' : ''?> href="../index.php">Home</a></li>
                <li><a <?php echo $__menuAktif == 'notes' ? 'active' : ''?> href="../notes.php">Notes</a></li>
                <li><a <?php echo $__menuAktif == 'forum' ? 'active' : ''?> href="../forum-diskusi.php">Forum Diskusi</a></li>
                <li><a <?php echo $__menuAktif == 'profil' ? 'active' : ''?> href="../profile.php">Profil</a></li>
            </ul>
            <ul class="nav-kanan">
                <li><a href="logout.php" class="tbl-hitam">LOGOUT</a></li>
            </ul>
        </div>
    </nav>

</body>
</html>