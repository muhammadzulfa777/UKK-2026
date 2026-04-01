<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="container">
            <h1><a href="index.php">Pengaduan Sarana Sekolah</a></h1>
            <ul>
                <?php if (isset($_SESSION['siswa'])): ?>
                    <li><a href="form-aspirasi.php">Input Aspirasi</a></li>
                    <li><a href="histori.php">Histori</a></li>
                    <li><a href="keluar-siswa.php">Keluar</a></li>
                <?php elseif (isset($_SESSION['status_login'])): ?>
                    <li><a href="admin/dashboard.php">Dashboard</a></li>
                <?php else: ?>
                    <li><a href="login-siswa.php">Login Siswa</a></li>
                    <li><a href="daftar-siswa.php">Daftar Siswa</a></li>
                    <li><a href="admin/login.php">Login Admin</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Selamat Datang</h3>
            <div class="box">
                <p>Aplikasi Pengaduan Sarana Sekolah adalah platform untuk menyampaikan aspirasi dan pengaduan terkait sarana prasarana sekolah.</p>
            </div>

            <h3>Tentang Aplikasi</h3>
            <div class="box">
                <table class="table" border="0">
                    <tr>
                        <td width="180px"><strong>Nama Aplikasi</strong></td>
                        <td>: Pengaduan Sarana Sekolah</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Pelajaran</strong></td>
                        <td>: 2025/2026</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Tugas</strong></td>
                        <td>: UKK SMK RPL Paket 3</td>
                    </tr>
                    <tr>
                        <td><strong>Fitur Siswa</strong></td>
                        <td>: Form pengaduan, histori, pantau status</td>
                    </tr>
                    <tr>
                        <td><strong>Fitur Admin</strong></td>
                        <td>: Kelola aspirasi, umpan balik, kelola kategori</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <small>copyright &copy; <?= date('Y') ?> - Aplikasi Pengaduan Sarana Sekolah.</small>
        </div>
    </footer>
</body>
</html>

