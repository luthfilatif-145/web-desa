<?php
// connect database
include 'db_config.php'; // Ini menyediakan $koneksi

// 1. AMBIL SEMUA DATA APBDES
// Urutkan berdasarkan kode_akun agar strukturnya benar
$sql = "SELECT * FROM apbdes_rincian ORDER BY kode_akun ASC";
$result = mysqli_query($koneksi, $sql);

// Cek apakah query berhasil
if (!$result) {
    die("Query APBDes Gagal: " . mysqli_error($koneksi));
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="home.php" class="navbar-brand px-lg-4 m-0">
                <!-- LOGO ANDA -->
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
                        <a href="#" class="nav-link dropdown-toggle nav-zoom active" id="informasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">APB DESA</h1>
            <div class="d-inline-flex mb-lg-5">
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- APBDes Table Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">LAPORAN APB DESA</h4>
                <h1 class="display-4">TRANSPARANSI ANGGARAN DAN BELANJA DESA TELUK NANGKA</h1>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mt-5 mb-4">Rincian APBDes</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Uraian</th>
                                <th scope="col">Anggaran (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // 2. MULAI LOOPING UNTUK SETIAP BARIS DATA
                            while ($row = mysqli_fetch_assoc($result)) {
                                
                                // 3. CEK APAKAH BARIS INI ADALAH TOTAL (is_total = 1)?
                                // Jika ya, tambahkan kelas 'font-weight-bold'
                                $rowClass = ($row['is_total'] == 1) ? 'font-weight-bold' : ''; 
                            ?>
                            
                            <!-- 4. CETAK BARIS TABEL (<tr>) DENGAN KELAS YANG SESUAI -->
                            <tr class="<?php echo $rowClass; ?>">
                                <td><?php echo htmlspecialchars($row['kode_akun']); ?></td>
                                <td><?php echo htmlspecialchars($row['uraian']); ?></td>
                                
                                <!-- 5. FORMAT ANGKA MENJADI RUPIAH -->
                                <td>Rp <?php echo number_format($row['anggaran_rp'], 2, ',', '.'); ?></td>
                            </tr>

                            <?php
                            } // 6. AKHIR DARI LOOPING WHILE
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>
    <!-- APBDes Table End -->

    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
       <!-- ... (Isi Footer Anda) ... -->
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>