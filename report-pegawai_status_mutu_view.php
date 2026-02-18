<?php
include('header-admin.php');
include('koneksi.php');
include('sessionlogin.php');

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

<h2>Laporan Status Mutu Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="report_status_mutu.php" class="btn btn-success btn-sm">
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
            <th>Tanggal Pemantauan</th>
            <th>Nilai Indeks Pencemar</th>
            <th>Status Mutu Air</th>
        </tr>

        <?php
        // Ambil data dari status_mutu + relasi ke tabel lokasi_pemantauan & tabel waktu_pemantauan
        $query = "
            SELECT 
                sm.id_status,
                lp.kode_lokasi,
                lp.nama_lokasi,
                wp.tanggal_pemantauan,
                sm.status_mutu_air,
                sm.nilai_ip
            FROM status_mutu sm
            JOIN lokasi_pemantauan lp ON sm.id_lokasi = lp.id_lokasi
            JOIN waktu_pemantauan wp ON sm.id_waktu = wp.id_waktu
            ORDER BY lp.kode_lokasi DESC
        ";

        $result = mysqli_query($koneksi, $query) or die('Query error: ' . mysqli_error($koneksi));
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['tanggal_pemantauan']); ?></td>
            <td><?php echo htmlspecialchars($row['nilai_ip']); ?></td>
            <td><?php echo htmlspecialchars($row['status_mutu_air']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>