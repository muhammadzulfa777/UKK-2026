<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

if (isset($_POST['submit'])) {
    $nis    = $_POST['nis'];
    $nama   = ucwords($_POST['nama']);
    $kelas  = strtoupper($_POST['kelas']);
    $pass   = $_POST['password'];

    // Cek NIS sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("NIS sudah terdaftar, gunakan NIS lain")</script>';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('$nis', '$nama', '$kelas', MD5('$pass'))");
        if ($insert) {
            echo '<script>alert("Tambah data berhasil")</script>';
            echo '<script>window.location="data-siswa.php"</script>';
        } else {
            echo '<script>alert("Gagal tambah data")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
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
            <h3>Tambah Data Siswa</h3>
            <div class="box">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" name="nis" placeholder="Nomor Induk Siswa" class="input-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Nama lengkap siswa" class="input-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Contoh: XII RPL 1" class="input-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" placeholder="Password untuk login siswa" class="input-control" required>
                    </div>
                    <input type="submit" name="submit" value="Simpan" class="btn">
                    &nbsp;
                    <a href="data-siswa.php" class="btn-back">Kembali</a>
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

