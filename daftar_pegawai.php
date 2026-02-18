<?php
include('header-admin.php');
include('koneksi.php');
?>

<style>
body {
    background-color: #f5f5f5;
}
.table {
    width: 98%;
    margin: 20px auto;
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

<h2>Data User Pegawai Bidang PPKLH</h2>
<hr/>

<div class="form-group">
    <a href="register_pegawai.php" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Tambah Akun Pegawai
    </a>
</div>

<br/>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Role</th>
            <th>Tanggal Dibuat</th>
            <th>Tools</th>
        </tr>

        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM users_pegawai ORDER BY id_user ASC") or die("Query error: " . mysqli_error($koneksi));
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($data['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($data['username']); ?></td>
            <td><?php echo ucfirst($data['role']); ?></td>
            <td><?php echo $data['created_at']; ?></td>
            <td>
                <a href="daftar_pegawai_delete.php?id_user=<?php echo $data['id_user']; ?>" 
                   class="btn btn-danger btn-sm" 
                   title="Hapus" onclick="return confirm('Yakin ingin menghapus Akun Pegawai ini?')">
                   <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('footer.php'); ?>