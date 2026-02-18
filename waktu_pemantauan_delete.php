<?php
include "header-admin.php";
include "koneksi.php";
include "sessionlogin.php";

if ($_GET) {
    if (empty($_GET['id_waktu'])) {
        echo "<div class='alert alert-danger'>
                <strong>⚠️ Data yang dihapus tidak ditemukan.</strong>
              </div>";
    } else {
        $id_waktu = $_GET['id_waktu'];

        // Hapus data dari tabel Waktu Pemantauan Air Sungai
        $mySql = "DELETE FROM waktu_pemantauan WHERE id_waktu = '$id_waktu'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
            echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ✅ Data Waktu Pemantauan Air Sungai berhasil dihapus.
                  </div>";
            echo "<meta http-equiv='refresh' content='1; url=pemantauan_air_data.php'>";
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ❌ Gagal menghapus Data Waktu Pemantauan Air Sungai.
                  </div>";
        }
    }
}
?>