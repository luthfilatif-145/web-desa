<?php
// connect database
include 'db_config.php'; // Ini menyediakan $koneksi

// --- Query 1: Ambil Kepala Desa ---
$sql_kades = "SELECT * FROM perangkat_desa WHERE jabatan = 'Kepala Desa' LIMIT 1";
$result_kades = mysqli_query($koneksi, $sql_kades);
if (!$result_kades) {
    die("Query Kades Gagal: " . mysqli_error($koneksi));
}
$kades = mysqli_fetch_assoc($result_kades);

// --- Query 2: Ambil Sekretaris Desa ---
$sql_sekdes = "SELECT * FROM perangkat_desa WHERE jabatan = 'Sekretaris Desa' LIMIT 1";
$result_sekdes = mysqli_query($koneksi, $sql_sekdes);
if (!$result_sekdes) {
    die("Query Sekdes Gagal: " . mysqli_error($koneksi));
}
$sekdes = mysqli_fetch_assoc($result_sekdes);

// --- Query 3: Ambil semua KAUR (Kaur Umum, Kaur Keuangan, dll) ---
$sql_kaur = "SELECT * FROM perangkat_desa WHERE jabatan LIKE 'Kaur%' ORDER BY urutan ASC";
$result_kaur = mysqli_query($koneksi, $sql_kaur);
if (!$result_kaur) {
    die("Query Kaur Gagal: " . mysqli_error($koneksi));
}

// --- Query 4: Ambil semua KASI (Kasi Pemerintahan, dll) ---
$sql_kasi = "SELECT * FROM perangkat_desa WHERE jabatan LIKE 'Kasi%' ORDER BY urutan ASC";
$result_kasi = mysqli_query($koneksi, $sql_kasi);
if (!$result_kasi) {
    die("Query Kasi Gagal: " . mysqli_error($koneksi));
}

// --- Query 5: Ambil Staf ---
$sql_staf = "SELECT * FROM perangkat_desa WHERE jabatan LIKE 'Staf%' LIMIT 1";
$result_staf = mysqli_query($koneksi, $sql_staf);
if (!$result_staf) {
    die("Query Staf Gagal: " . mysqli_error($koneksi));
}
$staf = mysqli_fetch_assoc($result_staf);

// --- Query 6: Ambil semua KADUS (Kepala Dusun) ---
$sql_kadus = "SELECT * FROM perangkat_desa WHERE jabatan LIKE 'Kadus%' ORDER BY urutan ASC";
$result_kadus = mysqli_query($koneksi, $sql_kadus);
if (!$result_kadus) {
    die("Query Kadus Gagal: " . mysqli_error($koneksi));
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

    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="home.php" class="navbar-brand px-lg-4 m-0"></a> <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="home.php" class="nav-item nav-link nav-zoom">HOME</a> <a href="profilkepdes.php" class="nav-item nav-link nav-zoom">PROFIL KEPALA DESA</a>
                    <a href="struktur.php" class="nav-item nav-link active nav-zoom">STRUKTUR</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle nav-zoom" data-toggle="dropdown">INFORMASI DESA</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="datapenduduk.php" class="dropdown-item">Data Penduduk</a> <a href="datawilayah.php" class="dropdown-item">Data Wilayah</a> <a href="apbdesa.php" class="dropdown-item">APB Desa</a>
                        </div>
                    </div>
                    <a href="galeri.php" class="nav-item nav-link nav-zoom">GALERI DESA</a>
                    <a href="denah.php" class="nav-item nav-link nav-zoom">DENAH</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid page-header mb-5 position-relative overlay-bottom" style="background: url('img/kantorcopy.jpg') center center/cover no-repeat;">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px;">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">PEMERINTAH DESA TELUK NANGKA</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">STRUKTUR ORGANISASI DAN TATA KERJA</h4>
            <h1 class="display-4">PEMERINTAH DESA TELUK NANGKA</h1>
        </div>

        <?php if ($kades) : ?>
            <div class="text-center mb-5">
                <img src="img/<?php echo htmlspecialchars($kades['foto']); ?>" class="rounded-circle mb-3" width="100">
                <h4><strong><?php echo htmlspecialchars($kades['nama']); ?></strong></h4>
                <p><em><?php echo htmlspecialchars($kades['jabatan']); ?></em></p>
            </div>
        <?php endif; ?>

        <?php if ($sekdes) : ?>
            <div class="text-center mb-4">
                <img src="img/<?php echo htmlspecialchars($sekdes['foto']); ?>" class="rounded-circle mb-2" width="100">
                <h5><strong><?php echo htmlspecialchars($sekdes['nama']); ?></strong></h5>
                <p><em><?php echo htmlspecialchars($sekdes['jabatan']); ?></em></p>
            </div>
        <?php endif; ?>


        <div class="row text-center mb-4">
            <?php while ($kaur = mysqli_fetch_assoc($result_kaur)) : ?>
                <div class="col-md-4">
                    <img src="img/<?php echo htmlspecialchars($kaur['foto']); ?>" class="rounded-circle mb-2" width="100">
                    <h6><strong><?php echo htmlspecialchars($kaur['nama']); ?></strong></h6>
                    <p><em><?php echo htmlspecialchars($kaur['jabatan']); ?></em></p>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="row text-center mb-4">
            <?php while ($kasi = mysqli_fetch_assoc($result_kasi)) : ?>
                <div class="col-md-4">
                    <img src="img/<?php echo htmlspecialchars($kasi['foto']); ?>" class="rounded-circle mb-2" width="100">
                    <h6><strong><?php echo htmlspecialchars($kasi['nama']); ?></strong></h6>
                    <p><em><?php echo htmlspecialchars($kasi['jabatan']); ?></em></p>
                </div>
            <?php endwhile; ?>
        </div>

        <?php if ($staf) : ?>
            <div class="text-center mb-5"> <img src="img/<?php echo htmlspecialchars($staf['foto']); ?>" class="rounded-circle mb-2" width="100">
                <h6><strong><?php echo htmlspecialchars($staf['nama']); ?></strong></h6>
                <p><em><?php echo htmlspecialchars($staf['jabatan']); ?></em></p>
            </div>
        <?php endif; ?>

        <div class="row text-center justify-content-center">
            <?php while ($kadus = mysqli_fetch_assoc($result_kadus)) : ?>
                <div class="col-md-2">
                    <img src="img/<?php echo htmlspecialchars($kadus['foto']); ?>" class="rounded-circle mb-2" width="100">
                    <h6><strong><?php echo htmlspecialchars($kadus['nama']); ?></strong></h6>
                    <p><em><?php echo htmlspecialchars($kadus['jabatan']); ?></em></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">HUBUNGI</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Kec. Kubu, Kabupaten Kubu Raya, Kalimantan Barat</p>
                <p><i class="fa fa-phone-alt mr-2"></i>085348623988</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>desateluknangka@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">IKUTI KAMI</h4>
                <p>Dapatkan Informasi dan berita terbaru seputar Desa Teluk Nangka melalui media sosial kami</p>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.youtube.com/@teluknangka" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.facebook.com/NamaAkun" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="https://www.instagram.com/desateluknangka" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Jam Operasional</h4>
                <div>
                    <h6 class="text-white text-uppercase">Senin - Jumat</h6>
                    <p>08.00 WIB - 12.00 WIB</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">KABAR DESA</h4>
                <p>Tetap terhubung dengan informasi terbaru dari Desa Teluk Nangka.
                    Dapatkan kabar kegiatan, pengumuman penting, dan layanan masyarakat langsung ke email Anda.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;"
                            placeholder="Email Anda">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-3">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5"
            style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">WEBSITE DESA TELUK NANGKA</p>
            <p class="m-0 text-white" style="font-size: 0.9rem;">
                Design by KKM 2025 Universitas PGRI Pontianak
            </p>
            <p class="m-0 text-white" style="font-size: 0.9rem;">
                Developed & Maintained by Politeknik Negeri Pontianak
            </p>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <script src="js/main.js"></script>
</body>

</html>
Compare this snippet from struktur.php: