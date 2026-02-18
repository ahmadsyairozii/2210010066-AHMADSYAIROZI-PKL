<?php 
include "header-admin.php";
include "sessionlogin.php";
include "koneksi.php";

// Ambil ID waktu dari URL
$id_waktu = $_GET['id_waktu'];

// Ambil data waktu pemantauan air sungai berdasarkan ID
$sql = mysqli_query($koneksi, "
    SELECT wp.*, lp.nama_lokasi, lp.kode_lokasi, ps.nama_petugas
    FROM waktu_pemantauan wp
    JOIN lokasi_pemantauan lp ON wp.id_lokasi = lp.id_lokasi
    JOIN petugas_sampling ps ON wp.id_petugas = ps.id_petugas
    WHERE wp.id_waktu='$id_waktu'
");
if (mysqli_num_rows($sql) == 0) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ⚠️ Data Waktu Pemantauan Air Sungai tidak ditemukan!
    </div>
<?php
} else {
    $row = mysqli_fetch_assoc($sql);
}

// Proses simpan perubahan
if (isset($_POST['save'])) {
    $id_lokasi          = $_POST['id_lokasi'];
    $id_petugas         = $_POST['id_petugas'];
    $tanggal_pemantauan = $_POST['tanggal_pemantauan'];
    $jam_pemantauan     = $_POST['jam_pemantauan'];
    $periode_pemantauan = $_POST['periode_pemantauan'];

    $update = mysqli_query($koneksi, 
        "UPDATE waktu_pemantauan SET 
            id_lokasi='$id_lokasi',
            id_petugas='$id_petugas',
            tanggal_pemantauan='$tanggal_pemantauan',
            jam_pemantauan='$jam_pemantauan',
            periode_pemantauan='$periode_pemantauan'
        WHERE id_waktu='$id_waktu'"
    ) or die(mysqli_error($koneksi));

    if ($update) {
?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ✅ Data Waktu Pemantauan Air Sungai berhasil diperbarui.
        </div>
        <meta http-equiv="refresh" content="1; url=waktu_pemantauan_data.php">
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

<div class="container-fluid">
    <div class="content-fluid">
        <h2>Data Waktu Pemantauan Air Sungai &raquo; Edit Data</h2>
        <hr/>

        <form class="form-horizontal" action="" method="post">

            <!-- Lokasi Pemantauan -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Lokasi Pemantauan</label>
                <div class="col-sm-4">
                    <select name="id_lokasi" class="form-control" required>
                        <option value="">-- Pilih Lokasi --</option>
                        <?php
                        $qry = mysqli_query($koneksi, "SELECT id_lokasi, kode_lokasi, nama_lokasi FROM lokasi_pemantauan ORDER BY kode_lokasi ASC");
                        while ($data = mysqli_fetch_array($qry)) {
                            $selected = ($data['id_lokasi'] == $row['id_lokasi']) ? 'selected' : '';
                            echo "<option value='{$data['id_lokasi']}' $selected>
                                    {$data['kode_lokasi']} ({$data['nama_lokasi']})
                                  </option>";
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

            <!-- Tanggal Pemantauan -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Pemantauan</label>
                <div class="col-sm-3">
                    <input type="date" name="tanggal_pemantauan" 
                        value="<?php echo $row['tanggal_pemantauan']; ?>" 
                        class="form-control" required>
                </div>
            </div>

            <!-- Jam Pemantauan -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Jam Pemantauan</label>
                <div class="col-sm-4">
                    <input type="text" name="jam_pemantauan" 
                        value="<?php echo $row['jam_pemantauan']; ?>" 
                        class="form-control" placeholder="Masukkan Jam Pemantauan" required>
                </div>
            </div>

            <!-- Periode Pemantauan -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Periode Pemantauan</label>
                <div class="col-sm-4">
                    <input type="text" name="periode_pemantauan" 
                        value="<?php echo $row['periode_pemantauan']; ?>" 
                        class="form-control" placeholder="Masukkan Periode Pemantauan" required>
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