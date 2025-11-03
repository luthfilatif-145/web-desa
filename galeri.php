<?php
// 1. SAMBUNGKAN KE DATABASE
include 'db_config.php'; // Ini menyediakan $koneksi

// 2. Query: Ambil semua data galeri, urutkan dari yg terbaru
$sql_galeri = "SELECT * FROM galeri_desa ORDER BY id DESC";
$result_galeri = mysqli_query($koneksi, $sql_galeri);
if (!$result_galeri) {
    die("Query Galeri Gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Galeri Desa - Desa Teluk Nangka</title>
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet">

    <style>
        .gallery-item {
            margin-bottom: 30px;
            /* Kasih jarak antar foto */
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            /* Samakan tinggi gambar */
            object-fit: cover;
            /* Biar gambarnya pas, nggak gepeng */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .gallery-item-full img {
            height: auto;
            /* Untuk gambar yg 1 kolom, tingginya otomatis */
            max-height: 500px;
        }

        .gallery-item .card-body {
            padding: 20px;
            background: #fdfdfd;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="home.php" class="navbar-brand px-lg-4 m-0">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="home.php" class="nav-item nav-link nav-zoom">HOME</a>
                    <a href="profilkepdes.php" class="nav-item nav-link nav-zoom">PROFIL KEPALA DESA</a>
                    <a href="struktur.php" class="nav-item nav-link nav-zoom">STRUKTUR</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle nav-zoom" data-toggle="dropdown">INFORMASI DESA</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="datapenduduk.php" class="dropdown-item">Data Penduduk</a>
                            <a href="datawilayah.php" class="dropdown-item">Data Wilayah</a>
                            <a href="apbdesa.php" class="dropdown-item">APB Desa</a>
                        </div>
                    </div>
                    <a href="galeri.php" class="nav-item nav-link active nav-zoom">GALERI DESA</a> <a href="denah.php" class="nav-item nav-link nav-zoom">DENAH</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">GALERI DESA</h1>
        </div>
    </div>
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Jejak Visual Desa</h4>
                <h1 class="display-4">Dokumentasi Kegiatan Masyarakat</h1>
            </div>

            <div class="row text-center">

                <?php
                // MULAI LOOPING
                while ($row = mysqli_fetch_assoc($result_galeri)) :

                    // Cek layout_style dari database (yang sudah kita buat di admin)
                    $layout_style = $row['layout_style'];
                ?>

                    <?php
                    // =========================================================
                    // KASUS 1: Layout 'penuh' atau 'penuh_deskripsi' (1 Kolom Penuh)
                    // =========================================================
                    if ($layout_style == 'penuh' || $layout_style == 'penuh_deskripsi') :
                    ?>
                        <div class="col-12 gallery-item gallery-item-full">
                            <img src="img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>">
                            <div class="card-body">
                                <h3 class="text-dark fw-bold"><?php echo htmlspecialchars($row['judul']); ?></h3>
                                <p class="text-muted"><?php echo htmlspecialchars($row['tanggal']); ?></p>

                                <?php if ($layout_style == 'penuh_deskripsi' && !empty($row['deskripsi'])) : ?>
                                    <p class="text-muted mx-auto" style="max-width: 800px;"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php
                    // KASUS 2: Layout 'setengah' (2 Kolom)
                    else :
                    ?>
                        <div class="col-lg-6 gallery-item"> <img src="img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>">
                            <div class="card-body">
                                <h5 class="text-dark fw-bold"><?php echo htmlspecialchars($row['judul']); ?></h5>
                                <p class="text-muted small"><?php echo htmlspecialchars($row['tanggal']); ?></p>

                                <?php if (!empty($row['deskripsi'])) : ?>
                                    <p class="text-muted"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endif; // Akhir dari if
                    ?>

                <?php
                // AKHIR LOOPING
                endwhile;
                ?>

            </div>
        </div>
    </div>
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
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