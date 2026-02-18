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

<h2>Data Lokasi Pemantauan Air Sungai</h2>
<hr/>

<div class="form-group">
    <a href="lokasi_pemantauan_add.php" class="btn btn-success btn-sm">
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
            <th>Alamat Lokasi</th>
            <th>Kabupaten/Kota</th>
            <th>Provinsi</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Tools</th>
        </tr>

        <?php
        $mySql = "SELECT * FROM lokasi_pemantauan ORDER BY id_lokasi ASC";
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $kolomData['kode_lokasi']; ?></td>
            <td><?php echo $kolomData['nama_lokasi']; ?></td>
            <td><?php echo $kolomData['alamat_lokasi']; ?></td>
            <td><?php echo $kolomData['kabupaten_kota']; ?></td>
            <td><?php echo $kolomData['provinsi']; ?></td>
            <td><?php echo $kolomData['latitude']; ?></td>
            <td><?php echo $kolomData['longitude']; ?></td>
            <td>
                <a href="lokasi_pemantauan_edit.php?id_lokasi=<?php echo $kolomData['id_lokasi'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="lokasi_pemantauan_delete.php?id_lokasi=<?php echo $kolomData['id_lokasi'];?>" 
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