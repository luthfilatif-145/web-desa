<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI
include("../db_config.php"); 

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$sukses = "";
$error = ""; 
$katakunci = isset($_GET['katakunci']) ? $_GET['katakunci'] : "";

// 2. LOGIKA HAPUS DATA
if (isset($_GET['op']) && $_GET['op'] == 'hapus') {
    $id = $_GET['id'];
    
    // Ambil nama file foto dulu sebelum dihapus
    $sql_foto = "SELECT foto FROM perangkat_desa WHERE id = '$id'";
    $q_foto = mysqli_query($koneksi, $sql_foto);
    $r_foto = mysqli_fetch_assoc($q_foto);
    if ($r_foto['foto'] && file_exists("../img/" . $r_foto['foto'])) {
        unlink("../img/" . $r_foto['foto']); // Hapus file foto dari folder img/
    }
    
    // Hapus data dari database
    $sql_delete = "DELETE FROM perangkat_desa WHERE id = '$id'";
    $q_delete = mysqli_query($koneksi, $sql_delete);
    
    if ($q_delete) {
        $sukses = "Data perangkat desa berhasil dihapus.";
    } else {
        $error = "Gagal menghapus data.";
    }
}
?>

<?php 
// 3. PANGGIL HEADER ADMINLTE
include("inc_header.php"); 
?>

<div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kelola Struktur Desa</h1> </div>
        </div></div></div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-body">
                
                <?php if ($sukses) { ?>
                    <div class="alert alert-primary" role="alert"><?php echo $sukses ?></div>
                <?php } ?>
                <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
                <?php } ?>
                
                <p>
                    <a href="kelola_struktur_input.php">
                        <input type="button" class="btn btn-primary" value="Tambah Perangkat Desa" />
                    </a>
                </p>
                <form class="row g-3 mb-3" method="get">
                    <div class="col-auto">
                        <input type="text" class="form-control" placeholder="Cari Nama atau Jabatan..." name="katakunci" value="<?php echo $katakunci ?>" />
                    </div>
                    <div class="col-auto">
                        <input type="submit" name="Cari" value="Cari" class="btn btn-secondary" />
                    </div>
                </form>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-2">Nama</th>
                            <th class="col-2">Jabatan</th>
                            <th class="col-1">Kategori</th>
                            <th class="col-1">Foto</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Logika Pencarian & Pagination
                        $sqltambahan = "";
                        $per_halaman = 10; // Tampilkan 10 data per halaman
                        if ($katakunci != '') {
                            $array_katakunci = explode(" ", $katakunci);
                            $sqlcari = [];
                            for ($x = 0; $x < count($array_katakunci); $x++) {
                                // Sesuaikan pencarian dengan kolom 'nama' dan 'jabatan'
                                $sqlcari[] = "(nama like '%" . $array_katakunci[$x] . "%' or jabatan like '%" . $array_katakunci[$x] . "%')";
                            }
                            $sqltambahan = " WHERE " . implode(" OR ", $sqlcari);
                        }
                        
                        $sql1 = "SELECT * FROM perangkat_desa $sqltambahan";
                        $q_total = mysqli_query($koneksi, $sql1);
                        if (!$q_total) { die("Query total gagal: " . mysqli_error($koneksi)); }
                        $total = mysqli_num_rows($q_total);
                        
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
                        $pages = ceil($total / $per_halaman);
                        $Nomor = $mulai + 1; 

                        // Query final dengan urutan dan limit
                        $sql_final = $sql1 . " ORDER BY urutan ASC, id ASC LIMIT $mulai, $per_halaman";
                        $q_final = mysqli_query($koneksi, $sql_final);

                        while ($r1 = mysqli_fetch_array($q_final)) {
                        ?>
                            <tr>
                                <td><?php echo $Nomor++ ?></td>
                                <td><?php echo $r1['nama'] ?></td>
                                <td><?php echo $r1['jabatan'] ?></td>
                                <td><?php echo $r1['kategori'] ?></td>
                                <td><img src="../img/<?php echo $r1['foto'] ?>" style="max-width: 50px; height: auto;" class="img-thumbnail"></td>
                                <td>
                                    <a href="kelola_struktur_input.php?id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="kelola_struktur.php?op=hapus&id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data <?php echo $r1['nama']; ?>?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        } 
                        ?>
                    </tbody>
                </table>
                
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        $cari = isset($_GET['cari']) ? $_GET['cari'] : "";
                        for ($i = 1; $i <= $pages; $i++) {
                        ?>
                            <?php $activeClass = ($i == $page) ? 'active' : ''; ?>
                            <li class="page-item <?php echo $activeClass ?>">
                                <a class="page-link" href="kelola_struktur.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>">
                                    <?php echo $i ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>

              </div> </div> </div> </div> </div></section>
    </div>
  <?php 
// 5. PANGGIL FOOTER ADMINLTE
include("inc_footer.php"); 
?>