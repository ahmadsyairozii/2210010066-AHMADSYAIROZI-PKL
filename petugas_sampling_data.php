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

<h2>Data Petugas Sampling</h2>
<hr/>

<div class="form-group">
    <a href="petugas_sampling_add.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Tambah Data
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Nomor HP Petugas</th>
            <th>Email Petugas</th>
            <th>Alamat Petugas</th>
            <th>Tools</th>
        </tr>

        <?php
        $mySql = "SELECT * FROM petugas_sampling ORDER BY id_petugas ASC";
        $myQry = mysqli_query($koneksi, $mySql) or die("Query salah: " . mysqli_error($koneksi));
        $nomor = 1;
        while ($kolomData = mysqli_fetch_array($myQry)) {
        ?>   
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $kolomData['nama_petugas']; ?></td>
            <td><?php echo $kolomData['no_hp']; ?></td>
            <td><?php echo $kolomData['email']; ?></td>
            <td><?php echo $kolomData['alamat']; ?></td>
            <td>
                <a href="petugas_sampling_edit.php?id_petugas=<?php echo $kolomData['id_petugas'];?>" 
                   title="Edit Data" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a href="petugas_sampling_delete.php?id_petugas=<?php echo $kolomData['id_petugas'];?>" 
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