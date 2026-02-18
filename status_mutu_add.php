<?php
include "header-admin.php"; 
include "sessionlogin.php";
include "koneksi.php";

if (isset($_POST['add'])) {
    $id_lokasi        = $_POST['id_lokasi'];
    $id_waktu         = $_POST['id_waktu'];
    $status_mutu_air  = $_POST['status_mutu_air'];
    $nilai_ip         = $_POST['nilai_ip'];

    $insert = mysqli_query($koneksi, 
        "INSERT INTO status_mutu (id_lokasi, id_waktu, status_mutu_air, nilai_ip)
         VALUES ('$id_lokasi', '$id_waktu', '$status_mutu_air', '$nilai_ip')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Status Mutu Air Sungai berhasil disimpan!
              </div>
              <meta http-equiv="refresh" content="1; url=status_mutu_data.php" />';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ❌ Gagal menyimpan Data Status Mutu Air Sungai!
              </div>';
    }
}
?>

<h2>Data Status Mutu Air Sungai &raquo; Tambah Data</h2> 
<hr />
<form class="form-horizontal" action="" method="post">

    <!-- Pilih Kode Lokasi -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Lokasi</label>
        <div class="col-sm-5">
            <select name="id_lokasi" class="form-control" required>
                <option value="">-- Pilih Kode Lokasi --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_lokasi, kode_lokasi FROM lokasi_pemantauan ORDER BY kode_lokasi ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_lokasi']}'>{$row['kode_lokasi']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Pilih Tanggal Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Pemantauan</label>
        <div class="col-sm-5">
            <select name="id_waktu" class="form-control" required>
                <option value="">-- Pilih Tanggal Pemantauan --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_waktu, tanggal_pemantauan FROM waktu_pemantauan ORDER BY tanggal_pemantauan ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_waktu']}'>{$row['tanggal_pemantauan']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Status Mutu Air Sungai -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kondisi Status Mutu Air</label>
        <div class="col-sm-4">
            <input type="text" name="status_mutu_air" class="form-control" placeholder="Masukkan Cemar Ringan, Cemar Sedang atau Cemar Berat!" required>
        </div>
    </div>

    <!-- Nilai Indeks Pencemar -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Nilai Indeks Pencemar</label>
        <div class="col-sm-4">
            <input type="text" name="nilai_ip" class="form-control" placeholder="Masukkan Nilai Indeks Pencemar" required>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
            <button type="submit" name="add" class="btn btn-sm btn-primary">Simpan</button>
            <button type="reset" class="btn btn-sm btn-warning">Reset</button>
            <button class="btn btn-sm btn-danger" onclick="history.back()">Kembali</button>
        </div>
    </div>
</form>

<?php include "footer.php"; ?>
