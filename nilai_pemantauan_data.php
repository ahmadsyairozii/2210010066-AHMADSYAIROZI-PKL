<?php
include ('header-admin.php');
include ('koneksi.php');
include "sessionlogin.php";
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
    margin-left: 30px;
}
</style>

<h2>Data Nilai Pemantauan Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="nilai_pemantauan_add.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Tambah Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Kode Lokasi</th>
            <th>Debit Air (m3/s)</th>
            <th>pH</th>
            <th>BOD (mg/L)</th>
            <th>COD (mg/L)</th>
            <th>TSS (mg/L)</th>
            <th>DO (mg/L)</th>
            <th>Tools</th>
        </tr>

        <?php
        // Ambil data dari tabel nilai_pemantauan dan relasi ke tabel lokasi_pemantauan dan petugas_sampling
        $mySql = "
            SELECT 
                np.id_nilai,
                ps.nama_petugas,
                lp.kode_lokasi,
                np.debit_air,
                np.ph,
                np.bod,
                np.cod,
                np.tss,
                np.do
            FROM nilai_pemantauan np
            LEFT JOIN lokasi_pemantauan lp ON np.id_lokasi = lp.id_lokasi
            LEFT JOIN petugas_sampling ps ON np.id_petugas = ps.id_petugas
            ORDER BY np.id_nilai DESC";
        
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo htmlspecialchars($kolomData['nama_petugas']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['debit_air']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['ph']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['bod']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['cod']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['tss']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['do']); ?></td>
            <td>
                <a href="nilai_pemantauan_edit.php?id_nilai=<?php echo $kolomData['id_nilai'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="nilai_pemantauan_delete.php?id_nilai=<?php echo $kolomData['id_nilai'];?>" 
                   title="Hapus Data" onclick="return confirm('Yakin ingin menghapus data ini?')" 
                   class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>     
        <?php } ?>
    </table>
</div>

<?php include ('footer.php'); ?>