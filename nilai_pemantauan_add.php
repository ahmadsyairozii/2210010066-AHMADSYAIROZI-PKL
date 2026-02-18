<?php
include "header-admin.php"; 
include "sessionlogin.php";
include "koneksi.php";

if (isset($_POST['add'])) {
    $id_lokasi  = $_POST['id_lokasi'];
    $id_petugas = $_POST['id_petugas'];
    $debit_air  = $_POST['debit_air'];
    $ph         = $_POST['ph'];
    $bod        = $_POST['bod'];
    $cod        = $_POST['cod'];
    $tss        = $_POST['tss'];
    $do         = $_POST['do'];

    $insert = mysqli_query($koneksi, 
        "INSERT INTO nilai_pemantauan (id_lokasi, id_petugas, debit_air, ph, bod, cod, tss, do)
         VALUES ('$id_lokasi', '$id_petugas', '$debit_air', '$ph', '$bod', '$cod', '$tss', '$do')"
    ) or die(mysqli_error($koneksi));

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data Nilai Pemantauan Air Sungai berhasil disimpan!
              </div>
              <meta http-equiv="refresh" content="1; url=nilai_pemantauan_data.php" />';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ❌ Gagal menyimpan Data Nilai Pemantauan Air Sungai!
              </div>';
    }
}
?>

<h2>Data Nilai Pemantauan Air Sungai &raquo; Tambah Data</h2> 
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

    <!-- Debit Air -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Debit Air (m3/s)</label>
        <div class="col-sm-4">
            <input type="text" name="debit_air" class="form-control" placeholder="Masukkan Debit Air" required>
        </div>
    </div>

    <!-- pH -->
    <div class="form-group">
        <label class="col-sm-3 control-label">pH</label>
        <div class="col-sm-4">
            <input type="text" name="ph" class="form-control" placeholder="Masukkan pH" required>
        </div>
    </div>

    <!-- BOD -->
    <div class="form-group">
        <label class="col-sm-3 control-label">BOD (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="bod" class="form-control" placeholder="Masukkan BOD" required>
        </div>
    </div>

    <!-- COD -->
    <div class="form-group">
        <label class="col-sm-3 control-label">COD (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="cod" class="form-control" placeholder="Masukkan COD" required>
        </div>
    </div>

    <!-- TSS -->
    <div class="form-group">
        <label class="col-sm-3 control-label">TSS (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="tss" class="form-control" placeholder="Masukkan TSS" required>
        </div>
    </div>

    <!-- DO -->
    <div class="form-group">
        <label class="col-sm-3 control-label">DO (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="do" class="form-control" placeholder="Masukkan DO" required>
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
