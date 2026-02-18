<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login atau bukan pegawai → arahkan ke halaman login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1 || $_SESSION['role'] !== 'pegawai') {
    header("Location: login_pegawai.php");
    exit();
}
?>