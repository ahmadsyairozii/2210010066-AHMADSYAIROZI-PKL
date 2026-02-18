<?php
include "header-admin.php"; 
include "sessionlogin.php";
include "koneksi.php";

if (isset($_POST['add'])) {
    $id_petugas  = $_POST['id_petugas'];
    $id_lokasi   = $_POST['id_lokasi'];
    $id_nilai    = $_POST['id_nilai'];
    $id_status   = $_POST['id_status'];
    $kategori    = $_POST['kategori'];
    $level       = $_POST['level'];
    $shu         = $_POST['shu'];

    $insert = mysqli_query($koneksi, 
        "INSERT INTO observasi_sungai (id_petugas, id_lokasi, id_nilai, id_status, kategori, level, shu)
         VALUES ('$id_petugas', '$id_lokasi', '$id_nilai', '$id_status', '$kategori', '$level', '$shu')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Observasi Air Sungai berhasil disimpan!
              </div>
              <meta http-equiv="refresh" content="1; url=observasi_sungai_data.php" />';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ❌ Gagal menyimpan Data Observasi Air Sungai!
              </div>';
    }
}
?>

<h2>Data Observasi Air Sungai &raquo; Tambah Data</h2> 
<hr />
<form class="form-horizontal" action="" method="post">

    <!-- Pilih Nama Petugas -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Petugas</label>
        <div class="col-sm-5">
            <select name="id_petugas" class="form-control" required>
                <option value="">-- Pilih Nama Petugas --</option>
                <?php
                $petugasQuery = mysqli_query($koneksi, "SELECT id_petugas, nama_petugas FROM petugas_sampling ORDER BY nama_petugas ASC");
                while ($row = mysqli_fetch_assoc($petugasQuery)) {
                    echo "<option value='{$row['id_petugas']}'>{$row['nama_petugas']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Pilih Nama Lokasi -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Lokasi</label>
        <div class="col-sm-5">
            <select name="id_lokasi" class="form-control" required>
                <option value="">-- Pilih Nama Lokasi --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_lokasi, kode_lokasi FROM lokasi_pemantauan ORDER BY kode_lokasi ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_lokasi']}'>{$row['kode_lokasi']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Pilih pH -->
    <div class="form-group">
        <label class="col-sm-3 control-label">pH</label>
        <div class="col-sm-5">
            <select name="id_nilai" class="form-control" required>
                <option value="">-- Pilih pH --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_nilai, ph FROM nilai_pemantauan ORDER BY ph ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_nilai']}'>{$row['ph']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Pilih Status Mutu Air -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Status Mutu Air</label>
        <div class="col-sm-5">
            <select name="id_status" class="form-control" required>
                <option value="">-- Pilih Status Mutu Air --</option>
                <?php
                $lokasiQuery = mysqli_query($koneksi, "SELECT id_status, status_mutu_air FROM status_mutu ORDER BY status_mutu_air ASC");
                while ($row = mysqli_fetch_assoc($lokasiQuery)) {
                    echo "<option value='{$row['id_status']}'>{$row['status_mutu_air']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Kategori -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kategori</label>
        <div class="col-sm-4">
            <input type="text" name="kategori" class="form-control" placeholder="Masukkan Kategori" required>
        </div>
    </div>

    <!-- Level -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Level</label>
        <div class="col-sm-4">
            <input type="text" name="level" class="form-control" placeholder="Masukkan Level" required>
        </div>
    </div>

    <!-- SHU -->
    <div class="form-group">
        <label class="col-sm-3 control-label">SHU</label>
        <div class="col-sm-4">
            <input type="text" name="shu" class="form-control" placeholder="Masukkan SHU" required>
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
