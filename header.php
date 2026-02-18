<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Lingkungan Hidup Provinsi Kalimantan Selatan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">

    <style>
        /* Tampilan dasar */
        body, html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #f7f7f7;
        }

        /* Navbar penuh */
        .navbar {
            border-radius: 0;
            margin-bottom: 10px;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        /* Login box (pojok kanan atas) */
        .login-box {
            background-color: #fff;
            border-radius: 5px;
            padding: 8px 14px;
            margin-top: 10px;
            margin-right: 25px;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .login-box a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        /* Layout container */
        .container-fluid, .content-fluid {
            width: 100%;
            margin: 0;
            padding: 10px 20px;
        }

        h2 {
            margin-top: 10px;
        }

        footer {
            background-color: #00BFFF;
            color: #ddd;
            padding: 10px 0;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="content-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!-- Logo kiri -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="https://dlh.kalselprov.go.id/" style="padding-left:30px;">
                            💧 -  DLH Provinsi Kalimantan Selatan
                        </a>
                    </div>

                    <!-- Menu kanan (daftar & login admin) -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div class="login-box">
                                <a href="login.php">Login Admin</a>
                            </div>
                        </li>
                        <li>
                            <div class="login-box">
                                <a href="login_pegawai.php">Login Pegawai</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-fluid">