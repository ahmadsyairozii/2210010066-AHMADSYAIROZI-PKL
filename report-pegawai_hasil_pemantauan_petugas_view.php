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

<h2>Laporan Hasil Pemantauan Petugas Sampling</h2>
<hr/>

<div class="form-group">
    <a href="report_hasil_pemantauan_petugas.php" class="btn btn-success btn-sm">
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
            <th>Debit Air</th>
            <th>pH</th>
            <th>BOD</th>
            <th>COD</th>
            <th>TSS</th>
            <th>DO</th>
        </tr>

        <?php
        // Ambil data dari nilai_pemantauan + relasi ke petugas_sampling & tabel lokasi_pemantauan
        $query = "
            SELECT 
                np.id_nilai,
                ps.nama_petugas,
                lp.kode_lokasi,
                lp.nama_lokasi,
                np.debit_air,
                np.ph,
                np.bod,
                np.cod,
                np.tss,
                np.do
            FROM nilai_pemantauan np
            JOIN petugas_sampling ps ON np.id_petugas = ps.id_petugas
            JOIN lokasi_pemantauan lp ON np.id_lokasi = lp.id_lokasi
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
            <td><?php echo htmlspecialchars($row['debit_air']); ?></td>
            <td><?php echo htmlspecialchars($row['ph']); ?></td>
            <td><?php echo htmlspecialchars($row['bod']); ?></td>
            <td><?php echo htmlspecialchars($row['cod']); ?></td>
            <td><?php echo htmlspecialchars($row['tss']); ?></td>
            <td><?php echo htmlspecialchars($row['do']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>