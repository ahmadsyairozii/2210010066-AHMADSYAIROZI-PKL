<?php
include "header-admin.php"; 
include "sessionlogin.php";
include "koneksi.php";

if (isset($_POST['add'])) {
    $id_lokasi          = $_POST['id_lokasi'];
    $id_petugas         = $_POST['id_petugas'];
    $tanggal_pemantauan = $_POST['tanggal_pemantauan'];
    $jam_pemantauan     = $_POST['jam_pemantauan'];
    $periode_pemantauan = $_POST['periode_pemantauan'];

    $insert = mysqli_query($koneksi, 
        "INSERT INTO waktu_pemantauan (id_lokasi, id_petugas, tanggal_pemantauan, jam_pemantauan, periode_pemantauan)
         VALUES ('$id_lokasi', '$id_petugas', '$tanggal_pemantauan', '$jam_pemantauan', '$periode_pemantauan')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Waktu Pemantauan Air Sungai berhasil disimpan!
              </div>
              <meta http-equiv="refresh" content="1; url=waktu_pemantauan_data.php" />';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ❌ Gagal menyimpan Dara Waktu Pemantauan Air Sungai!
              </div>';
    }
}
?>

<h2>Data Waktu Pemantauan Air Sungai &raquo; Tambah Data</h2> 
<hr />
<form class="form-horizontal" action="" method="post">

    <!-- Pilih Lokasi Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Lokasi Pemantauan</label>
        <div class="col-sm-5">
            <select name="id_lokasi" class="form-control" required>
                <option value="">-- Pilih Lokasi Pemantauan --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_lokasi, kode_lokasi, nama_lokasi FROM lokasi_pemantauan ORDER BY kode_lokasi ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_lokasi']}'>{$row['kode_lokasi']} ({$row['nama_lokasi']})</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Pilih Nama Petugas -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Petugas</label>
        <div class="col-sm-5">
            <select name="id_petugas" class="form-control" required>
                <option value="">-- Pilih Nama Petugas --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_petugas, nama_petugas FROM petugas_sampling ORDER BY nama_petugas ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_petugas']}'>{$row['nama_petugas']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Tanggal Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Pemantauan</label>
        <div class="col-sm-3">
            <input type="date" name="tanggal_pemantauan" class="form-control" required>
        </div>
    </div>

    <!-- Jam Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Jam Pemantauan</label>
        <div class="col-sm-4">
            <input type="text" name="jam_pemantauan" class="form-control" placeholder="Masukkan Jam Pemantauan" required>
        </div>
    </div>

    <!-- Periode Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Periode Pemantauan</label>
        <div class="col-sm-4">
            <input type="text" name="periode_pemantauan" class="form-control" placeholder="Misal: 1, 2" required>
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