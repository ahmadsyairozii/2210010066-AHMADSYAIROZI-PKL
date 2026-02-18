<?php
include('header-pegawai.php');
include('koneksi.php');
include('sessionlogin_pegawai.php');
?>   

<style>
body {
    background-color: #f5f5f5;
}
.container, .table-responsive {
    width: 100%;
    max-width: 100%;
}
.table {
    width: 98%;
    margin: auto;
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    margin-top: 30px;
    font-weight: 600;
}
hr {
    border: 1px solid #ddd;
    width: 95%;
}
.form-group {
    margin-left: 40px;
}
</style>

<h2>Laporan Lokasi Lengkap Pemantauan Petugas</h2>
<hr/>

<div class="form-group">
    <a href="report_lokasi_lengkap_pemantauan_petugas.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-download-alt"></span> Cetak Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Kode Lokasi</th>
            <th>Nama Lokasi</th>
            <th>Alamat Lokasi</th>
            <th>Kabupaten/Kota</th>
            <th>Provinsi</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>

        <?php
        // Ambil data dari lokasi_pemantauan
        $query = "
            SELECT 
                lp.kode_lokasi,
                lp.nama_lokasi,
                lp.alamat_lokasi,
                lp.kabupaten_kota,
                lp.provinsi,
                lp.latitude,
                lp.longitude
            FROM lokasi_pemantauan lp
            ORDER BY lp.nama_lokasi ASC
        ";

        $result = mysqli_query($koneksi, $query) or die('Query error: ' . mysqli_error($koneksi));
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['kabupaten_kota']); ?></td>
            <td><?php echo htmlspecialchars($row['provinsi']); ?></td>
            <td><?php echo htmlspecialchars($row['latitude']); ?></td>
            <td><?php echo htmlspecialchars($row['longitude']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>