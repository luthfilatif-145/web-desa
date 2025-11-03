<?php
// Mulai sesi di baris paling atas
session_start();
include("../db_config.php");

// ======================================================
// PASANG SATPAM YANG BENER DI SINI
// ======================================================
if (!isset($_SESSION['admin_login'])) {
    // Jika "tiket" (sesi) login tidak ada
    header("location: index.php"); // Tendang ke halaman login
    exit;
}
// ======================================================

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard Desa</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="../css/summernote-image-list.min.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="dashboard.php" class="brand-link">
                <img src="../img/prov.png" alt="Logo Desa Teluk Nangka"
                    class="elevation-3" style="opacity: .8; max-height: 40px; width: auto;"> </a>
            <div class="sidebar">

                <nav class="mt-2">
                    <?php
                    // Dapatkan nama file saat ini, e.g., "dashboard.php"
                    $currentPage = basename($_SERVER['PHP_SELF']);

                    // Grup "Kelola Halaman"
                    $kelolaHalamanPages = [
                        'kelola_home.php',
                        'kelola_profilkades.php',
                        'kelola_struktur.php',
                        'kelola_struktur_input.php'
                    ];

                    // Grup "Kelola Data Desa"
                    $kelolaDataPages = [
                        'kelola_penduduk.php',
                        'kelola_wilayah.php',
                        'kelola_apbdesa.php',
                        'kelola_apbdesa_input.php'
                    ];

                    // Grup "Artikel"
                    $artikelPages = [
                        'halaman.php',
                        'halaman_input.php'
                    ];

                    // Grup "Galeri"
                    $galeriPages = [
                        'kelola_galeri.php',
                        'kelola_galeri_input.php'
                    ];
                    ?>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link <?php if ($currentPage == 'dashboard.php') echo 'active'; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../home.php" class="nav-link" target="blank">
                                <i class="nav-icon fas fa-external-link-alt"></i>
                                <p>Lihat Situs Publik</p>
                            </a>
                        </li>
                        <li class="nav-header">KELOLA HALAMAN PUBLIK</li>

                        <li class="nav-item <?php if (in_array($currentPage, $kelolaHalamanPages)) echo 'menu-open'; ?>">
                            <a href="#" class="nav-link <?php if (in_array($currentPage, $kelolaHalamanPages)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Kelola Halaman<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="kelola_home.php" class="nav-link <?php if ($currentPage == 'kelola_home.php') echo 'active'; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit Visi & Misi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="kelola_profilkades.php" class="nav-link <?php if ($currentPage == 'kelola_profilkades.php') echo 'active'; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit Profil Kades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="kelola_struktur.php" class="nav-link <?php if ($currentPage == 'kelola_struktur.php' || $currentPage == 'kelola_struktur_input.php') echo 'active'; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit Struktur Desa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item <?php if (in_array($currentPage, $kelolaDataPages)) echo 'menu-open'; ?>">
                            <a href="#" class="nav-link <?php if (in_array($currentPage, $kelolaDataPages)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Kelola Data Desa<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="kelola_penduduk.php" class="nav-link <?php if ($currentPage == 'kelola_penduduk.php') echo 'active'; ?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Data Penduduk</p>
                                    </a></li>
                                <li class="nav-item"><a href="kelola_wilayah.php" class="nav-link <?php if ($currentPage == 'kelola_wilayah.php') echo 'active'; ?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Data Wilayah</p>
                                    </a></li>
                                <li class="nav-item"><a href="kelola_apbdesa.php" class="nav-link <?php if ($currentPage == 'kelola_apbdesa.php' || $currentPage == 'kelola_apbdesa_input.php') echo 'active'; ?>"><i class="far fa-circle nav-icon"></i>
                                        <p>APB Desa</p>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="kelola_galeri.php" class="nav-link <?php if (in_array($currentPage, $galeriPages)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-images"></i>
                                <p>Kelola Galeri Desa</p>
                            </a>
                        </li>

                        <li class="nav-header">PENGATURAN</li>

                        <li class="nav-item">
                            <a href="halaman.php" class="nav-link <?php if (in_array($currentPage, $artikelPages)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Pengaturan Artikel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>