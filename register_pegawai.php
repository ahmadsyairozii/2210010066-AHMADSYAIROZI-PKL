<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $pass     = $_POST['password'];
    $role     = 'pegawai'; // otomatis pegawai

    // enkripsi password pakai bcrypt
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // cek apakah username sudah digunakan
    $cek = mysqli_query($koneksi, "SELECT * FROM users_pegawai WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "⚠️ Username sudah terpakai!";
    } else {
        $sql = "INSERT INTO users_pegawai (username, password, nama_lengkap, role)
                VALUES ('$username', '$hash', '$nama', '$role')";
        if (mysqli_query($koneksi, $sql)) {
            $success = "✅ Akun Pegawai berhasil dibuat!";
        } else {
            $error = "❌ Gagal membuat Akun Pegawai: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Akun Pegawai PPKLH</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            margin-top: 100px;
            max-width: 400px;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Buat Akun Pegawai PPKLH</h2>
        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input name="nama_lengkap" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Buat Akun Pegawai</button>
        </form>
        <br>
        <?php
        if (isset($error)) echo "<div class='alert alert-danger'>$error</div>";
        if (isset($success)) echo "<div class='alert alert-success'>$success</div>";
        ?>
    </div>
</body>
</html>