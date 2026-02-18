<?php
include "header-admin.php";
include "koneksi.php";
include "sessionlogin.php";

if ($_GET) {
    if (empty($_GET['id_status'])) {
        echo "<div class='alert alert-danger'>
                <strong>⚠️ Data yang dihapus tidak ditemukan.</strong>
              </div>";
    } else {
        $id_status = $_GET['id_status'];

        // Hapus data dari tabel Status Mutu Air Sungai
        $mySql = "DELETE FROM status_mutu WHERE id_status = '$id_status'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
            echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ✅ Data Status Mutu Air Sungai berhasil dihapus.
                  </div>";
            echo "<meta http-equiv='refresh' content='1; url=status_mutu_data.php'>";
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ❌ Gagal menghapus Data Status Mutu Air Sungai.
                  </div>";
        }
    }
}
?>