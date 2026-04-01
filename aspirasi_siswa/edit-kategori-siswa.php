<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    echo '<script>window.location="login-siswa.php"</script>';
    exit();
}
include 'db.php';

$id = $_GET['id'];
$nis = $_SESSION['siswa']['nis'];

$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE kategori_id = '$id' AND nis = '$nis'");
if (mysqli_num_rows($kategori) == 0) {
    echo '<script>alert("Kategori tidak ditemukan atau bukan milik Anda")</script>';
    echo '<script>window.location="kelola-kategori-siswa.php"</script>';
    exit();
}

$row = mysqli_fetch_array($kategori);

if (isset($_POST['submit'])) {
    $nama = ucwords($_POST['nama_kategori']);
    $update = mysqli_query($conn, "UPDATE tb_kategori SET nama_kategori = '$nama' WHERE kategori_id = '$id' AND nis = '$nis'");
    if ($update) {
        echo '<script>alert("Kategori berhasil diupdate")</script>';
        echo '<script>window.location="kelola-kategori-siswa.php"</script>';
    } else {
        echo '<script>alert("Gagal update kategori")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
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
            <h3>Edit Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="input-control" value="<?php echo $row['nama_kategori'] ?>" required>
                    <input type="submit" name="submit" value="Update Kategori" class="btn">
                </form>
            </div>
        </div>
    </div>

</body>
</html>