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

<h2>Data Waktu Pemantauan Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="waktu_pemantauan_add.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Tambah Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Kode Lokasi</th>
            <th>Nama Lokasi</th>
            <th>Nama Petugas</th>
            <th>Tanggal Pemantauan</th>
            <th>Jam Pemantauan</th>
            <th>Periode Pemantauan</th>
            <th>Tools</th>
        </tr>

        <?php
        // ✅ QUERY JOIN YANG SUDAH BENAR (TIDAK AKAN DUPLIKAT)
        $mySql = "
            SELECT 
                wp.id_waktu, 
                lp.kode_lokasi, 
                lp.nama_lokasi,
                ps.nama_petugas,
                wp.tanggal_pemantauan, 
                wp.jam_pemantauan, 
                wp.periode_pemantauan
            FROM waktu_pemantauan wp
            LEFT JOIN lokasi_pemantauan lp ON wp.id_lokasi = lp.id_lokasi
            LEFT JOIN petugas_sampling ps ON wp.id_petugas = ps.id_petugas
            ORDER BY wp.id_waktu DESC
        ";
        
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo htmlspecialchars($kolomData['kode_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['nama_lokasi']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['nama_petugas']); ?></td>
            <td>
                <?php echo date("d-m-Y", strtotime($kolomData['tanggal_pemantauan'])); ?>
            </td>
            <td><?php echo htmlspecialchars($kolomData['jam_pemantauan']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['periode_pemantauan']); ?></td>
            <td>
                <a href="waktu_pemantauan_edit.php?id_waktu=<?php echo $kolomData['id_waktu'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="waktu_pemantauan_delete.php?id_waktu=<?php echo $kolomData['id_waktu'];?>" 
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
