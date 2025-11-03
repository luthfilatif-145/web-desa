<?php
// 1. Mulai Sesi
session_start();
include("../db_config.php"); // Sambungkan ke database

$error = "";

// ======================================================
// SATPAM KHUSUS HALAMAN LOGIN
// ======================================================
// Cek apakah admin SUDAH LOGIN?
if (isset($_SESSION['admin_login'])) {
    // Kalo udah login, NGAPAIN ke halaman login lagi?
    // Tendang dia ke dashboard.
    header("location: dashboard.php");
    exit;
}

// 3. Cek apakah tombol Login ditekan?
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $error = "Silakan masukkan Username dan Password.";
    } else {
        // 4. Cek ke database
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);

        if (!$q1) { // Kalo kueri gagal
            $error = "Query Gagal: " . mysqli_error($koneksi);
        } else {
            $r1 = mysqli_fetch_array($q1);
            $n1 = mysqli_num_rows($q1);

            if ($n1 < 1) {
                $error = "Username tidak ditemukan.";
            } elseif ($r1['password'] != $password) {
                $error = "Password salah.";
            } else {
                // 5. Jika SEMUA BENAR: Buat Sesi (Tiket Masuk)
                $_SESSION['admin_login'] = $username;
                header("location: dashboard.php");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Desa | Log in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b> Desa</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silakan login untuk memulai sesi Anda</p>

                <?php if ($error) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>