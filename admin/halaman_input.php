<?php
// 1. LOGIKA PHP ANDA (Sudah Bagus)
// =================================
include("../db_config.php");


$judul = "";
$kutipan = "";
$isi = "";
$error = "";
$sukses = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

// Logika untuk Mode EDIT (jika ada ID)
if (!empty($id)) {
    $sql1 = "select * from halaman where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);

    if ($r1) {
        $judul = $r1['judul'];
        $kutipan = $r1['kutipan'];
        $isi = $r1['isi'];
    } else {
        $error = "Data dengan ID tersebut tidak ditemukan";
    }
}

// Logika untuk Tombol SIMPAN (Create atau Update)
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $kutipan = $_POST['kutipan'];
    $isi = $_POST['isi'];

    if ($judul == '' or $kutipan == '' or $isi == '') {
        $error = "Silahkan masukkan semua data yakni judul, kutipan, dan isi";
    }

    if (empty($error)) {
        if ($id != '') { // Jika ada ID, lakukan UPDATE
            $sql1 = "update halaman set judul = '$judul', kutipan = '$kutipan', isi = '$isi', tgl_isi=now() where id = '$id'";
        } else { // Jika tidak ada ID, lakukan INSERT
            $sql1 = "insert into halaman (judul, kutipan, isi) values ('$judul', '$kutipan', '$isi')";
        }

        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Data berhasil disimpan";
        } else {
            $error = "Data gagal disimpan";
        }
    }
}
?>

<?php
// 2. PANGGIL HEADER ADMINLTE
// =================================
include("inc_header.php");
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo ($id) ? 'Edit' : 'Buat'; ?> Halaman</h1>
                </div>
            </div>
        </div>
    </div>
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
                                    <?php echo $error ?>
                                </div>
                            <?php } ?>
                            <?php if ($sukses) { ?>
                                <div class="alert alert-primary" role="alert">
                                    <?php echo $sukses ?>
                                </div>
                            <?php } ?>

                            <form action="" method="post">
                                <div class="mb-3 row">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" value="<?php echo $judul ?>" name="judul">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kutipan" value="<?php echo $kutipan ?>" name="kutipan">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="isi" id="summernote"><?php echo $isi ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data" />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
// 4. PANGGIL FOOTER ADMINLTE
// =================================
include("inc_footer.php");
?>