<?php 
include "header-admin.php";
include "sessionlogin.php";
include "koneksi.php";

// Ambil ID Nilai dari URL
$id_nilai = $_GET['id_nilai'];

// Ambil data nilai pemantauan berdasarkan ID
$sql = mysqli_query($koneksi, "
    SELECT np.*, lp.kode_lokasi, ps.nama_petugas
    FROM nilai_pemantauan np
    JOIN lokasi_pemantauan lp ON np.id_lokasi = lp.id_lokasi
    JOIN petugas_sampling ps ON np.id_petugas = ps.id_petugas
    WHERE np.id_nilai='$id_nilai'
") or die(mysqli_error($koneksi));

if (mysqli_num_rows($sql) == 0) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ⚠️ Data Nilai Pemantauan Air Sungai tidak ditemukan!
    </div>
<?php
} else {
    $row = mysqli_fetch_assoc($sql);
}

// Proses simpan perubahan
if (isset($_POST['save'])) {
    $id_lokasi  = $_POST['id_lokasi'];
    $id_petugas = $_POST['id_petugas'];
    $debit_air  = $_POST['debit_air'];
    $ph         = $_POST['ph'];
    $bod        = $_POST['bod'];
    $cod        = $_POST['cod'];
    $tss        = $_POST['tss'];
    $do         = $_POST['do'];

    $update = mysqli_query($koneksi, 
        "UPDATE nilai_pemantauan SET 
            id_lokasi='$id_lokasi',
            id_petugas='$id_petugas',
            debit_air='$debit_air',
            ph='$ph',
            bod='$bod',
            cod='$cod',
            tss='$tss',
            do='$do'
        WHERE id_nilai='$id_nilai'"
    ) or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data Nilai Pemantauan Air Sungai berhasil diperbarui.
        </div>
        <meta http-equiv="refresh" content="1; url=nilai_pemantauan_data.php">
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
<h2>Data Nilai Pemantauan Air Sungai &raquo; Edit Data</h2>
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
                            echo "<option value='{$data['id_petugas']}' $selected>
                                    {$data['nama_petugas']}
                                  </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

    <!-- Debit Air -->
    <div class="form-group">
        <label class="col-sm-3 control-label">Debit Air (m3/s)</label>
        <div class="col-sm-4">
            <input type="text" name="debit_air" value="<?php echo $row['debit_air']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- pH -->
    <div class="form-group">
        <label class="col-sm-3 control-label">pH</label>
        <div class="col-sm-4">
            <input type="text" name="ph" value="<?php echo $row['ph']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- BOD -->
    <div class="form-group">
        <label class="col-sm-3 control-label">BOD (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="bod" value="<?php echo $row['bod']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- COD -->
    <div class="form-group">
        <label class="col-sm-3 control-label">COD (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="cod" value="<?php echo $row['cod']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- TSS -->
    <div class="form-group">
        <label class="col-sm-3 control-label">TSS (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="tss" value="<?php echo $row['tss']; ?>" 
                class="form-control" required>
        </div>
    </div>

    <!-- DO -->
    <div class="form-group">
        <label class="col-sm-3 control-label">DO (mg/L)</label>
        <div class="col-sm-4">
            <input type="text" name="do" value="<?php echo $row['do']; ?>" 
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
