<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    echo '<script>window.location="login-siswa.php"</script>';
    exit();
}
include 'db.php';

$nis = $_SESSION['siswa']['nis'];
$data = mysqli_query($conn, "SELECT a.*, k.nama_kategori
                              FROM tb_aspirasi a
                              JOIN tb_kategori k ON a.kategori_id = k.kategori_id
                              WHERE a.nis = '$nis'
                              ORDER BY a.tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Aspirasi</title>
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
            <h3>Histori Aspirasi - <?= $_SESSION['siswa']['nama'] ?></h3>
            <div class="box">
                <p><a href="form-aspirasi.php" class="btn-sm">+ Input Aspirasi Baru</a></p>
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th width="90px">Tanggal</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th width="80px">Status</th>
                            <th>Umpan Balik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_array($data)) {
                                $status = $row['status'];
                                $class  = '';
                                if ($status == 'Menunggu') $class = 'badge-menunggu';
                                elseif ($status == 'Proses') $class = 'badge-proses';
                                elseif ($status == 'Selesai') $class = 'badge-selesai';
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                            <td><?= $row['nama_kategori'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td><span class="badge <?= $class ?>"><?= $status ?></span></td>
                            <td><?= $row['feedback'] ? $row['feedback'] : '<i style="color:#aaa;">Belum ada</i>' ?></td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="7">Belum ada aspirasi yang disampaikan.</td>
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

