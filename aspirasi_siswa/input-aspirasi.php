<?php header('Location: form-aspirasi.php'); exit(); ?>

// Ambil kategori
$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id ASC");

// Proses simpan
if (isset($_POST['submit'])) {
    $nis         = $_SESSION['siswa']['nis'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi      = ucwords(strip_tags($_POST['lokasi']));
    $ket         = strip_tags($_POST['ket']);

    $insert = mysqli_query($conn, "INSERT INTO tb_input_aspirasi (nis, id_kategori, lokasi, ket)
              VALUES ('$nis', '$id_kategori', '$lokasi', '$ket')");

    if ($insert) {
        echo '<script>alert("Input aspirasi berhasil disimpan")</script>';
        echo '<script>window.location="histori-input.php"</script>';
    } else {
        echo '<script>alert("Gagal menyimpan input aspirasi")</script>';
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
                <li><a href="form-aspirasi.php">Buat Pengaduan</a></li>
                <li><a href="input-aspirasi.php">Input Aspirasi</a></li>
                <li><a href="histori.php">Histori</a></li>
                <li><a href="keluar-siswa.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Form Input Aspirasi Siswa</h3>
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
                        <select name="id_kategori" class="input-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($k = mysqli_fetch_array($kategori)): ?>
                            <option value="<?= $k['kategori_id'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="input-control" placeholder="Contoh: Ruang XII RPL 1" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="ket" class="input-control" placeholder="Jelaskan secara singkat aspirasi Anda..." maxlength="50" required>
                    </div>
                    <input type="submit" name="submit" value="Simpan Input Aspirasi" class="btn">
                    &nbsp;
                    <a href="histori-input.php" class="btn-back">Lihat Histori Input</a>
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
