<?php
// 1. PANGGIL HEADER (UDAH TERMASUK KONEKSI DB)
include("inc_header.php"); 

// --- KOTAK 1: Hitung Jumlah Perangkat Desa ---
$sql_perangkat = "SELECT count(id) AS total FROM perangkat_desa";
$q_perangkat = mysqli_query($koneksi, $sql_perangkat);
$r_perangkat = mysqli_fetch_assoc($q_perangkat);
$total_perangkat = $r_perangkat['total'];

// --- KOTAK 2: Hitung Jumlah Foto Galeri ---
$sql_galeri = "SELECT count(id) AS total FROM galeri_desa";
$q_galeri = mysqli_query($koneksi, $sql_galeri);
$r_galeri = mysqli_fetch_assoc($q_galeri);
$total_galeri = $r_galeri['total'];

// --- KOTAK 3: Ambil Jumlah Penduduk ---
// (Asumsi 'Jumlah Penduduk' ada di baris dengan uraian 'Jumlah Penduduk')
$sql_penduduk = "SELECT jumlah FROM data_penduduk WHERE uraian_statistik = 'Jumlah Penduduk' LIMIT 1";
$q_penduduk = mysqli_query($koneksi, $sql_penduduk);
$r_penduduk = mysqli_fetch_assoc($q_penduduk);
$total_penduduk = $r_penduduk ? $r_penduduk['jumlah'] : 0; // Kasih 0 kalo datanya nggak ketemu

// --- KOTAK 4: Hitung Total Anggaran BELANJA ---
$sql_belanja = "SELECT SUM(anggaran_rp) AS total FROM apbdes_rincian WHERE tipe = 'BELANJA' AND is_total = 0";
$q_belanja = mysqli_query($koneksi, $sql_belanja);
$r_belanja = mysqli_fetch_assoc($q_belanja);
$total_belanja = $r_belanja['total'];

?>

<div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1> </div>
        </div></div></div>
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $total_perangkat; ?></h3>
                <p>Jumlah Perangkat Desa</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="kelola_struktur.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $total_galeri; ?></h3>
                <p>Total Foto Galeri</p>
              </div>
              <div class="icon">
                <i class="fas fa-images"></i>
              </div>
              <a href="kelola_galeri.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_penduduk; ?></h3>
                <p>Jumlah Penduduk</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="kelola_penduduk.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></h3>
                <p>Total Anggaran Belanja</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a href="kelola_apbdesa.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Selamat Datang di Dashboard Admin</h4>
                        <p>Pilih menu di sidebar kiri untuk mulai mengelola konten website.</p>
                    </div>
                </div>
            </div>
        </div>

      </div></section>
    </div>
  <?php 
// 4. PANGGIL FOOTER ADMINLTE
include("inc_footer.php"); 
?>