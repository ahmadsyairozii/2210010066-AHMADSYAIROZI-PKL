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

<h2>Data Observasi Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="observasi_sungai_add.php" class="btn btn-success btn-sm">
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
            <th>pH</th>
            <th>Status Mutu Air</th>
            <th>Kategori</th>
            <th>Level</th>
            <th>SHU</th>
            <th>Tools</th>
        </tr>

        <?php
        // Ambil data dari tabel observasi_sungai dan gabung dengan tabel petugas sampling, lokasi_pemantauan, nilai_pemantauan, dan status_mutu
        $mySql = "
            SELECT 
                os.id_observasi, 
                ps.nama_petugas, 
                lp.kode_lokasi,
                np.ph,
                sm.status_mutu_air,
                os.kategori, 
                os.level, 
                os.shu
            FROM observasi_sungai os
            LEFT JOIN petugas_sampling ps ON os.id_petugas = ps.id_petugas
            LEFT JOIN lokasi_pemantauan lp ON os.id_lokasi = lp.id_lokasi
            LEFT JOIN nilai_pemantauan np ON os.id_nilai = np.id_nilai
            LEFT JOIN status_mutu sm ON os.id_status = sm.id_status
            ORDER BY os.id_observasi DESC";
        
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo htmlspecialchars($kolomData['nama_petugas']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['ph']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['status_mutu_air']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['kategori']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['level']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['shu']); ?></td>
            <td>
                <a href="observasi_sungai_edit.php?id_observasi=<?php echo $kolomData['id_observasi'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="observasi_sungai_delete.php?id_observasi=<?php echo $kolomData['id_observasi'];?>" 
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