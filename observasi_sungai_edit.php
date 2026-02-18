<?php 
include "header-admin.php";
include "sessionlogin.php";
include "koneksi.php";

// Ambil ID Observasi dari URL
$id_observasi = $_GET['id_observasi'];

// Ambil data observasi berdasarkan ID
$sql = mysqli_query($koneksi, "
    SELECT os.*, ps.nama_petugas, lp.kode_lokasi, np.ph, sm.status_mutu_air
    FROM observasi_sungai os
    JOIN petugas_sampling ps ON os.id_petugas = ps.id_petugas
    JOIN lokasi_pemantauan lp ON os.id_lokasi = lp.id_lokasi
    JOIN nilai_pemantauan np ON os.id_nilai = np.id_nilai
    JOIN status_mutu sm ON os.id_status = sm.id_status
    WHERE os.id_observasi='$id_observasi'
") or die(mysqli_error($koneksi));

if (mysqli_num_rows($sql) == 0) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ⚠️ Data Observasi Air Sungai tidak ditemukan!
    </div>
<?php
} else {
    $row = mysqli_fetch_assoc($sql);
}

// Proses simpan perubahan
if (isset($_POST['save'])) {
    $id_petugas  = $_POST['id_petugas'];
    $id_lokasi   = $_POST['id_lokasi'];
    $id_nilai    = $_POST['id_nilai'];
    $id_status   = $_POST['id_status'];
    $kategori    = $_POST['kategori'];
    $level       = $_POST['level'];
    $shu         = $_POST['shu'];

    $update = mysqli_query($koneksi, 
        "UPDATE observasi_sungai SET 
            id_petugas='$id_petugas',
            id_lokasi='$id_lokasi',
            id_nilai='$id_nilai',
            id_status='$id_status',
            kategori='$kategori',
            level='$level',
            shu='$shu'
         WHERE id_observasi='$id_observasi'"
    ) or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data Observasi Air Sungai berhasil diperbarui.
        </div>
        <meta http-equiv="refresh" content="1; url=observasi_sungai_data.php">
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
<h2>Data Observasi Air Sungai &raquo; Edit Data</h2>
<hr/>

<form class="form-horizontal" action="" method="post">

    <!-- Nama Petugas -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Petugas</label>
        <div class="col-sm-4">
            <select name="id_petugas" class="form-control" required>
                <option value="">-- Pilih Nama Petugas --</option>
                <?php
                $qry = mysqli_query($koneksi, "SELECT id_petugas, nama_petugas FROM petugas_sampling ORDER BY nama_petugas ASC");
                while ($data = mysqli_fetch_array($qry)) {
                    $selected = ($data['id_petugas'] == $row['id_petugas']) ? 'selected' : '';
                    echo "<option value='{$data['id_petugas']}' $selected>{$data['nama_petugas']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

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

    <!-- pH -->
    <div class="form-group">
        <label class="col-sm-3 control-label">pH</label>
        <div class="col-sm-4">
            <select name="id_nilai" class="form-control" required>
                <option value="">-- Pilih pH --</option>
                <?php
                $qry = mysqli_query($koneksi, "SELECT id_nilai, ph FROM nilai_pemantauan ORDER BY ph ASC");
                while ($data = mysqli_fetch_array($qry)) {
                    $selected = ($data['id_nilai'] == $row['id_nilai']) ? 'selected' : '';
                    echo "<option value='{$data['id_nilai']}' $selected>{$data['ph']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Status Mutu Air -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Status Mutu Air</label>
        <div class="col-sm-4">
            <select name="id_status" class="form-control" required>
                <option value="">-- Pilih Status Mutu Air --</option>
                <?php
                $qry = mysqli_query($koneksi, "SELECT id_status, status_mutu_air FROM status_mutu ORDER BY status_mutu_air ASC");
                while ($data = mysqli_fetch_array($qry)) {
                    $selected = ($data['id_status'] == $row['id_status']) ? 'selected' : '';
                    echo "<option value='{$data['id_status']}' $selected>{$data['status_mutu_air']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Kategori -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Kategori</label>
        <div class="col-sm-4">
            <input type="text" name="kategori" value="<?php echo $row['kategori']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- Level -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Level</label>
        <div class="col-sm-4">
            <input type="text" name="level" value="<?php echo $row['level']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- SHU -->
    <div class="form-group">
        <label class="col-sm-3 control-label">SHU</label>
        <div class="col-sm-4">
            <input type="text" name="shu" value="<?php echo $row['shu']; ?>" 
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
