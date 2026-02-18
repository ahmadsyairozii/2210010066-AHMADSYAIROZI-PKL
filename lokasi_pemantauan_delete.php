<?php 
include "header-admin.php"; 
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

if ($_GET) {
    if (empty($_GET['id_lokasi'])) {
?>
        <b>⚠️ Data yang dihapus tidak ada.</b>
<?php
    } else {
        $id_lokasi = $_GET['id_lokasi'];

        // Query hapus data berdasarkan id_lokasi
        $mySql = "DELETE FROM lokasi_pemantauan WHERE id_lokasi='$id_lokasi'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Lokasi Pemantauan berhasil dihapus.
            </div>
            <!-- Redirect otomatis ke halaman data lokasi -->
            <meta http-equiv='refresh' content='1; url=lokasi_pemantauan_data.php'>
<?php
        }
    }
}
?>