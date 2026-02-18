<?php 
include "header-admin.php";
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

$id_lokasi = $_GET['id_lokasi'];
$sql = mysqli_query($koneksi, "SELECT * FROM lokasi_pemantauan WHERE id_lokasi='$id_lokasi'");
if (mysqli_num_rows($sql) == 0) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ⚠️ Data lokasi tidak ditemukan!
    </div>
<?php
} else {
    $row = mysqli_fetch_assoc($sql);
}

// Proses Simpan Perubahan
if (isset($_POST['save'])) {
    $kode_lokasi     = $_POST['kode_lokasi'];
    $nama_lokasi     = $_POST['nama_lokasi'];
    $alamat_lokasi   = $_POST['alamat_lokasi'];
    $kabupaten_kota  = $_POST['kabupaten_kota'];
    $provinsi        = $_POST['provinsi'];
    $latitude        = $_POST['latitude'];
    $longitude       = $_POST['longitude'];

    $update = mysqli_query($koneksi, 
        "UPDATE lokasi_pemantauan SET 
            kode_lokasi='$kode_lokasi',
            nama_lokasi='$nama_lokasi',
            alamat_lokasi='$alamat_lokasi',
            kabupaten_kota='$kabupaten_kota',
            provinsi='$provinsi',
            latitude='$latitude',
            longitude='$longitude'
        WHERE id_lokasi='$id_lokasi'") 
        or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data lokasi berhasil diperbarui.
        </div>
        <!-- Redirect otomatis ke halaman data Lokasi Pemantauan -->
            <meta http-equiv='refresh' content='1; url=lokasi_pemantauan_data.php'>
<?php
    } else {
?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ❌ Gagal memperbarui data, silakan coba lagi.
        </div>
<?php
    }
}
?>

<!-- Full width -->
<div class="container-fluid">
    <div class="content-fluid">
        <h2>Data Lokasi Pemantauan Air Sungai &raquo; Edit Data</h2>
        <hr/>

        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Kode Lokasi</label>
                <div class="col-sm-3">
                    <input type="text" name="kode_lokasi" value="<?php echo $row['kode_lokasi']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Lokasi</label>
                <div class="col-sm-5">
                    <input type="text" name="nama_lokasi" value="<?php echo $row['nama_lokasi']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat Lokasi</label>
                <div class="col-sm-5">
                    <textarea name="alamat_lokasi" class="form-control" required><?php echo $row['alamat_lokasi']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Kabupaten/Kota</label>
                <div class="col-sm-4">
                    <input type="text" name="kabupaten_kota" value="<?php echo $row['kabupaten_kota']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Provinsi</label>
                <div class="col-sm-4">
                    <input type="text" name="provinsi" value="<?php echo $row['provinsi']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Latitude</label>
                <div class="col-sm-3">
                    <input type="text" name="latitude" value="<?php echo $row['latitude']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Longitude</label>
                <div class="col-sm-3">
                    <input type="text" name="longitude" value="<?php echo $row['longitude']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-6">
                    <button type="submit" name="save" class="btn btn-sm btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                    <button class="btn btn-sm btn-danger" onclick="history.back()">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>