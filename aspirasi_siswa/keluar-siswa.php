<?php
session_start();
unset($_SESSION['siswa']);
session_destroy();
echo '<script>window.location="index.php"</script>';
?>

