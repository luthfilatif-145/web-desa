<?php
// 1. SAMBUNGKAN KE DATABASE & MULAI SESI
include("../db_config.php");


$sukses = "";
$error = "";
$katakunci = isset($_GET['katakunci']) ? $_GET['katakunci'] : "";

// 2. LOGIKA HAPUS DATA
if (isset($_GET['op']) && $_GET['op'] == 'hapus') {
    $id = $_GET['id'];

    // Hapus data dari database
    $sql_delete = "DELETE FROM apbdes_rincian WHERE id = '$id'";
    $q_delete = mysqli_query($koneksi, $sql_delete);

    if ($q_delete) {
        $sukses = "Data rincian APBDesa berhasil dihapus.";
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
                    <h1 class="m-0">Kelola APB Desa</h1>
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

                            <?php if ($sukses) { ?>
                                <div class="alert alert-primary" role="alert"><?php echo $sukses ?></div>
                            <?php } ?>
                            <?php if ($error) { ?>
                                <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
                            <?php } ?>

                            <p>
                                <a href="kelola_apbdesa_input.php">
                                    <input type="button" class="btn btn-primary" value="Tambah Rincian APBDes" />
                                </a>
                            </p>
                            <form class="row g-3 mb-3" method="get">
                                <div class="col-auto">
                                    <input type="text" class="form-control" placeholder="Cari Uraian..." name="katakunci" value="<?php echo $katakunci ?>" />
                                </div>
                                <div class="col-auto">
                                    <input type="submit" name="Cari" value="Cari" class="btn btn-secondary" />
                                </div>
                            </form>

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-1">Kode</th>
                                        <th class="col-4">Uraian</th>
                                        <th class="col-2">Anggaran (Rp)</th>
                                        <th class="col-1">Tipe</th>
                                        <th class="col-1">Total?</th>
                                        <th class="col-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Logika Pencarian & Pagination
                                    $sqltambahan = "";
                                    $per_halaman = 10; // Tampilkan 10 data per halaman
                                    if ($katakunci != '') {
                                        // Sesuaikan pencarian dengan kolom 'uraian'
                                        $sqltambahan = " WHERE uraian LIKE '%" . $katakunci . "%'";
                                    }

                                    $sql1 = "SELECT * FROM apbdes_rincian $sqltambahan";
                                    $q_total = mysqli_query($koneksi, $sql1);
                                    if (!$q_total) {
                                        die("Query total gagal: " . mysqli_error($koneksi));
                                    }
                                    $total = mysqli_num_rows($q_total);

                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
                                    $pages = ceil($total / $per_halaman);

                                    // Query final dengan urutan dan limit
                                    $sql_final = $sql1 . " ORDER BY kode_akun ASC LIMIT $mulai, $per_halaman";
                                    $q_final = mysqli_query($koneksi, $sql_final);

                                    while ($r1 = mysqli_fetch_array($q_final)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $r1['kode_akun'] ?></td>
                                            <td><?php echo $r1['uraian'] ?></td>
                                            <td>Rp <?php echo number_format($r1['anggaran_rp'], 0, ',', '.'); ?></td>
                                            <td>
                                                <?php if ($r1['tipe'] == 'PENDAPATAN') {
                                                    echo '<span class="badge badge-success">Pendapatan</span>';
                                                } else {
                                                    echo '<span class="badge badge-warning">Belanja</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo ($r1['is_total'] == 1) ? 'Ya' : 'Bukan'; ?></td>
                                            <td>
                                                <a href="kelola_apbdesa_input.php?id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="kelola_apbdesa.php?op=hapus&id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus rincian ini?')">Delete</a>
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
                                            <a class="page-link" href="kelola_apbdesa.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>">
                                                <?php echo $i ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </nav>

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