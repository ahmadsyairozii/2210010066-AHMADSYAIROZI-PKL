<?php
include "header-admin.php";
include "koneksi.php";
include "sessionlogin.php";

if ($_GET) {
    if (empty($_GET['id_nilai'])) {
        echo "<div class='alert alert-danger'>
                <strong>⚠️ Data yang dihapus tidak ditemukan.</strong>
              </div>";
    } else {
        $id_nilai = $_GET['id_nilai'];

        // Hapus data dari tabel Nilai Pemantauan Air Sungai
        $mySql = "DELETE FROM nilai_pemantauan WHERE id_nilai = '$id_nilai'";
        $myQry = mysqli_query($koneksi, $mySql) or die("Error hapus data: " . mysqli_error($koneksi));

        if ($myQry) {
            echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ✅ Data Nilai Pemantauan Air Sungai berhasil dihapus.
                  </div>";
            echo "<meta http-equiv='refresh' content='1; url=nilai_pemantauan_data.php'>";
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    ❌ Gagal menghapus Data Nilai Pemantauan Air Sungai.
                  </div>";
        }
    }
}
?>