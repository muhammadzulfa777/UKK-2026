<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    echo '<script>window.location="login-siswa.php"</script>';
    exit();
}
include 'db.php';

if (isset($_POST['submit'])) {
    $nama = ucwords($_POST['nama_kategori']);
    $nis = $_SESSION['siswa']['nis'];
    $insert = mysqli_query($conn, "INSERT INTO tb_kategori (nama_kategori, nis) VALUES ('$nama', '$nis')");
    if ($insert) {
        echo '<script>alert("Kategori berhasil ditambahkan")</script>';
        echo '<script>window.location="kelola-kategori-siswa.php"</script>';
    } else {
        echo '<script>alert("Gagal menambahkan kategori")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="container">
            <h1><a href="index.php">Pengaduan Sarana Sekolah</a></h1>
            <ul>
                <li><a href="form-aspirasi.php">Input Aspirasi</a></li>
                <li><a href="kelola-kategori-siswa.php">Kelola Kategori</a></li>
                <li><a href="histori.php">Histori</a></li>
                <li><a href="keluar-siswa.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Tambah Kategori Baru</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="input-control" required>
                    <input type="submit" name="submit" value="Tambah Kategori" class="btn">
                </form>
            </div>
        </div>
    </div>

</body>
</html>