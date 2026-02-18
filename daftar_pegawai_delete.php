<?php
include('header-admin.php');
include('koneksi.php');
include('sessionlogin_pegawai.php');

// Pastikan parameter id_user dikirim lewat URL
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    echo "<div class='alert alert-danger'>
            ⚠️ ID user tidak ditemukan!
          </div>";
    exit;
}

$id_user = $_GET['id_user'];

// Cek apakah user dengan ID tersebut ada
$cek = mysqli_query($koneksi, "SELECT * FROM user_pegawai WHERE id_user='$id_user'");
if (mysqli_num_rows($cek) == 0) {
    echo "<div class='alert alert-warning'>
            ⚠️ Data User Pegawai tidak ditemukan di database.
          </div>";
    exit;
}

// Lakukan penghapusan
$delete = mysqli_query($koneksi, "DELETE FROM user_pegawai WHERE id_user='$id_user'") or die(mysqli_error($koneksi));

if ($delete) {
    echo "<div class='alert alert-success alert-dismissable'>
            ✅ Data Akun Pegawai berhasil dihapus.
          </div>";
    echo "<meta http-equiv='refresh' content='1; url=daftar_admin.php'>";
} else {
    echo "<div class='alert alert-danger alert-dismissable'>
            ❌ Gagal menghapus data akun pegawai. Silakan coba lagi.
          </div>";
}
?>

<?php include('footer.php'); ?>