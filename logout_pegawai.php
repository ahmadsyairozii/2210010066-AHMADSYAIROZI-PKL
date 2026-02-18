<?php
session_start();
session_unset();   // Hapus semua variabel session
session_destroy(); // Hapus session dari server
header("Location: login_pegawai.php?logout=1");
exit();
?>