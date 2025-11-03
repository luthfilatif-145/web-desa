<?php

include("../db_config.php");


// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error = "";
$sukses = "";

// Inisialisasi variabel untuk form
$kode_akun = "";
$uraian = "";
$anggaran_rp = "";
$tipe = "";
$is_total = 0; // Defaultnya bukan total (0)

// 2. LOGIKA MODE EDIT (Ambil data jika ada ID)
// =================================================
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") { // Jika ID ada (mode Edit)
    $sql_get = "SELECT * FROM apbdes_rincian WHERE id = '$id'";
    $q_get = mysqli_query($koneksi, $sql_get);
    $data = mysqli_fetch_assoc($q_get);
    if ($data) {
        $kode_akun = $data['kode_akun'];
        $uraian = $data['uraian'];
        $anggaran_rp = $data['anggaran_rp'];
        $tipe = $data['tipe'];
        $is_total = $data['is_total'];
    } else {
        $error = "Data tidak ditemukan.";
    }
}

// 3. LOGIKA SAAT TOMBOL "SIMPAN" DITEKAN (POST)
// =================================================
if (isset($_POST['simpan'])) {
    // Ambil semua data dari form
    $kode_akun = $_POST['kode_akun'];
    $uraian = $_POST['uraian'];
    $anggaran_rp = $_POST['anggaran_rp'];
    $tipe = $_POST['tipe'];
    $is_total = $_POST['is_total'];

    // Validasi dasar
    if ($kode_akun == '' || $uraian == '' || $anggaran_rp == '' || $tipe == '') {
        $error = "Semua kolom (kecuali 'Baris Total?') tidak boleh kosong.";
    }

    // Jika tidak ada error, lanjutkan simpan ke DB
    if (empty($error)) {
        if ($id == "") { // Mode CREATE (Tambah Baru)
            $sql_insert = "INSERT INTO apbdes_rincian (kode_akun, uraian, anggaran_rp, tipe, is_total) 
                           VALUES ('$kode_akun', '$uraian', '$anggaran_rp', '$tipe', '$is_total')";
            $q_insert = mysqli_query($koneksi, $sql_insert);
            if ($q_insert) {
                $sukses = "Rincian APBDes baru berhasil ditambahkan.";
            } else {
                $error = "Gagal menambahkan data: " . mysqli_error($koneksi);
            }
        } else { // Mode UPDATE (Edit)
            $sql_update = "UPDATE apbdes_rincian SET 
                            kode_akun = '$kode_akun', 
                            uraian = '$uraian', 
                            anggaran_rp = '$anggaran_rp', 
                            tipe = '$tipe', 
                            is_total = '$is_total' 
                          WHERE id = '$id'";
            $q_update = mysqli_query($koneksi, $sql_update);
            if ($q_update) {
                $sukses = "Rincian APBDes berhasil diperbarui.";
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
                    <h1 class="m-0"><?php echo ($id) ? 'Edit' : 'Tambah'; ?> Rincian APBDes</h1>
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
                                <a href="kelola_apbdesa.php" class="btn btn-sm btn-secondary">
                                    &lt;&lt; kembali ke Daftar APBDes
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
                                    <meta http-equiv="refresh" content="2;url=kelola_apbdesa.php">
                                </div>
                            <?php } ?>

                            <form action="" method="post">

                                <div class="mb-3 row">
                                    <label for="kode_akun" class="col-sm-2 col-form-label">Kode Akun*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_akun" value="<?php echo $kode_akun; ?>" name="kode_akun" placeholder="Contoh: 1.1 atau 2.1">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="uraian" class="col-sm-2 col-form-label">Uraian*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="uraian" value="<?php echo $uraian; ?>" name="uraian" placeholder="Contoh: Alokasi Dana Desa (ADD)">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="anggaran_rp" class="col-sm-2 col-form-label">Anggaran (Rp)*</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="anggaran_rp" value="<?php echo $anggaran_rp; ?>" name="anggaran_rp" placeholder="Hanya angka, contoh: 1500000">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tipe" class="col-sm-2 col-form-label">Tipe*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="tipe" id="tipe">
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="PENDAPATAN" <?php if ($tipe == 'PENDAPATAN') echo 'selected'; ?>>PENDAPATAN</option>
                                            <option value="BELANJA" <?php if ($tipe == 'BELANJA') echo 'selected'; ?>>BELANJA</Soption>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="is_total" class="col-sm-2 col-form-label">Baris Total?</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="is_total" id="is_total">
                                            <option value="0" <?php if ($is_total == '0') echo 'selected'; ?>>Bukan (Rincian biasa)</option>
                                            <option value="1" <?php if ($is_total == '1') echo 'selected'; ?>>Ya (Ini adalah baris Total)</option>
                                        </select>
                                        <small class="form-text text-muted">Pilih "Ya" jika ini adalah baris judul utama (PENDAPATAN atau BELANJA).</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Rincian" />
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