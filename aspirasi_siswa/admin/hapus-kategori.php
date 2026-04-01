<?php
session_start();
include '../db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $delete = mysqli_query($conn, "DELETE FROM tb_kategori WHERE kategori_id = '$id'");
    if ($delete) {
        echo '<script>window.location="data-kategori.php"</script>';
    } else {
        echo '<script>alert("Gagal hapus. Kategori mungkin masih digunakan.")</script>';
        echo '<script>window.location="data-kategori.php"</script>';
    }
}
?>

