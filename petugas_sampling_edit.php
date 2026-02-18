<?php 
include "header-admin.php";
include "sessionlogin.php";
?>
<?php
include "koneksi.php";

$id_petugas = $_GET['id_petugas'];
$sql = mysqli_query($koneksi, "SELECT * FROM petugas_sampling WHERE id_petugas='$id_petugas'");
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
    $nama_petugas   = $_POST['nama_petugas'];
    $email          = $_POST['email'];
    $no_hp          = $_POST['no_hp'];
    $alamat         = $_POST['alamat'];

    $update = mysqli_query($koneksi, 
        "UPDATE petugas_sampling SET 
            nama_petugas='$nama_petugas',
            email='$email',
            no_hp='$no_hp',
            alamat='$alamat'
        WHERE id_petugas='$id_petugas'") 
        or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data Petugas Sampling berhasil diperbarui.
        </div>
        <!-- Redirect otomatis ke halaman data Petugas Sampling -->
            <meta http-equiv='refresh' content='1; url=petugas_sampling_data.php'>
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
        <h2>Data Petugas Sampling &raquo; Edit Data</h2>
        <hr/>

        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Petugas</label>
                <div class="col-sm-3">
                    <input type="text" name="nama_petugas" value="<?php echo $row['nama_petugas']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Email Petugas</label>
                <div class="col-sm-5">
                    <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Nomor HP Petugas</label>
                <div class="col-sm-5">
                    <input type="text" name="no_hp" value="<?php echo $row['no_hp']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat Petugas</label>
                <div class="col-sm-4">
                    <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>" class="form-control" required>
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