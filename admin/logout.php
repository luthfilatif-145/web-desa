<?php
// Mulai sesi
session_start();

// Hancurkan semua data sesi
session_destroy();

// Lempar (redirect) kembali ke halaman login
header("location: index.php");
exit;
?>