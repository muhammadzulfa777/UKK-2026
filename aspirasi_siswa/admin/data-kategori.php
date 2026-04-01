<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

$data = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
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
            <h3>Data Kategori</h3>
            <div class="box">
                <p><a href="tambah-kategori.php">Tambah Data</a></p>
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama Kategori</th>
                            <th width="150px">Aksi</th>
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
                            <td><?= $row['nama_kategori'] ?></td>
                            <td>
                                <a href="edit-kategori.php?id=<?= $row['kategori_id'] ?>" class="aksi-edit">Edit</a> ||
                                <a href="hapus-kategori.php?id=<?= $row['kategori_id'] ?>" class="aksi-hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="3">Tidak ada data kategori.</td>
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

