<?php
session_start();
if (isset($_SESSION['siswa'])) {
    header('Location: form-aspirasi.php');
    exit();
}
include 'db.php';

if (isset($_POST['submit'])) {
    $nis      = $_POST['nis'];
    $nama     = ucwords(trim($_POST['nama']));
    $kelas    = strtoupper(trim($_POST['kelas']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $error = "Password tidak sama.";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nis = '$nis'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "NIS sudah terdaftar, gunakan NIS lain.";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO tb_siswa (nis, nama, kelas, password) VALUES ('$nis', '$nama', '$kelas', MD5('$password'))");
            if ($insert) {
                header('Location: login-siswa.php');
                exit();
            } else {
                $error = "Gagal menyimpan data. Coba lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Daftar Siswa Baru</h2>
        <p class="sub">Isi data siswa untuk membuat akun</p>

        <?php if (!empty($error)): ?>
            <p style="color:red; font-size:13px;"><?= $error ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="number" name="nis" placeholder="NIS" class="input-control" required>
            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required>
            <input type="text" name="kelas" placeholder="Kelas" class="input-control" required>
            <input type="password" name="password" placeholder="Password" class="input-control" required>
            <input type="password" name="password2" placeholder="Konfirmasi Password" class="input-control" required>
            <input type="submit" name="submit" value="Daftar" class="btn">
        </form>

        <br>
        <p style="font-size:12px;">Sudah punya akun? <a href="login-siswa.php" style="color:#0ea5e9;">Login di sini</a></p>
    </div>
</body>
</html>