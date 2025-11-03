<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI

include("../db_config.php");

// (NANTI KITA TAMBAHKAN KODE KEAMANAN LOGIN DI SINI)

$error_visi = "";
$sukses_visi = "";
$error_misi = "";
$sukses_misi = "";

// 2. LOGIKA PROSES FORM (POST & GET)
// =================================================

// Cek apakah ada aksi HAPUS?
if (isset($_GET['op'])) {
    // --- AKSI HAPUS VISI ---
    if ($_GET['op'] == 'hapus_visi' && isset($_GET['id'])) {
        $id_visi = $_GET['id'];
        $sql_delete = "DELETE FROM visi WHERE id_visi = '$id_visi'";
        $q_delete = mysqli_query($koneksi, $sql_delete);
        if ($q_delete) {
            $sukses_visi = "Poin Visi berhasil dihapus.";
        } else {
            $error_visi = "Gagal menghapus poin Visi.";
        }
    }
    // --- AKSI HAPUS MISI ---
    if ($_GET['op'] == 'hapus_misi' && isset($_GET['id'])) {
        $id_misi = $_GET['id'];
        $sql_delete = "DELETE FROM misi WHERE id_misi = '$id_misi'";
        $q_delete = mysqli_query($koneksi, $sql_delete);
        if ($q_delete) {
            $sukses_misi = "Poin Misi berhasil dihapus.";
        } else {
            $error_misi = "Gagal menghapus poin Misi.";
        }
    }
}

// Cek apakah ada aksi TAMBAH BARU?
if (isset($_POST['simpan_visi'])) {
    $id_butir = $_POST['id_butir'];
    $butir_visi = $_POST['butir_visi'];
    if ($id_butir == '' or $butir_visi == '') {
        $error_visi = "Nomor Urut dan Butir Visi tidak boleh kosong.";
    } else {
        $sql_insert = "INSERT INTO visi (id_butir, butir_visi) VALUES ('$id_butir', '$butir_visi')";
        $q_insert = mysqli_query($koneksi, $sql_insert);
        if ($q_insert) {
            $sukses_visi = "Poin Visi baru berhasil ditambahkan.";
        } else {
            $error_visi = "Gagal menyimpan: " . mysqli_error($koneksi);
        }
    }
}
if (isset($_POST['simpan_misi'])) {
    $id_butir = $_POST['id_butir'];
    $butir_misi = $_POST['butir_misi'];
    if ($id_butir == '' or $butir_misi == '') {
        $error_misi = "Nomor Urut dan Butir Misi tidak boleh kosong.";
    } else {
        $sql_insert = "INSERT INTO misi (id_butir, butir_misi) VALUES ('$id_butir', '$butir_misi')";
        $q_insert = mysqli_query($koneksi, $sql_insert);
        if ($q_insert) {
            $sukses_misi = "Poin Misi baru berhasil ditambahkan.";
        } else {
            $error_misi = "Gagal menyimpan: " . mysqli_error($koneksi);
        }
    }
}


// 3. LOGIKA UNTUK MENGAMBIL DATA (READ)
// =================================================
// Ambil semua data Visi untuk ditampilkan di tabel
$sql_visi = "SELECT * FROM visi ORDER BY id_butir ASC";
$result_visi = mysqli_query($koneksi, $sql_visi);

// Ambil semua data Misi untuk ditampilkan di tabel
$sql_misi = "SELECT * FROM misi ORDER BY id_butir ASC";
$result_misi = mysqli_query($koneksi, $sql_misi);
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
                    <h1 class="m-0">Edit Visi & Misi</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

            <p>
                <a href="halaman.php" class="btn btn-sm btn-secondary">
                    &lt;&lt; kembali ke halaman Admin
                </a>
            </p>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kelola VISI</h3>
                        </div>

                        <form action="" method="POST">
                            <div class="card-body">
                                <?php if ($error_visi) { ?><div class="alert alert-danger" role="alert"><?php echo $error_visi ?></div><?php } ?>
                                <?php if ($sukses_visi) { ?><div class="alert alert-success" role="alert"><?php echo $sukses_visi ?></div><?php } ?>

                                <div class="form-group">
                                    <label for="id_butir_visi">Nomor Urut sesuaikan dengan poin sebelumnya (misal: a) b) dan seterusnya)</label>
                                    <input type="text" class="form-control" name="id_butir" id="id_butir_visi" placeholder="Contoh: a">
                                </div>
                                <div class="form-group">
                                    <label for="butir_visi">Isi Butir Visi (termasuk tag <strong> jika perlu)</label>
                                    <textarea name="butir_visi" class="form-control" id="butir_visi" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="simpan_visi" class="btn btn-primary">Simpan Poin Visi Baru</button>
                            </div>
                        </form>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Urut</th>
                                        <th>Butir Visi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_visi = mysqli_fetch_assoc($result_visi)) { ?>
                                        <tr>
                                            <td><?php echo $row_visi['id_butir']; ?></td>
                                            <td><?php echo htmlspecialchars(substr($row_visi['butir_visi'], 0, 50)); ?>...</td>
                                            <td>
                                                <a href="kelola_home.php?op=hapus_visi&id=<?php echo $row_visi['id_visi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus poin ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>>
            <div class="row">    
                <div class="col-md-12 mb-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Kelola MISI</h3>
                        </div>

                        <form action="" method="POST">
                            <div class="card-body">
                                <?php if ($error_misi) { ?><div class="alert alert-danger" role="alert"><?php echo $error_misi ?></div><?php } ?>
                                <?php if ($sukses_misi) { ?><div class="alert alert-success" role="alert"><?php echo $sukses_misi ?></div><?php } ?>

                                <div class="form-group">
                                    <label for="id_butir_misi">Nomor Urut (misal: 1, 2, 3)</label>
                                    <input type="text" class="form-control" name="id_butir" id="id_butir_misi" placeholder="Contoh: 1">
                                </div>
                                <div class="form-group">
                                    <label for="butir_misi">Isi Butir Misi</label>
                                    <textarea name="butir_misi" class="form-control" id="butir_misi" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="simpan_misi" class="btn btn-success">Simpan Poin Misi Baru</button>
                            </div>
                        </form>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Urut</th>
                                        <th>Butir Misi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_misi = mysqli_fetch_assoc($result_misi)) { ?>
                                        <tr>
                                            <td><?php echo $row_misi['id_butir']; ?></td>
                                            <td><?php echo htmlspecialchars(substr($row_misi['butir_misi'], 0, 50)); ?>...</td>
                                            <td>
                                                <a href="kelola_home.php?op=hapus_misi&id=<?php echo $row_misi['id_misi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus poin ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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