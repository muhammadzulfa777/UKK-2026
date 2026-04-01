<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login Siswa</h2>
        <p class="sub">Pengaduan Sarana Sekolah</p>
        <form action="" method="POST">
            <input type="number" name="nis" placeholder="NIS" class="input-control" required>
            <input type="password" name="password" placeholder="Password" class="input-control" required>
            <input type="submit" name="submit" value="Masuk" class="btn">
        </form>
        <br>
        <p style="font-size:12px;">Login sebagai Admin? <a href="admin/login.php" style="color:#0ea5e9;">Klik di sini</a></p>
        <p style="font-size:12px;">Belum punya akun? <a href="daftar-siswa.php" style="color:#0ea5e9;">Daftar di sini</a></p>
        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include 'db.php';

            $nis  = $_POST['nis'];
            $pass = $_POST['password'];

            $cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nis = '$nis' AND password = MD5('$pass')");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_assoc($cek);
                $_SESSION['siswa'] = $d;
                echo '<script>window.location="form-aspirasi.php"</script>';
            } else {
                echo '<script>alert("NIS atau password salah")</script>';
            }
        }
        ?>
    </div>
</body>
</html>

