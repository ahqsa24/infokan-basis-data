<?php
require_once 'cek-akses.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/main-menu.css">
    <title>Main Menu</title>
</head>
<body>
    <?php
    $__menuAktif = 'home';
    include 'menu.php';
    ?>
    <form class="search-form" action="#" method="get">
        <input type="text" id="filter" placeholder="Apa yang ingin anda pelajari...">
        <button type="submit">CARI</button>
    </form>
    <div class="designer-kita">
        <div class="the-card card">
            <img src="Frontend/Assets/Alinkom.svg" alt="">
            <h4>Aljabar Linear untuk Komputasi</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-alinkom.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/Alprog.svg" alt="">
            <h4>Algoritma dan Dasar Pemrograman</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-alprog.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/Basdat.svg" alt="">
            <h4>Basis Data<br><br></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-basdat.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/PMK.svg" alt="">
            <h4>Pengantar Matematika Komputasi</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-PMK.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/PMK.svg" alt="">
            <h4>Teori Peluang<br><br></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-telang.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/Radig.svg" alt="">
            <h4>Rangkaian Digital<br><br></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-radig.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/DPP.svg" alt="">
            <h4>Struktur Diskret<br><br></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-Strukdis.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/Gravika.svg" alt="">
            <h4>Desain Pengalaman Pengguna</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-dpp.php"><strong>DETAIL</strong></a></h3>
        </div>
        <div class="the-card card">
            <img src="Frontend/Assets/Pemrog.svg" alt="">
            <h4>Pemrograman<br><br></h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat excepturi enim suscipit fuga et ea.</p>
            <h3 class="tbl-kuning"><a href="Detail-Materi/detail-pemrog.php"><strong>DETAIL</strong></a></h3>
        </div>
    </div>

    <footer class="bagian-bawah">
        <p>&#169; Infokan <strong>Tempatnya orang habat!</strong></p>
    </footer>
    <script>
        const filter = document.getElementById('filter');
        const items = document.getSelectorAll('h4');

        filter.addEventListener("input", (e) => filterData(e.target.value));

        function filterData(search) {
            items.forEach(item => {
                if (item.innerText.toLowerCase().includes(search.toLowerCase())) {
                    item.classList.remove('d-none');
                } else {
                    item.classList.add('d-none');
                }
            })
        }
    </script>
</body>
</html>