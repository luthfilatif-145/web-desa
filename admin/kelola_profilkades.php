<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI

include("../db_config.php"); 

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// 2. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $tempat_asal = $_POST['tempat_asal'];
    $periode = $_POST['periode'];
    $deskripsi = $_POST['deskripsi'];
    $program_utama = $_POST['program_utama'];
    $tambahan = $_POST['tambahan'];
    $foto_lama = $_POST['foto_lama']; 

    if (!empty($_FILES['foto']['name'])) {
        $nama_foto_baru = $_FILES['foto']['name'];
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $target_direktori = "../img/" . $nama_foto_baru; 
        move_uploaded_file($lokasi_file, $target_direktori);
        $nama_foto_final = $nama_foto_baru;
    } else {
        $nama_foto_final = $foto_lama;
    }

    $sql_update = "UPDATE kepala_desa SET 
                    nama = '$nama', 
                    tempat_asal = '$tempat_asal', 
                    periode = '$periode', 
                    foto = '$nama_foto_final', 
                    deskripsi = '$deskripsi', 
                    program_utama = '$program_utama', 
                    tambahan = '$tambahan' 
                  WHERE id = 1"; 

    $q_update = mysqli_query($koneksi, $sql_update);
    if ($q_update) {
        $sukses = "Data Profil Kepala Desa berhasil diperbarui.";
    } else {
        $error = "Data gagal diperbarui: " . mysqli_error($koneksi);
    }
}

// 3. LOGIKA UNTUK MENGAMBIL DATA (GET)
$sql_select = "SELECT * FROM kepala_desa WHERE id = 1";
$q_select = mysqli_query($koneksi, $sql_select);
$data = mysqli_fetch_assoc($q_select);
?>

<?php 
// 4. PANGGIL HEADER ADMINLTE
include("inc_header.php"); 
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Profil Kepala Desa</h1>
                </div>
            </div></div></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    
                    <div class="card">
                        <div class="card-body">
                            
                            <p>
                                <a href="halaman.php" class="btn btn-sm btn-secondary">
                                    &lt;&lt; kembali ke halaman Admin
                                </a>
                            </p>

                            <?php if ($error) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>
                            <?php if ($sukses) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $sukses; ?>
                                </div>
                            <?php } ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" value="<?php echo $data['nama']; ?>" name="nama">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tempat_asal" class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tempat_asal" value="<?php echo $data['tempat_asal']; ?>" name="tempat_asal">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="periode" value="<?php echo $data['periode']; ?>" name="periode">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <p>
                                            <img src="../img/<?php echo $data['foto']; ?>" style="max-width: 150px; height: auto;" class="img-thumbnail">
                                        </p>
                                        <input type="file" class="form-control-file" id="foto" name="foto">
                                        <input type="hidden" name="foto_lama" value="<?php echo $data['foto']; ?>">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">    
                                        <textarea class="form-control summernote" name="deskripsi"><?php echo $data['deskripsi']; ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="program_utama" class="col-sm-2 col-form-label">Program Utama</label>
                                    <div class="col-sm-10">    
                                        <textarea class="form-control summernote" name="program_utama"><?php echo $data['program_utama']; ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tambahan" class="col-sm-2 col-form-label">Tambahan</label>
                                    <div class="col-sm-10">    
                                        <textarea class="form-control summernote" name="tambahan"><?php echo $data['tambahan']; ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Perubahan"/>
                                    </div>
                                </div>
                            </form>

                        </div> </div> </div> </div> </div></section>
    </div>
<?php 
// 5. PANGGIL FOOTER ADMINLTE
include("inc_footer.php"); 
?>