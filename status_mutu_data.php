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

<h2>Data Status Mutu Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="status_mutu_add.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Tambah Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Kode Lokasi</th>
            <th>Tanggal Pemantauan</th>
            <th>Kondisi Status Mutu Air</th>
            <th>Nilai Indeks Pencemar</th>
            <th>Tools</th>
        </tr>

        <?php
        // Ambil data dari tabel status_mutu dan gabung dengan tabel lokasi_pemantauan dan waktu_pemantauan
        $mySql = "
            SELECT 
                sm.id_status,
                wp.tanggal_pemantauan,
                lp.kode_lokasi,
                sm.status_mutu_air,
                sm.nilai_ip
            FROM status_mutu sm
            LEFT JOIN lokasi_pemantauan lp ON sm.id_lokasi = lp.id_lokasi
            LEFT JOIN waktu_pemantauan wp ON sm.id_waktu = wp.id_waktu
            ORDER BY sm.id_status DESC";
        
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo htmlspecialchars($kolomData['kode_lokasi']); ?></td>
            <td>
                <?php echo date("d-m-Y", strtotime($kolomData['tanggal_pemantauan'])); ?>
            </td>
            <td><?php echo htmlspecialchars($kolomData['status_mutu_air']); ?></td>
            <td><?php echo htmlspecialchars($kolomData['nilai_ip']); ?></td>
            <td>
                <a href="status_mutu_edit.php?id_status=<?php echo $kolomData['id_status'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="status_mutu_delete.php?id_status=<?php echo $kolomData['id_status'];?>" 
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