<?php
// connect database
include 'db_config.php'; // Ini menyediakan $koneksi

// 1. AMBIL DATA VISI
$sql_visi = "SELECT * FROM visi";
$result_visi = mysqli_query($koneksi, $sql_visi);
if (!$result_visi) {
    die("Query Visi Gagal: " . mysqli_error($koneksi));
}

// 2. AMBIL DATA MISI
$sql_misi = "SELECT * FROM misi";
$result_misi = mysqli_query($koneksi, $sql_misi);
if (!$result_misi) {
    die("Query Misi Gagal: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>WEBSITE - Desa Teluk Nangka</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">


    <!-- Tambahan CSS Animasi -->
    <style>
        /* Animasi dari kiri */
        .animate-left {
            opacity: 0;
            animation: slideInLeft 3s ease-out forwards;
        }

        @keyframes slideInLeft {
            0% {
                transform: translateX(-100%) scale(0.8);
                opacity: 0;
            }

            60% {
                transform: translateX(10%) scale(1.05);
                opacity: 1;
            }

            100% {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        /* Animasi dari kanan */
        .animate-right {
            opacity: 0;
            animation: slideInRight 3s ease-out forwards;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%) scale(0.8);
                opacity: 0;
            }

            60% {
                transform: translateX(-10%) scale(1.05);
                opacity: 1;
            }

            100% {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        /* Animasi Zoom untuk Navbar */
        .navbar-nav .nav-link {
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            transform: scale(1.2);
            color: #ffcc00 !important;
        }

        /* Efek zoom-in saat halaman dimuat */
        .nav-zoom {
            animation: zoomInNav 0.8s ease-out forwards;
        }

        @keyframes zoomInNav {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    </div>
    <marquee onmouseover="this.stop()" onmouseout="this.start()" style="margin:0;padding:0;line-height:1.2;" class="flexleft">
        <span style="font-family:Arial !important;font-size:100% !important;padding-right: 50px;">
            Selamat datang di Portal Resmi Sistem Informasi Desa Teluk Nangka, Kecamatan Kubu, Kabupaten Kubu Raya <a href="#" rel="noopener noreferrer" title="Baca Selengkapnya"></a>
        </span>
    </marquee>
    </div>
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="home.php" class="navbar-brand px-lg-4 m-0">
                <img src="img/prov.png" alt="Logo Provinsi">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="home.php" class="nav-item nav-link active nav-zoom">HOME</a>
                    <a href="profilkepdes.php" class="nav-item nav-link nav-zoom">PROFIL KEPALA DESA</a>
                    <a href="struktur.php" class="nav-item nav-link nav-zoom">STRUKTUR</a>
                    <!-- Dropdown Informasi Desa -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle nav-zoom" id="informasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            INFORMASI DESA
                        </a>
                        <div class="dropdown-menu" aria-labelledby="informasiDropdown">
                            <a class="dropdown-item" href="datapenduduk.php">Data Penduduk</a>
                            <a class="dropdown-item" href="datawilayah.php">Data Wilayah</a>
                            <a class="dropdown-item" href="apbdesa.php">APB Desa</a>
                        </div>
                    </div>
                    <a href="galeri.php" class="nav-item nav-link nav-zoom">GALERI DESA</a>
                    <a href="denah.php" class="nav-item nav-link nav-zoom">DENAH</a>
                    <div class="nav-item dropdown nav-zoom">
                    </div>
                </div>
            </div>
    </div>
    </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/desa1copy.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0 animate-left">PEMERINTAHAN</h2>
                        <h1 class="display-1 text-white m-0 animate-right">DESA TELUK NANGKA</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang</h4>
                <h1 class="display-4">DESA TELUK NANGKA</h1>
            </div>
            <div class="row">

                <div class="col-lg-4 py-0 py-lg-5">
                    <h3 class="mb-3 text-center">KEUNGGULAN DESA</h3>
                    <p style="text-align: justify; font-size: 1.05rem;">
                        Desa Teluk Nangka dikenal sebagai salah satu desa penghasil gula merah terbesar di Kecamatan Kubu. Potensi gula merah dan kegiatan pertanian lainnya dapat dikembangkan menjadi agrowisata, menarik minat wisatawan untuk berkunjung.
                    </p>
                </div>

                <div class="col-lg-4 py-0 py-lg-5">
                    <h3 class="mb-3 text-center">DESA TELUK NANGKA</h3>
                    <p style="text-align: justify; font-size: 1.05rem;">
                        Teluk Nangka adalah salah satu desa di kecamatan Kubu, Kabupaten Kubu Raya, Kalimantan Barat, Indonesia.
                    </p>
                </div>

                <div class="col-lg-4 py-0 py-lg-5">
                    <h3 class="mb-3 text-center">ETNIS PENDUDUK</h3>
                    <p style="text-align: justify; font-size: 1.05rem;">
                        Kubu Raya, termasuk wilayah Teluk Nangka, dihuni oleh berbagai etnis, termasuk suku Melayu di wilayah pesisir, suku Dayak di pedalaman, dan suku Jawa.
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- About Start -->
    <div class="container">
        <div class="section-title">
            <h1 class="display-4 text-center">VISI & MISI
                <h1 class="display-4 text-center">DESA TELUK NANGKA
                </h1>
        </div>
        <div class="row">
            <!-- VISI -->
            <div class="col-lg-12 py-0 py-lg-5">
                <h1 class="mb-3 text-center">VISI</h1>
                <p style="text-align: justify;">Berdasarkan perkembangan situasi dan kondisi Desa Teluk Nangka saat ini, dan terkait dengan Rencana Pembangunan Jangka Menengah Desa (RPJM-Desa), maka untuk Pembangunan Desa Teluk Nangka pada periode 6 (enam) tahun ke depan (tahun 2022 – 2027), disusun visi dan misi sebagai berikut :</p>
                <p><strong>“Terwujudnya Desa Teluk Nangka sebagai Desa yang Mandiri, Berkarakter, Berbudaya, Sehat, Cerdas, Sejahtera, dan Religius”</strong></p>
                <p>Dengan penjelasan sebagai berikut:</p>
                <ol style="text-align: justify;">
                    <?php while ($data_visi = mysqli_fetch_assoc($result_visi)) { ?>
                        <li><?php echo $data_visi['butir_visi']; ?> </li>
                        <br>
                    <?php } ?>

                </ol>
            </div>

            <!-- MISI -->
            <div class="col-lg-12 py-0 py-lg-5">
                <h1 class="mb-3 text-center">MISI</h1>
                <p style="text-align: justify;">Misi adalah penjabaran rencana aksi untuk mencapai visi. Untuk mewujudkan visi tersebut, maka misi yang akan dilakukan adalah sebagai berikut :</p>

                <ol style="text-align: justify;">
                    <?php while ($data_misi = mysqli_fetch_assoc($result_misi)) { ?>
                        <li><?php echo $data_misi['butir_misi']; ?></li>
                        <br>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Footer Start -->
 <?php include 'footer.php';?>