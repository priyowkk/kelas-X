<?php
$host = "127.0.0.1";
$user = "root";
$pw = "";
$db = "web smp";
$koneksi = mysqli_connect($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <nav class="navbar">
            <div class="nav-logo">
                <a href="index.php"><img src="images/logo-removebg-preview.png" alt=""></a>
                <a href="index.php">
                    <h1>MTSN 1 Sidoarjo</h1>
                    <p>"Santun Dan Berprestasi"</p>
                </a>
            </div>
            <ul class="navbar-nav">
                <li><a href="?menu=beranda">Beranda</a></li>
                <li><a href="?menu=profil">Profil</a></li>
                <li><a href="?menu=berita">Berita</a></li>
                <li><a href="?menu=galeri">Galeri</a></li>
                <li><a href="?menu=agenda">Agenda</a></li>
                <li><a href="?menu=layanan">Layanan</a></li>
                <li><a href="?menu=kontak">Kontak</a></li>
            </ul>
           
        </nav>
        <div class="isi">
        <?php
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
                if ($menu == "agenda") {
                    require_once("pages/agenda.php");
                }
                if ($menu == "beranda") {
                    require_once("pages/beranda.php");
                }
                if ($menu == "berita") {
                    require_once("pages/berita.php");
                }
                if ($menu == "galeri") {
                    require_once("pages/galeri.php");
                }
                if ($menu == "kontak") {
                    require_once("pages/kontak.php");
                }
                if ($menu == "layanan") {
                    require_once("pages/sejarah.php");
                }
            } else {
                require_once("pages/index.php");
            }
            ?>
        </div>
        <div class="page1">
            <button>About Us</button>
        </div>
        <div class="page2">
            <div class="left">
                <img src="images/upacara.jpg" alt="" class="page2-1">
                <img src="images/pres1.jpg" alt="" class="img2">
            </div>
            <div class="right">
                <p>MTs Negeri 1 Sidoarjo <br>
                    MTsN 1 Sidoarjo merupakan salah satu Madrasah Tsanawiyah Negeri unggulan yang berlokasi di Kabupaten Sidoarjo, Jawa Timur. Sebagai lembaga pendidikan Islam di bawah naungan Kementerian Agama, MTsN 1 Sidoarjo berkomitmen untuk menghasilkan lulusan yang unggul dalam prestasi, berakhlak mulia, dan berwawasan global.
                    Visi dan Misi
                    Visi
                    Terwujudnya Madrasah yang Unggul dalam Akhlakul Karimah dan Prestasi
                    Misi

                    Menumbuhkembangkan sikap dan perilaku islami dalam kehidupan sehari-hari
                    Menumbuhkan semangat belajar ilmu agama Islam
                    Melaksanakan bimbingan dan pembelajaran secara aktif, kreatif, efektif, dan menyenangkan
                    Menumbuhkan semangat keunggulan secara intensif dan daya saing yang sehat kepada seluruh warga madrasah baik dalam prestasi akademik maupun non akademik
                    Menciptakan lingkungan madrasah yang sehat, bersih, dan indah
                    Mengembangkan sikap kepekaan terhadap lingkungan
                    Menerapkan manajemen partisipatif dengan melibatkan seluruh warga madrasah dan stakeholder

                    Fasilitas
                    MTsN 1 Sidoarjo dilengkapi dengan berbagai fasilitas modern untuk menunjang kegiatan belajar mengajar:

                    Ruang kelas ber-AC
                    Laboratorium IPA
                    Laboratorium Komputer
                    Perpustakaan Digital
                    Masjid
                    Lapangan Olahraga
                    UKS
                    Kantin Sehat
                    Area Parkir yang Luas

                    Program Unggulan

                    Program Tahfidz Al-Quran
                    English Club
                    Arabic Club
                    Sains Club
                    Program Literasi
                    Ekstrakurikuler:

                    Pramuka
                    PMR
                    Drumband
                    Futsal
                    Bulu Tangkis
                    Pencak Silat
                    Seni Kaligrafi
                    Robotika



                    Prestasi
                    MTsN 1 Sidoarjo telah meraih berbagai prestasi baik di tingkat kabupaten, provinsi, maupun nasional dalam bidang:

                    Olimpiade Sains
                    Kompetisi Robotika
                    MTQ
                    Olahraga
                    Seni dan Budaya

                    Sistem Pembelajaran

                    Kurikulum Merdeka
                    Pembelajaran berbasis IT</p>
            </div>
        </div>
    </div>
</body>

</html>