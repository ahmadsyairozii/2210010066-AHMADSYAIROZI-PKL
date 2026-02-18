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

<h2>Laporan Pembagian Tugas Pemantauan</h2>
<hr/>

<div class="form-group">
    <a href="report_pembagian_tugas_pantau.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-download-alt"></span> Cetak Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Nomor HP</th>
            <th>Tanggal Pemantauan</th>
            <th>Kode Lokasi</th>
            <th>Nama Lokasi</th>
            <th>Alamat Lokasi</th>
        </tr>

        <?php
        // Ambil data dari waktu_pemantauan dan relasi ke tabel petugas_sampling dan tabel lokasi_pemantauan
        $query = "
            SELECT 
                wp.id_waktu,
                ps.nama_petugas,
                ps.no_hp,
                wp.tanggal_pemantauan,
                lp.kode_lokasi,
                lp.nama_lokasi,
                lp.alamat_lokasi
            FROM waktu_pemantauan wp
            JOIN lokasi_pemantauan lp ON wp.id_lokasi = lp.id_lokasi
            JOIN petugas_sampling ps ON wp.id_petugas = ps.id_petugas
            ORDER BY ps.nama_petugas DESC
        ";

        $result = mysqli_query($koneksi, $query) or die('Query error: ' . mysqli_error($koneksi));
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nama_petugas']); ?></td>
            <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal_pemantauan']); ?></td>
            <td><?php echo htmlspecialchars($row['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat_lokasi']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>