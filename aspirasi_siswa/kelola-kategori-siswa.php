<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    echo '<script>window.location="login-siswa.php"</script>';
    exit();
}
include 'db.php';

$nis = $_SESSION['siswa']['nis'];
$data = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE nis = '$nis' ORDER BY kategori_id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori</title>
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
            <h3>Kelola Kategori Saya</h3>
            <div class="box">
                <p><a href="tambah-kategori-siswa.php" class="btn">Tambah Kategori Baru</a></p>
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
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nama_kategori'] ?></td>
                            <td>
                                <a href="edit-kategori-siswa.php?id=<?php echo $row['kategori_id'] ?>" class="btn-edit">Edit</a>
                            </td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="3">Belum ada kategori yang ditambahkan.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>