<?php
include "header-admin.php"; 
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

if (isset($_POST['add'])) {
    $kode_lokasi     = $_POST['kode_lokasi'];
    $nama_lokasi     = $_POST['nama_lokasi'];
    $alamat_lokasi   = $_POST['alamat_lokasi'];
    $kabupaten_kota  = $_POST['kabupaten_kota'];
    $provinsi        = $_POST['provinsi'];
    $latitude        = $_POST['latitude'];
    $longitude       = $_POST['longitude'];

    // Cek apakah kode lokasi sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM lokasi_pemantauan WHERE kode_lokasi='$kode_lokasi'");
    if (mysqli_num_rows($cek)) {
?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ⚠️ Kode Lokasi sudah ada!
        </div>
<?php
    } else {
        $insert = mysqli_query($koneksi, 
            "INSERT INTO lokasi_pemantauan (kode_lokasi, nama_lokasi, alamat_lokasi, kabupaten_kota, provinsi, latitude, longitude)
             VALUES ('$kode_lokasi', '$nama_lokasi', '$alamat_lokasi', '$kabupaten_kota', '$provinsi', '$latitude', '$longitude')")
            or die(mysqli_error($koneksi));

        if ($insert) {
?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data lokasi berhasil disimpan!
            </div>
            <!-- Redirect otomatis ke halaman data lokasi -->
            <meta http-equiv='refresh' content='1; url=lokasi_pemantauan_data.php'>
<?php
        } else {
?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ❌ Ups, data lokasi gagal disimpan!
            </div>
<?php
        }
    }
}
?>

<h2>Data Lokasi Pemantauan Air Sungai &raquo; Tambah Data</h2> 
<hr />
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Lokasi</label> 
        <div class="col-sm-3">
            <input type="text" name="kode_lokasi" class="form-control" maxlength="30" placeholder="Misal: U1-KS-72-004" required>
        </div> 
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Lokasi</label>
        <div class="col-sm-5">
            <input type="text" name="nama_lokasi" class="form-control" placeholder="Nama Lokasi Pemantauan" required>
        </div> 
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Alamat Lokasi</label>
        <div class="col-sm-5">
            <textarea name="alamat_lokasi" class="form-control" placeholder="Alamat Lokasi" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Kabupaten/Kota</label>
        <div class="col-sm-4">
            <input type="text" name="kabupaten_kota" class="form-control" placeholder="Kabupaten Hulu Sungai Selatan / Kota Banjarbaru" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Provinsi</label>
        <div class="col-sm-4">
            <input type="text" name="provinsi" class="form-control" value="Kalimantan Selatan" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Latitude</label>
        <div class="col-sm-3">
            <input type="text" name="latitude" class="form-control" placeholder="Misal: -3.458667" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Longitude</label>
        <div class="col-sm-3">
            <input type="text" name="longitude" class="form-control" placeholder="Misal: 114.842944" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
            <button type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan">Simpan</button>
            <button type="reset" class="btn btn-sm btn-warning" value="Reset">Reset</button>
            <button class="btn btn-sm btn-danger" onclick="history.back()">Kembali</button>
        </div>
    </div>
</form>

<?php include "footer.php"; ?>