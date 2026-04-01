<?php
header('Location: histori.php');
exit();
?>

$data = mysqli_query($conn, "SELECT ia.*, k.nama_kategori
                              FROM tb_input_aspirasi ia
                              JOIN tb_kategori k ON ia.id_kategori = k.kategori_id
                              WHERE ia.nis = '$nis'
                              ORDER BY ia.id_pelaporan DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Input Aspirasi</title>
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
            <h3>Histori Input Aspirasi - <?= $_SESSION['siswa']['nama'] ?></h3>
            <div class="box">
                <p><a href="input-aspirasi.php" class="btn-sm">+ Input Aspirasi Baru</a></p>
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th width="60px">ID</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_pelaporan'] ?></td>
                            <td><?= $row['nama_kategori'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= $row['ket'] ?></td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="5">Belum ada input aspirasi yang disimpan.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
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
