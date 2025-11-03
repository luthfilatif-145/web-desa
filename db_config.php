<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_teluknangka";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect());
} else {
    // echo "koneksi keren banget";
}