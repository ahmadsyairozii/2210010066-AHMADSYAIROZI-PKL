<?php
include "header-admin.php"; 
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

if (isset($_POST['add'])) {
    $nama_petugas   = $_POST['nama_petugas'];
    $email          = $_POST['email'];
    $no_hp          = $_POST['no_hp'];
    $alamat         = $_POST['alamat'];

    // Cek apakah nama_petugas sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM petugas_sampling WHERE nama_petugas='$nama_petugas'");
    if (mysqli_num_rows($cek)) {
?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ⚠️ Kode Lokasi sudah ada!
        </div>
<?php
    } else {
        $insert = mysqli_query($koneksi, 
            "INSERT INTO petugas_sampling (nama_petugas, email, no_hp, alamat)
             VALUES ('$nama_petugas', '$email', '$no_hp', '$alamat')")
            or die(mysqli_error($koneksi));

        if ($insert) {
?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ✅ Data lokasi berhasil disimpan!
            </div>
            <!-- Redirect otomatis ke halaman data Petugas Sampling -->
            <meta http-equiv='refresh' content='1; url=petugas_sampling_data.php'>
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

<h2>Data Petugas Sampling Air Sungai &raquo; Tambah Data</h2> 
<hr />
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Petugas</label> 
        <div class="col-sm-3">
            <input type="text" name="nama_petugas" class="form-control" maxlength="30" placeholder="Isi Nama Lengkap Serta Gelar" required>
        </div> 
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Email Petugas</label>
        <div class="col-sm-5">
            <input type="text" name="email" class="form-control" placeholder="Masukkan Email Petugas" required>
        </div> 
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Nomor HP/WA</label>
        <div class="col-sm-5">
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan Nomor HP/WA" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Alamat Petugas</label>
        <div class="col-sm-4">
            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Petugas" required>
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