<?php
include "header-admin.php";
include "koneksi.php";
include "sessionlogin.php";

if ($_GET) {
    if (empty($_GET['id_observasi'])) {
        echo "<div class='alert alert-danger'>
                <strong>⚠️ Data yang dihapus tidak ditemukan.</strong>
              </div>";
    } else {
        $id_observasi = $_GET['id_observasi'];

        // Hapus data dari tabel Waktu Pemantauan Air Sungai
        $mySql = "DELETE FROM observasi_sungai WHERE id_observasi = '$id_observasi'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
            echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ✅ Data Observasi Air Sungai berhasil dihapus.
                  </div>";
            echo "<meta http-equiv='refresh' content='1; url=observasi_sungai_data.php'>";
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ❌ Gagal menghapus Data Observasi Air Sungai.
                  </div>";
        }
    }
}
?>