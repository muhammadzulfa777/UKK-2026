<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login Admin</h2>
        <p class="sub">Pengaduan Sarana Sekolah</p>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control" required>
            <input type="password" name="pass" placeholder="Password" class="input-control" required>
            <input type="submit" name="submit" value="Masuk" class="btn">
        </form>
        <br>
        <p style="font-size:12px;">Login sebagai Siswa? <a href="../login-siswa.php" style="color:#0ea5e9;">Klik di sini</a></p>
        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include '../db.php';

            $user = $_POST['user'];
            $pass = $_POST['pass'];

            $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user' AND password = MD5('$pass')");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['admin'] = $d;
                echo '<script>window.location="dashboard.php"</script>';
            } else {
                echo '<script>alert("Username atau password salah")</script>';
            }
        }
        ?>
    </div>
</body>
</html>

