<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

$total     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_aspirasi"))['total'];
$menunggu  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_aspirasi WHERE status='Menunggu'"))['total'];
$proses    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_aspirasi WHERE status='Proses'"))['total'];
$selesai   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_aspirasi WHERE status='Selesai'"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="container">
            <h1><a href="dashboard.php">Pengaduan Sarana Sekolah</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="data-aspirasi.php">Data Aspirasi</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-siswa.php">Data Siswa</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <p>Selamat datang, <strong><?= $_SESSION['admin']->username ?></strong></p>
            </div>

            <h3>Statistik Aspirasi</h3>
            <div class="box">
                <div class="stat-wrapper">
                    <div class="col-stat">
                        <h3><?= $total ?></h3>
                        <p>Total Aspirasi</p>
                    </div>
                    <div class="col-stat">
                        <h3><?= $menunggu ?></h3>
                        <p>Menunggu</p>
                    </div>
                    <div class="col-stat">
                        <h3><?= $proses ?></h3>
                        <p>Proses</p>
                    </div>
                    <div class="col-stat">
                        <h3><?= $selesai ?></h3>
                        <p>Selesai</p>
                    </div>
                </div>
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

