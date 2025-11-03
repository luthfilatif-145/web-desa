<?php
// ======================================================
// KODE SATPAM API (PASTE INI)
// ======================================================
session_start(); // File ini butuh session_start() sendiri
include("../db_config.php"); // File ini butuh koneksi sendiri

if ( !isset($_SESSION['admin_login']) ) {
    // Kalo API, jangan redirect, kasih error aja
    die("Akses dilarang! Silakan login dulu."); 
}
// ======================================================

// ... (Kode upload gambar lu atau daftar gambar lu) ...

$files = array_filter(glob('../gambar/*'), 'is_file');

$response = [];

foreach ($files as $file) {
	$response[] = basename($file);
}

header('Content-Type: application/json');
echo json_encode($response);
die();
?>