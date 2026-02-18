<?php 
include "header-admin.php";
include "sessionlogin.php";
include "koneksi.php";

// Ambil ID Nilai dari URL
$id_status = $_GET['id_status'];

// Ambil data status mutu berdasarkan ID
$sql = mysqli_query($koneksi, "
    SELECT sm.*, lp.kode_lokasi, wp.tanggal_pemantauan
    FROM status_mutu sm
    JOIN lokasi_pemantauan lp ON sm.id_lokasi = lp.id_lokasi
    JOIN waktu_pemantauan wp ON sm.id_waktu = wp.id_waktu
    WHERE sm.id_status='$id_status'
") or die(mysqli_error($koneksi));

if (mysqli_num_rows($sql) == 0) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ⚠️ Data Status Mutu Air Sungai tidak ditemukan!
    </div>
<?php
} else {
    $row = mysqli_fetch_assoc($sql);
}

// Proses simpan perubahan
if (isset($_POST['save'])) {
    $id_lokasi  = $_POST['id_lokasi'];
    $id_waktu   = $_POST['id_waktu'];
    $status_mutu_air  = $_POST['status_mutu_air'];
    $nilai_ip   = $_POST['nilai_ip'];

    $update = mysqli_query($koneksi, 
        "UPDATE status_mutu SET 
            id_lokasi='$id_lokasi',
            id_waktu='$id_waktu',
            status_mutu_air='$status_mutu_air',
            nilai_ip='$nilai_ip'
        WHERE id_status='$id_status'"
    ) or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data Status Mutu Air Sungai berhasil diperbarui.
        </div>
        <meta http-equiv="refresh" content="1; url=status_mutu_data.php">
<?php
    }
    else {
?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ❌ Gagal memperbarui data, silakan coba lagi.
        </div>
<?php
    }
}
?>

<div class="container-fluid">
<div class="content-fluid">
<h2>Data Status Mutu Air Sungai &raquo; Edit Data</h2>
<hr/>

<form class="form-horizontal" action="" method="post">

    <!-- Kode Lokasi -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Lokasi</label>
        <div class="col-sm-4">
            <select name="id_lokasi" class="form-control" required>
                <option value="">-- Pilih Kode Lokasi --</option>
                <?php
                $qry = mysqli_query($koneksi, "SELECT id_lokasi, kode_lokasi FROM lokasi_pemantauan ORDER BY kode_lokasi ASC");
                while ($data = mysqli_fetch_array($qry)) {
                    $selected = ($data['id_lokasi'] == $row['id_lokasi']) ? 'selected' : '';
                    echo "<option value='{$data['id_lokasi']}' $selected>{$data['kode_lokasi']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Tanggal Pemantauan -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Pemantauan</label>
        <div class="col-sm-4">
            <select name="id_waktu" class="form-control" required>
                <option value="">-- Pilih Tanggal Pemantauan --</option>
                <?php
                $qry = mysqli_query($koneksi, "SELECT id_waktu, tanggal_pemantauan FROM waktu_pemantauan ORDER BY tanggal_pemantauan ASC");
                while ($data = mysqli_fetch_array($qry)) {
                    $selected = ($data['id_waktu'] == $row['id_waktu']) ? 'selected' : '';
                    echo "<option value='{$data['id_waktu']}' $selected>{$data['tanggal_pemantauan']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Status Mutu Air Sungai -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kondisi Status Mutu Air</label>
        <div class="col-sm-4">
            <input type="text" name="status_mutu_air" value="<?php echo $row['status_mutu_air']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- Nilai Indeks Pencemar -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Nilai Indeks Pencemar</label>
        <div class="col-sm-4">
            <input type="text" name="nilai_ip" value="<?php echo $row['nilai_ip']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- Tombol -->
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
