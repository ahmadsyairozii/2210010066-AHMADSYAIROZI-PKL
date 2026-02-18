<?php
include('koneksi.php');
include('library.php');
// 🔒 Hanya admin yang boleh masuk area ini
include('sessionlogin.php');
?>

<html lang="en">
<head>
    <title>Admin | Sistem Informasi Pemantauan Data Air Sungai Kalimantan Selatan DLH</title>
    <link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>
        body, html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .navbar {
            border-radius: 0;
            margin-bottom: 10px;
        }

        .navbar-inverse .navbar-nav > li > a {
            color: #fff;
        }

        .navbar-inverse .navbar-nav > li > a:hover {
            background-color: #337ab7;
            color: #fff;
        }

        /* Dropdown Hover Aktif */
        .navbar-nav > li:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            background-color: #222;
            border-radius: 0;
            border: none;
        }

        .dropdown-menu > li > a {
            color: #fff;
            padding: 8px 20px;
        }

        .dropdown-menu > li > a:hover {
            background-color: #337ab7;
            color: #fff;
        }

        /* Tombol kecil di kanan (Tambah Admin + Logout) */
        .navbar-btn-small {
            background-color: #5cb85c;
            color: #fff !important;
            padding: 6px 12px;
            border-radius: 4px;
            margin-top: 5x;
            margin-right: 5px;
            font-size: 13px;
            transition: background-color 0.3s ease;
        }

        .navbar-btn-small:hover {
            background-color: #4cae4c;
            text-decoration: none;
        }

        .logout-btn {
            background-color: #d9534f;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }

        .navbar-right .btn-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            margin-right: 15px;
        }

        .logout-info {
            color: #fff;
            font-size: 14px;
            margin-right: 8px;
        }

        .container-fluid, .content-fluid {
            width: 100%;
            margin: 0;
            padding: 10px 20px;
        }

        .table-responsive {
            width: 100%;
        }

        h2 {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="content-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">💧 - DLH Admin Panel</a>
                    </div>

                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Dashboard</a></li>

                        <!-- Dropdown Master Data -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="petugas_sampling_data.php">Data Petugas Sampling</a></li>
                                <li><a href="lokasi_pemantauan_data.php">Data Lokasi Pemantauan Air Sungai</a></li>
                                <li><a href="waktu_pemantauan_data.php">Data Waktu Pemantauan Air Sungai</a></li>
                                <li><a href="nilai_pemantauan_data.php">Data Nilai Pemantauan Air Sungai</a></li>
                                <li><a href="status_mutu_data.php">Data Status Mutu Air Sungai</a></li>
                                <li><a href="observasi_sungai_data.php">Data Observasi Air Sungai</a></li>
                                <li><a href="daftar_admin.php">Daftar User Admin</a></li>
                                <li><a href="daftar_pegawai.php">Daftar User Pegawai Bidang PPKLH</a></li>
                            </ul>
                        </li>

                        <!-- Dropdown Laporan -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="report_pembagian_tugas_pantau_view.php">Laporan Pembagian Tugas Pantau</a></li>
                                <li><a href="report_hasil_pemantauan_petugas_view.php">Laporan Hasil Pemantauan Petugas</a></li>
                                <li><a href="report_status_mutu_view.php">Laporan Status Mutu Air Sungai</a></li>
                                <li><a href="report_lokasi_lengkap_pemantauan_petugas_view.php">Laporan Lokasi Lengkap Pemantauan Petugas</a></li>
                                <li><a href="report_rekapitulasi_pemantauan_air_sungai_view.php">Laporan Rekapitulasi Pemantauan Air Sungai</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Kanan: info admin + tombol kecil -->
                    <ul class="nav navbar-nav navbar-right">
                        <div class="btn-group">
                            <span class="logout-info">
                                👤 <?php echo htmlspecialchars($_SESSION['nama']); ?> (Admin)
                            </span>
                            <a href="register_admin.php" class="navbar-btn-small">
                                <span class="glyphicon glyphicon-user"></span> Tambah Admin
                            </a>
                            <a href="logout.php" class="navbar-btn-small logout-btn">
                                <span class="glyphicon glyphicon-log-out"></span> Logout
                            </a>
                        </div>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-fluid">