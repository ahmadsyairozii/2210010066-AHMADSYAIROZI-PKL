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

<h2>Laporan Rekapitulasi Pemantauan Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="report_rekapitulasi_pemantauan_air_sungai.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-download-alt"></span> Cetak Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Kode Lokasi</th>
            <th>Nama Lokasi</th>
            <th>Kategori</th>
            <th>Level</th>
            <th>SHU</th>
            <th>pH</th>
            <th>Nilai IP</th>
            <th>Status Mutu Air</th>
        </tr>

        <?php
        // Ambil data dari observasi_sungai + relasi ke petugas_sampling, lokasi_pemantauan, nilai_pemantauan, dan status_mutu
        $query = "
            SELECT 
                os.id_observasi,
                ps.nama_petugas,    
                lp.kode_lokasi,
                lp.nama_lokasi,
                os.kategori,
                os.level,
                os.shu,
                np.ph,
                sm.nilai_ip,
                sm.status_mutu_air
            FROM observasi_sungai os
            JOIN petugas_sampling ps ON os.id_petugas = ps.id_petugas
            JOIN lokasi_pemantauan lp ON os.id_lokasi = lp.id_lokasi
            JOIN nilai_pemantauan np ON os.id_nilai = np.id_nilai
            JOIN status_mutu sm ON os.id_status = sm.id_status
            ORDER BY ps.nama_petugas ASC
        ";

        $result = mysqli_query($koneksi, $query) or die('Query error: ' . mysqli_error($koneksi));
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nama_petugas']); ?></td>
            <td><?php echo htmlspecialchars($row['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($row['kategori']); ?></td>
            <td><?php echo htmlspecialchars($row['level']); ?></td>
            <td><?php echo htmlspecialchars($row['shu']); ?></td>
            <td><?php echo htmlspecialchars($row['ph']); ?></td>
            <td><?php echo htmlspecialchars($row['nilai_ip']); ?></td>
            <td><?php echo htmlspecialchars($row['status_mutu_air']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>