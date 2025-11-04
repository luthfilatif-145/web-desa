<?php
// 1. LOGIKA PHP ANDA (Sudah Bagus)
// =================================
include("../db_config.php");


$sukses = "";
$error = "";
$katakunci = isset($_GET['katakunci']) ? $_GET['katakunci'] : "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'hapus') {
    $id = $_GET['id'];
    $sql1 = "delete from halaman where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus";
    }
}
?>

<?php
// 2. PANGGIL HEADER ADMINLTE
// =================================
// Ini akan memuat <html>, <head>, <header>, dan <aside> (sidebar)
include("inc_header.php");
?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan Artikel</h1>
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
                                <a href="halaman_input.php">
                                    <input type="button" class="btn btn-primary" value="Buat Halaman Baru" />
                                </a>
                            </p>
                            <form class="row g-3 mb-3" method="get">
                                <div class="col-auto">
                                    <input type="text" class="form-control" placeholder="masukkan kata kunci" name="katakunci" value="<?php echo $katakunci ?>" />
                                </div>
                                <div class="col-auto">
                                    <input type="submit" name="Cari" value="Cari Tulisan" class="btn btn-secondary" />
                                </div>
                            </form>

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-1">#</th>
                                        <th>Judul</th>
                                        <th>Kutipan</th>
                                        <th>Isi</th>
                                        <th class="col-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Logika Pagination dan Kueri Anda
                                    $sqltambahan = "";
                                    $per_halaman = 4;
                                    if ($katakunci != '') {
                                        $array_katakunci = explode(" ", $katakunci);
                                        $sqlcari = [];
                                        for ($x = 0; $x < count($array_katakunci); $x++) {
                                            $sqlcari[] = "(judul like '%" . $array_katakunci[$x] . "%' or kutipan like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
                                        }
                                        $sqltambahan = " where " . implode(" or ", $sqlcari);
                                    }

                                    $sql1 = "select * from halaman $sqltambahan";
                                    $q_total = mysqli_query($koneksi, $sql1);
                                    if (!$q_total) {
                                        die("Query hitung total gagal: " . mysqli_error($koneksi));
                                    }
                                    $total = mysqli_num_rows($q_total);

                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
                                    $pages = ceil($total / $per_halaman);
                                    $Nomor = $mulai + 1;

                                    $sql_final = $sql1 . " order by id desc limit $mulai, $per_halaman";
                                    $q_final = mysqli_query($koneksi, $sql_final);

                                    while ($r1 = mysqli_fetch_array($q_final)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $Nomor++ ?></td>
                                            <td><?php echo $r1['judul'] ?></td>
                                            <td><?php echo $r1['kutipan'] ?></td>
                                            <td>
                                                <?php
                                                // Opsi: Potong teks jika terlalu panjang
                                                echo substr(strip_tags($r1['isi']), 0, 50) . "...";
                                                ?>
                                            </td>
                                            <td> <a href="halaman_input.php?id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="halaman.php?op=hapus&id=<?php echo $r1['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
                                            <a class="page-link" href="halaman.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>">
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
// 4. PANGGIL FOOTER ADMINLTE
// =================================
// Ini akan memuat </footer>, </div> (penutup wrapper), <script>, dan </html>
include("inc_footer.php");
?>