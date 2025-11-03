<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI
include("../db_config.php");

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// 2. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
// =================================================
if (isset($_POST['simpan'])) {

    // Data dikirim sebagai array: $_POST['nilai']
    if (isset($_POST['nilai']) && is_array($_POST['nilai'])) {
        foreach ($_POST['nilai'] as $id => $nilai_baru) {

            // Bersihkan data untuk keamanan
            $id_bersih = (int)$id; // Ubah ID jadi angka
            $nilai_bersih = mysqli_real_escape_string($koneksi, $nilai_baru);

            // Buat kueri UPDATE untuk setiap baris
            $sql_update = "UPDATE data_wilayah SET nilai = '$nilai_bersih' WHERE id = $id_bersih";

            // Eksekusi kueri
            mysqli_query($koneksi, $sql_update);
        }
        $sukses = "Data wilayah berhasil diperbarui.";
    } else {
        $error = "Tidak ada data yang dikirim untuk disimpan.";
    }
}

// 3. LOGIKA UNTUK MENGAMBIL DATA (READ)
// =================================================
// Ambil data BATAS Wilayah
$sql_batas = "SELECT * FROM data_wilayah WHERE tipe_info = 'BATAS' ORDER BY urutan ASC";
$result_batas = mysqli_query($koneksi, $sql_batas);
if (!$result_batas) {
    die("Query Batas Gagal: " . mysqli_error($koneksi));
}

// Ambil data LUAS Wilayah
$sql_luas = "SELECT * FROM data_wilayah WHERE tipe_info = 'LUAS' ORDER BY urutan ASC";
$result_luas = mysqli_query($koneksi, $sql_luas);
if (!$result_luas) {
    die("Query Luas Gagal: " . mysqli_error($koneksi));
}

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
                    <h1 class="m-0">Kelola Data Wilayah</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Batas dan Luas Wilayah</h3>
                        </div>

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
                                <div class="alert alert-success" role="alert">
                                    <?php echo $sukses ?>
                                </div>
                            <?php } ?>

                            <form action="" method="post">

                                <h4>Batas Wilayah</h4>
                                <hr>
                                <?php
                                while ($row_batas = mysqli_fetch_assoc($result_batas)) {
                                ?>
                                    <div class="form-group row">
                                        <label for="nilai_<?php echo $row_batas['id']; ?>" class="col-sm-3 col-form-label">
                                            <?php echo $row_batas['uraian_wilayah']; ?>
                                        </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                name="nilai[<?php echo $row_batas['id']; ?>]"
                                                id="nilai_<?php echo $row_batas['id']; ?>"
                                                value="<?php echo $row_batas['nilai']; ?>">
                                        </div>
                                    </div>
                                <?php
                                } // Akhir loop batas
                                ?>

                                <h4 class="mt-5">Luas Wilayah</h4>
                                <hr>
                                <?php
                                while ($row_luas = mysqli_fetch_assoc($result_luas)) {
                                ?>
                                    <div class="form-group row">
                                        <label for="nilai_<?php echo $row_luas['id']; ?>" class="col-sm-3 col-form-label">
                                            <?php echo $row_luas['uraian_wilayah']; ?>
                                        </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                name="nilai[<?php echo $row_luas['id']; ?>]"
                                                id="nilai_<?php echo $row_luas['id']; ?>"
                                                value="<?php echo $row_luas['nilai']; ?>">
                                        </div>
                                    </div>
                                <?php
                                } // Akhir loop luas
                                ?>

                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Perubahan" />
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
// 5. PANGGIL FOOTER ADMINLTE
include("inc_footer.php");
?>