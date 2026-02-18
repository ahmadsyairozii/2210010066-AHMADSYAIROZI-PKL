<?php 
include "header-admin.php"; 
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

if ($_GET) {
    if (empty($_GET['id_petugas'])) {
?>
        <b>⚠️ Data yang dihapus tidak ada.</b>
<?php
    } else {
        $id_petugas = $_GET['id_petugas'];

        // Query hapus data berdasarkan id_petugas
        $mySql = "DELETE FROM petugas_sampling WHERE id_petugas='$id_petugas'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Petugas Sampling berhasil dihapus.
            </div>
            <!-- Redirect otomatis ke halaman data Petugas Sampling -->
            <meta http-equiv='refresh' content='1; url=petugas_sampling_data.php'>
<?php
        }
    }
}
?>