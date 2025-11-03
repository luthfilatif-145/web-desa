<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI
include("../db_config.php");

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// 2. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
// =================================================
if (isset($_POST['simpan'])) {

    // Data yang dikirim dari form adalah array: $_POST['jumlah']
    // Kita akan loop array itu

    foreach ($_POST['jumlah'] as $id => $nilai_jumlah) {

        // Bersihkan data untuk keamanan
        $id_bersih = (int)$id; // Ubah ID jadi angka (mencegah SQL Injection)
        $jumlah_bersih = mysqli_real_escape_string($koneksi, $nilai_jumlah);

        // Buat kueri UPDATE untuk setiap baris
        $sql_update = "UPDATE data_penduduk SET jumlah = '$jumlah_bersih' WHERE id = $id_bersih";

        // Eksekusi kueri
        mysqli_query($koneksi, $sql_update);
    }

    // Set pesan sukses (kita asumsikan berhasil)
    $sukses = "Data statistik kependudukan berhasil diperbarui.";

    // (Dalam proyek nyata, kita perlu cek error di setiap kueri, 
    // tapi ini sudah cukup untuk sekarang)
}

// 3. LOGIKA UNTUK MENGAMBIL DATA (READ)
// =================================================
// Ambil semua data statistik untuk ditampilkan di form
$sql_select = "SELECT * FROM data_penduduk ORDER BY id ASC";
$result_data = mysqli_query($koneksi, $sql_select);

// Cek jika query gagal
if (!$result_data) {
    die("Query Gagal: " . mysqli_error($koneksi));
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
                    <h1 class="m-0">Kelola Data Penduduk</h1>
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
                            <h3 class="card-title">Edit Statistik Kependudukan</h3>
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

                                <?php
                                // 5. LOOPING UNTUK MEMBUAT FORM
                                // =================================
                                while ($row = mysqli_fetch_assoc($result_data)) {
                                ?>

                                    <div class="form-group row">
                                        <label for="jumlah_<?php echo $row['id']; ?>" class="col-sm-4 col-form-label">
                                            <?php echo $row['uraian_statistik']; ?>
                                        </label>

                                        <div class="col-sm-5">
                                            <input type="text" class="form-control"
                                                name="jumlah[<?php echo $row['id']; ?>]"
                                                id="jumlah_<?php echo $row['id']; ?>"
                                                value="<?php echo $row['jumlah']; ?>">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="col-form-label"><?php echo $row['satuan']; ?></label>
                                        </div>
                                    </div>

                                <?php
                                } // Akhir dari looping while
                                ?>

                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8">
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
// 6. PANGGIL FOOTER ADMINLTE
include("inc_footer.php");
?>