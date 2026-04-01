<?php
session_start();
include '../db.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $delete = mysqli_query($conn, "DELETE FROM tb_siswa WHERE nis = '$nis'");
    if ($delete) {
        echo '<script>window.location="data-siswa.php"</script>';
    } else {
        echo '<script>alert("Gagal hapus. Siswa mungkin masih memiliki data aspirasi.")</script>';
        echo '<script>window.location="data-siswa.php"</script>';
    }
}
?>

