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

if ($_FILES['file']['name']) {
 if (!$_FILES['file']['error']) {
    $name = md5(rand(100, 200));
    $ext = explode('.', $_FILES['file']['name']);
    $filename = $name . '.' . $ext[1];
    $destination = '../gambar/' . $filename; //change this directory
    $location = $_FILES["file"]["tmp_name"];
    move_uploaded_file($location, $destination);
    echo '../gambar/' . $filename;//change this URL
 }
 else
 {
  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
 }
}