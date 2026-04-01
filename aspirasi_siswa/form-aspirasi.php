<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    echo '<script>window.location="login-siswa.php"</script>';
    exit();
}
include 'db.php';

// Ambil kategori
$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id ASC");

// Proses simpan
if (isset($_POST['submit'])) {
    $nis        = $_SESSION['siswa']['nis'];
    $kat_id     = $_POST['kategori_id'];
    $lokasi     = ucwords($_POST['lokasi']);
    $ket        = $_POST['keterangan'];
    $tanggal    = date('Y-m-d');

    $insert = mysqli_query($conn, "INSERT INTO tb_aspirasi (nis, kategori_id, lokasi, keterangan, tanggal)
              VALUES ('$nis', '$kat_id', '$lokasi', '$ket', '$tanggal')");

    if ($insert) {
        echo '<script>alert("Aspirasi berhasil dikirim")</script>';
        echo '<script>window.location="histori.php"</script>';
    } else {
        echo '<script>alert("Gagal mengirim aspirasi")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Aspirasi</title>
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
            <h3>Input Aspirasi Siswa</h3>
            <div class="box">
                
                <table class="table" border="0" style="margin-bottom:15px;">
                    <tr>
                        <td width="80px"><strong>Nama</strong></td>
                        <td>: <?= $_SESSION['siswa']['nama'] ?></td>
                        <td width="80px"><strong>NIS</strong></td>
                        <td>: <?= $_SESSION['siswa']['nis'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kelas</strong></td>
                        <td>: <?= $_SESSION['siswa']['kelas'] ?></td>
                        <td><strong>Tanggal</strong></td>
                        <td>: <?= date('d-m-Y') ?></td>
                    </tr>
                </table>

                <form action="" method="POST">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="input-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($k = mysqli_fetch_array($kategori)): ?>
                            <option value="<?= $k['kategori_id'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="input-control" placeholder="Contoh: Ruang XII RPL 1" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="input-control" placeholder="Jelaskan masalah yang ingin dilaporkan..." required></textarea>
                    </div>
                    <input type="submit" name="submit" value="Kirim Aspirasi" class="btn">
                    &nbsp;
                    <a href="histori.php" class="btn-back">Lihat Histori</a>
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

