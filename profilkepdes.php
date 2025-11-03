<?php
// 1. SAMBUNGKAN KE DATABASE
include 'db_config.php'; // Ini menyediakan $koneksi

// 2. BUAT QUERY UNTUK AMBIL DATA KEPALA DESA
// Kita asumsikan hanya ada 1 data kepala desa yang aktif, jadi kita pakai LIMIT 1
$sql_kades = "SELECT * FROM kepala_desa LIMIT 1";
$result_kades = mysqli_query($koneksi, $sql_kades);

// Cek apakah query berhasil
if (!$result_kades) {
    die("Query Kepala Desa Gagal: " . mysqli_error($koneksi));
}

// 3. AMBIL DATA DAN SIMPAN DI VARIABEL
// Sekarang semua data ada di dalam $data_kades
$data_kades = mysqli_fetch_assoc($result_kades);
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
            <a href="home.php" class="navbar-brand px-lg-4 m-0">
                </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="home.php" class="nav-item nav-link nav-zoom">HOME</a>
                    <a href="profilkepdes.php" class="nav-item nav-link active nav-zoom">PROFIL KEPALA DESA</a>
                    <a href="struktur.php" class="nav-item nav-link nav-zoom">STRUKTUR</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle nav-zoom" data-toggle="dropdown">INFORMASI DESA</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="datapenduduk.php" class="dropdown-item">Data Penduduk</a>
                            <a href="datawilayah.php" class="dropdown-item">Data Wilayah</a>
                            <a href="apbdesa.php" class="dropdown-item">APB Desa</a>
                        </div>
                    </div>
                    <a href="galeri.php" class="nav-item nav-link nav-zoom">GALERI DESA</a>
                    <a href="denah.php" class="nav-item nav-link nav-zoom">DENAH</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">PROFIL KEPALA DESA</h1>
            <div class="d-inline-flex mb-lg-5">
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang</h4>
                <h1 class="display-4">KEPALA DESA</h1>
            </div>
            
            <div class="row align-items-center">
                
                <div class="col-lg-4 col-md-5 mb-4 mb-lg-0">
                    <div class="position-relative h-100">
                        <img class="img-fluid w-100 h-100" src="img/<?php echo $data_kades['foto']; ?>" style="object-fit: cover; border-radius: 8px;">
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    
                    <h1 class="mb-3"><?php echo $data_kades['nama']; ?></h1>
                    
                    <h5 class="mb-3">Kepala Desa <?php echo $data_kades['tempat_asal']; ?></h5>
                    
                    <p><b>Masa Jabatan:</b> <?php echo $data_kades['periode']; ?></p>
                    <hr> 
                    
                    <p><?php echo nl2br($data_kades['deskripsi']); ?></p>
                    
                    <div><?php echo $data_kades['program_utama']; ?></div>

                    <p class="mt-3"><?php echo nl2br($data_kades['tambahan']); ?></p>
                </div>

            </div> </div>
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