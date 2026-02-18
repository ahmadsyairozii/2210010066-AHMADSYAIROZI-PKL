<?php
include ('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $query = mysqli_query($koneksi, $sql) or die("Error database: " . mysqli_error($koneksi));

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = 1;
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama']     = $row['nama_lengkap'];
            $_SESSION['role']     = $row['role'];

            header('Location: header-admin.php');
            exit;
        } else {
            $error = "⚠️ Username atau password salah!";
        }
    } else {
        $error = "⚠️ Akun tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Admin DLH</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #00ffc3ff, #0099ffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
        }

        .login-card {
            width: 400px;
            background: #fff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            animation: fadeIn 0.6s ease-in-out;
        }

        .login-title {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }

        .login-subtitle {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-bottom: 25px;
        }

        label {
            font-weight: 500;
            color: #444;
            margin-bottom: 6px;
        }

        .form-control {
            height: 45px;
            border-radius: 10px;
            padding-left: 12px;
            margin-bottom: 20px; /* jarak antar field box */
        }

        .btn-primary, .btn-secondary {
            width: 100%;
            height: 45px;
            border-radius: 30px;
            font-size: 15px;
        }

        .btn-secondary {
            margin-top: 10px; /* jarak tombol masuk & reset */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-15px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="login-title">💧- Login Admin DLH</h3>
        <p class="login-subtitle">Masukkan Username dan Password Anda</p>
        <hr style="margin-bottom: 25px;">

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label for="username">Username</label>
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control"
                   placeholder="Masukkan Username"
                   required autofocus>

            <label for="password">Password</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   placeholder="Masukkan Password"
                   required>

            <button type="submit" class="btn btn-primary">Masuk</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

        </form>
    </div>

</body>
</html>
