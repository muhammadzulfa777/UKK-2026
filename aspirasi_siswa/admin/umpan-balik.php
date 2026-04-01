<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

$id = (int)$_GET['id'];
$aspirasi = mysqli_query($conn, "SELECT a.*, k.nama_kategori, s.nama, s.kelas, s.nis
                                  FROM tb_aspirasi a
                                  JOIN tb_kategori k ON a.kategori_id = k.kategori_id
                                  JOIN tb_siswa s ON a.nis = s.nis
                                  WHERE a.aspirasi_id = '$id'");

if (mysqli_num_rows($aspirasi) == 0) {
    echo '<script>window.location="data-aspirasi.php"</script>';
    exit();
}
$row = mysqli_fetch_array($aspirasi);

if (isset($_POST['submit'])) {
    $status   = $_POST['status'];
    $feedback = $_POST['feedback'];

    $update = mysqli_query($conn, "UPDATE tb_aspirasi SET status='$status', feedback='$feedback' WHERE aspirasi_id='$id'");
    if ($update) {
        echo '<script>alert("Umpan balik berhasil disimpan")</script>';
        echo '<script>window.location="data-aspirasi.php"</script>';
    } else {
        echo '<script>alert("Gagal menyimpan")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik</title>
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
            <h3>Umpan Balik Aspirasi</h3>

            
            <div class="box">
                <p><strong>Detail Aspirasi</strong></p>
                <br>
                <table class="table" border="0">
                    <tr>
                        <td width="120px">Nama Siswa</td>
                        <td>: <strong><?= $row['nama'] ?></strong></td>
                        <td width="80px">Kelas</td>
                        <td>: <?= $row['kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>: <?= $row['nis'] ?></td>
                        <td>Tanggal</td>
                        <td>: <?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>: <?= $row['nama_kategori'] ?></td>
                        <td>Lokasi</td>
                        <td>: <?= $row['lokasi'] ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td colspan="3">: <?= $row['keterangan'] ?></td>
                    </tr>
                </table>
            </div>

            
            <div class="box">
                <p><strong>Beri Umpan Balik</strong></p>
                <br>
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="input-control" required>
                            <option value="Menunggu" <?= $row['status']=='Menunggu'?'selected':'' ?>>Menunggu</option>
                            <option value="Proses"   <?= $row['status']=='Proses'?'selected':'' ?>>Proses</option>
                            <option value="Selesai"  <?= $row['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Umpan Balik</label>
                        <textarea name="feedback" class="input-control" placeholder="Tulis tanggapan atau perkembangan penanganan..." required><?= $row['feedback'] ?></textarea>
                    </div>
                    <input type="submit" name="submit" value="Simpan" class="btn">
                    &nbsp;
                    <a href="data-aspirasi.php" class="btn-back">Kembali</a>
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

