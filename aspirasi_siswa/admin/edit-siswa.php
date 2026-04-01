<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

$nis = $_GET['nis'];
$cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
if (mysqli_num_rows($cek) == 0) {
    echo '<script>window.location="data-siswa.php"</script>';
    exit();
}
$row = mysqli_fetch_object($cek);

if (isset($_POST['submit'])) {
    $nama   = ucwords($_POST['nama']);
    $kelas  = strtoupper($_POST['kelas']);
    $pass   = $_POST['password'];

    // Jika password diisi, update sekalian. Jika kosong, biarkan password lama
    if (!empty($pass)) {
        $update = mysqli_query($conn, "UPDATE tb_siswa SET nama='$nama', kelas='$kelas', password=MD5('$pass') WHERE nis='$nis'");
    } else {
        $update = mysqli_query($conn, "UPDATE tb_siswa SET nama='$nama', kelas='$kelas' WHERE nis='$nis'");
    }

    if ($update) {
        echo '<script>alert("Edit data berhasil")</script>';
        echo '<script>window.location="data-siswa.php"</script>';
    } else {
        echo '<script>alert("Gagal edit data")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
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
            <h3>Edit Data Siswa</h3>
            <div class="box">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="input-control" value="<?= $row->nis ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="input-control" value="<?= $row->nama ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="input-control" value="<?= $row->kelas ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru <small style="font-weight:normal;">(kosongkan jika tidak ingin mengubah password)</small></label>
                        <input type="text" name="password" placeholder="Isi jika ingin ganti password" class="input-control">
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

