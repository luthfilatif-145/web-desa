<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI

include("../db_config.php");

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// Inisialisasi variabel untuk form
$nama = "";
$nip = "";
$jabatan = "";
$urutan = "";
$kategori = "";
$foto_lama = ""; // Untuk menyimpan nama foto saat mode edit

// 2. LOGIKA MODE EDIT (Ambil data jika ada ID)
// =================================================
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") { // Jika ID ada (mode Edit)
    $sql_get = "SELECT * FROM perangkat_desa WHERE id = '$id'";
    $q_get = mysqli_query($koneksi, $sql_get);
    $data = mysqli_fetch_assoc($q_get);
    if ($data) {
        $nama = $data['nama'];
        $nip = $data['nip'];
        $jabatan = $data['jabatan'];
        $urutan = $data['urutan'];
        $kategori = $data['kategori'];
        $foto_lama = $data['foto']; // Simpan nama foto yang ada
    } else {
        $error = "Data tidak ditemukan.";
    }
}

// 3. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
// =================================================
if (isset($_POST['simpan'])) {
    // Ambil semua data dari form
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $urutan = $_POST['urutan'];
    $kategori = $_POST['kategori'];
    $foto_lama = $_POST['foto_lama'];

    // Validasi dasar
    if ($nama == '' || $jabatan == '' || $kategori == '') {
        $error = "Kolom Wajib (Nama, Jabatan, Kategori) tidak boleh kosong.";
    }

    // Logika untuk FOTO
    if (empty($error)) {
        // Cek apakah admin mengupload foto BARU?
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto_baru = $_FILES['foto']['name'];
            $lokasi_file = $_FILES['foto']['tmp_name'];
            $target_direktori = "../img/" . $nama_foto_baru; // Path untuk menyimpan foto

            // Pindahkan file yang diupload ke folder img/
            if (move_uploaded_file($lokasi_file, $target_direktori)) {
                $nama_foto_final = $nama_foto_baru; // Gunakan nama foto baru
                // Hapus foto lama jika berhasil upload foto baru (opsional)
                if ($foto_lama != "" && file_exists("../img/" . $foto_lama)) {
                    unlink("../img/" . $foto_lama);
                }
            } else {
                $error = "Gagal mengupload foto.";
                $nama_foto_final = $foto_lama; // Gagal upload, pakai foto lama
            }
        } else {
            // Jika tidak ada foto baru, tetap gunakan nama foto lama
            $nama_foto_final = $foto_lama;
        }
    }

    // Jika tidak ada error, lanjutkan simpan ke DB
    if (empty($error)) {
        if ($id == "") { // Mode CREATE (Tambah Baru)
            $sql_insert = "INSERT INTO perangkat_desa (nama, nip, jabatan, foto, urutan, kategori) 
                           VALUES ('$nama', '$nip', '$jabatan', '$nama_foto_final', '$urutan', '$kategori')";
            $q_insert = mysqli_query($koneksi, $sql_insert);
            if ($q_insert) {
                $sukses = "Data perangkat baru berhasil ditambahkan.";
            } else {
                $error = "Gagal menambahkan data: " . mysqli_error($koneksi);
            }
        } else { // Mode UPDATE (Edit)
            $sql_update = "UPDATE perangkat_desa SET 
                            nama = '$nama', 
                            nip = '$nip', 
                            jabatan = '$jabatan', 
                            foto = '$nama_foto_final', 
                            urutan = '$urutan', 
                            kategori = '$kategori' 
                          WHERE id = '$id'";
            $q_update = mysqli_query($koneksi, $sql_update);
            if ($q_update) {
                $sukses = "Data perangkat berhasil diperbarui.";
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
                    <h1 class="m-0"><?php echo ($id) ? 'Edit' : 'Tambah'; ?> Perangkat Desa</h1>
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
                                <a href="kelola_struktur.php" class="btn btn-sm btn-secondary">
                                    &lt;&lt; kembali ke Daftar Perangkat
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
                                    <meta http-equiv="refresh" content="2;url=kelola_struktur.php">
                                </div>
                            <?php } ?>

                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" value="<?php echo $nama; ?>" name="nama">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP (Opsional)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nip" value="<?php echo $nip; ?>" name="nip">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jabatan" value="<?php echo $jabatan; ?>" name="jabatan">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <?php if ($foto_lama) { // Tampilkan foto lama jika mode Edit 
                                        ?>
                                            <p>
                                                <img src="../img/<?php echo $foto_lama; ?>" style="max-width: 100px; height: auto;" class="img-thumbnail">
                                            </p>
                                        <?php } ?>
                                        <input type="file" class="form-control-file" id="foto" name="foto">
                                        <input type="hidden" name="foto_lama" value="<?php echo $foto_lama; ?>">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="urutan" class="col-sm-2 col-form-label">Nomor Urutan (Opsional)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="urutan" value="<?php echo $urutan; ?>" name="urutan">
                                        <small class="form-text text-muted">Gunakan untuk mengurutkan tampilan di halaman struktur (misal: 1, 2, 3).</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Kepala Desa" <?php if ($kategori == 'Kepala Desa') echo 'selected'; ?>>Kepala Desa</option>
                                            <option value="Sekretariat" <?php if ($kategori == 'Sekretariat') echo 'selected'; ?>>Sekretariat</option>
                                            <option value="Kaur" <?php if ($kategori == 'Kaur') echo 'selected'; ?>>Kaur (Kepala Urusan)</option>
                                            <option value="Kasi" <?php if ($kategori == 'Kasi') echo 'selected'; ?>>Kasi (Kepala Seksi)</option>
                                            <option value="Kadus" <?php if ($kategori == 'Kadus') echo 'selected'; ?>>Kadus (Kepala Dusun)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data Perangkat" />
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