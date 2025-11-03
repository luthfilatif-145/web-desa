<?php
// connect database
include 'db_config.php'; // Ini menyediakan $koneksi

// 1. MENGAMBIL DATA DARI TABEL 'data_penduduk'
$sql = "SELECT * FROM data_penduduk ORDER BY id ASC";

// Eksekusi query
$result = mysqli_query($koneksi, $sql);

// Cek apakah query-nya berhasil
if (!$result) {
    // Jika gagal, hentikan skrip dan tampilkan pesan error dari MySQL
    die("Query Gagal dijalankan: " . mysqli_error($koneksi));
}
// Kita tidak perlu mysqli_fetch_assoc di sini, karena kita akan looping di bawah
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
        <a href="home.php" class="navbar-brand px-lg-4 m-0"> </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="home.php" class="nav-item nav-link nav-zoom">HOME</a> <a href="profilkepdes.php" class="nav-item nav-link nav-zoom">PROFIL KEPALA DESA</a>
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
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">DATA PENDUDUK</h1>
            <div class="d-inline-flex mb-lg-5">
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Data lengkap</h4>
                <h1 class="display-4">KEPENDUDUKAN DESA TELUK NANGKA</h1>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Uraian</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            $no = 1; // Variabel untuk nomor urut
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $no; ?></th>
                                <td><?php echo htmlspecialchars($row['uraian_statistik']); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                                <td><?php echo htmlspecialchars($row['satuan']); ?></td>
                            </tr>

                            <?php
                                $no++; // Tambahkan nomor urut
                            }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
                    
        </div>
    </div>
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">HUBUNGI</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Kec. Kubu, Kabupaten Kubu Raya, Kalimantan Barat</p>
                <p><i class="fa fa-phone-alt mr-2"></i>08534862388</p>
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