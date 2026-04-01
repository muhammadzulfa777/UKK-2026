<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

if (isset($_POST['submit'])) {
    $nama = ucwords($_POST['nama_kategori']);
    $insert = mysqli_query($conn, "INSERT INTO tb_kategori (nama_kategori, nis) VALUES ('$nama', NULL)");
    if ($insert) {
        echo '<script>alert("Tambah data berhasil")</script>';
        echo '<script>window.location="data-kategori.php"</script>';
    } else {
        echo '<script>alert("Gagal tambah data")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
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
            <h3>Tambah Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="input-control" required>
                    <input type="submit" name="submit" value="Simpan" class="btn">
                    &nbsp;
                    <a href="data-kategori.php" class="btn-back">Kembali</a>
                </form>
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

