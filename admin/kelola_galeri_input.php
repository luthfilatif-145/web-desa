<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI
include("../db_config.php");


// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// Inisialisasi variabel untuk form
$judul = "";
$tanggal = "";
$deskripsi = "";
$layout_style = "setengah"; // Default value
$gambar_lama = ""; // Untuk menyimpan nama file foto saat mode edit

// 2. LOGIKA MODE EDIT (Ambil data jika ada ID)
// =================================================
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") { // Jika ID ada (mode Edit)
    $sql_get = "SELECT * FROM galeri_desa WHERE id = '$id'";
    $q_get = mysqli_query($koneksi, $sql_get);
    $data = mysqli_fetch_assoc($q_get);
    if ($data) {
        $judul = $data['judul'];
        $tanggal = $data['tanggal'];
        $deskripsi = $data['deskripsi'];
        $layout_style = $data['layout_style'];
        $gambar_lama = $data['gambar']; // Simpan nama foto yang ada
    } else {
        $error = "Data tidak ditemukan.";
    }
}

// 3. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
// =================================================
if (isset($_POST['simpan'])) {
    // Ambil semua data dari form
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $layout_style = $_POST['layout_style'];
    $gambar_lama = $_POST['gambar_lama'];

    // Validasi dasar
    if ($judul == '' || $tanggal == '') {
        $error = "Kolom Wajib (Judul dan Tanggal) tidak boleh kosong.";
    }

    // Logika untuk FOTO
    $nama_gambar_final = $gambar_lama; // Defaultnya pakai foto lama
    if (empty($error)) {
        // Cek apakah admin mengupload foto BARU?
        if (!empty($_FILES['gambar']['name'])) {
            $nama_file_baru = $_FILES['gambar']['name'];
            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $target_direktori = "../img/" . $nama_file_baru;

            if (move_uploaded_file($lokasi_file, $target_direktori)) {
                $nama_gambar_final = $nama_file_baru; // Gunakan nama foto baru
                // Hapus foto lama jika berhasil upload foto baru (HANYA JIKA BUKAN FOTO DEFAULT)
                if ($foto_lama != "" && $foto_lama != "default.png" && file_exists("../img/" . $foto_lama)) {
                    unlink("../img/" . $foto_lama);
                }
            } else {
                $error = "Gagal mengupload foto.";
            }
        } elseif ($id == "") { // Jika ini mode TAMBAH BARU dan tidak ada foto
            $error = "Anda harus memilih foto untuk diupload.";
        }
    }

    // Jika tidak ada error, lanjutkan simpan ke DB
    if (empty($error)) {
        if ($id == "") { // Mode CREATE (Tambah Baru)
            $sql_insert = "INSERT INTO galeri_desa (judul, tanggal, deskripsi, gambar, layout_style) 
                           VALUES ('$judul', '$tanggal', '$deskripsi', '$nama_gambar_final', '$layout_style')";
            $q_insert = mysqli_query($koneksi, $sql_insert);
            if ($q_insert) {
                $sukses = "Foto baru berhasil diupload.";
            } else {
                $error = "Gagal menambahkan data: " . mysqli_error($koneksi);
            }
        } else { // Mode UPDATE (Edit)
            $sql_update = "UPDATE galeri_desa SET 
                            judul = '$judul', 
                            tanggal = '$tanggal', 
                            deskripsi = '$deskripsi', 
                            gambar = '$nama_gambar_final', 
                            layout_style = '$layout_style' 
                          WHERE id = '$id'";
            $q_update = mysqli_query($koneksi, $sql_update);
            if ($q_update) {
                $sukses = "Data galeri berhasil diperbarui.";
            } else {
                $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        }
    }
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
                    <h1 class="m-0"><?php echo ($id) ? 'Edit' : 'Upload'; ?> Foto Galeri</h1>
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
                                <a href="kelola_galeri.php" class="btn btn-sm btn-secondary">
                                    &lt;&lt; kembali ke Daftar Galeri
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
                                    <meta http-equiv="refresh" content="2;url=kelola_galeri.php">
                                </div>
                            <?php } ?>

                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="mb-3 row">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul Foto*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" value="<?php echo $judul; ?>" name="judul">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Kegiatan*</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal" value="<?php echo $tanggal; ?>" name="tanggal">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="gambar" class="col-sm-2 col-form-label">Upload Foto*</label>
                                    <div class="col-sm-10">
                                        <?php if ($gambar_lama) { // Tampilkan foto lama jika mode Edit 
                                        ?>
                                            <p>
                                                <img src="../img/<?php echo $gambar_lama; ?>" style="max-width: 200px; height: auto;" class="img-thumbnail">
                                            </p>
                                        <?php } ?>
                                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                                        <input type="hidden" name="gambar_lama" value="<?php echo $gambar_lama; ?>">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto (saat mode edit).</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="layout_style" class="col-sm-2 col-form-label">Layout Tampilan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="layout_style" id="layout_style">
                                            <option value="setengah" <?php if ($layout_style == 'setengah') echo 'selected'; ?>>2 Kolom (Standar)</option>
                                            <option value="penuh" <?php if ($layout_style == 'penuh') echo 'selected'; ?>>1 Kolom Penuh (Foto + Judul)</option>
                                            <option value="penuh_deskripsi" <?php if ($layout_style == 'penuh_deskripsi') echo 'selected'; ?>>1 Kolom Penuh (Foto + Judul + Deskripsi)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi (Opsional)</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="deskripsi" rows="4"><?php echo $deskripsi; ?></textarea>
                                        <small class="form-text text-muted">Hanya akan tampil jika Anda memilih layout "1 Kolom Penuh (Foto + Judul + Deskripsi)".</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Foto" />
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