<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit();
}
include '../db.php';

// Filter
$where      = "WHERE 1=1";
$f_status   = isset($_GET['status'])   ? $_GET['status']   : '';
$f_bulan    = isset($_GET['bulan'])    ? $_GET['bulan']    : '';
$f_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$f_siswa    = isset($_GET['siswa'])    ? $_GET['siswa']    : '';

if ($f_status   != '') $where .= " AND a.status = '$f_status'";
if ($f_bulan    != '') $where .= " AND MONTH(a.tanggal) = '$f_bulan'";
if ($f_kategori != '') $where .= " AND a.kategori_id = '$f_kategori'";
if ($f_siswa    != '') $where .= " AND a.nis = '$f_siswa'";

$data = mysqli_query($conn, "SELECT a.*, k.nama_kategori, s.nama, s.kelas
                              FROM tb_aspirasi a
                              JOIN tb_kategori k ON a.kategori_id = k.kategori_id
                              JOIN tb_siswa s ON a.nis = s.nis
                              $where
                              ORDER BY a.tanggal DESC");

$kategori_list = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id");
$siswa_list    = mysqli_query($conn, "SELECT * FROM tb_siswa ORDER BY nama");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi</title>
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
            <h3>Data Aspirasi</h3>

            
            <div class="box">
                <form action="" method="GET">
                    <table border="0">
                        <tr>
                            <td style="padding:4px 8px 4px 0;font-size:13px;"><label>Status</label></td>
                            <td style="padding:4px 8px 4px 0;">
                                <select name="status" class="input-control" style="margin-bottom:0;padding:6px;">
                                    <option value="">-- Semua Status --</option>
                                    <option value="Menunggu" <?= $f_status=='Menunggu'?'selected':'' ?>>Menunggu</option>
                                    <option value="Proses"   <?= $f_status=='Proses'?'selected':'' ?>>Proses</option>
                                    <option value="Selesai"  <?= $f_status=='Selesai'?'selected':'' ?>>Selesai</option>
                                </select>
                            </td>
                            <td style="padding:4px 8px 4px 0;font-size:13px;"><label>Bulan</label></td>
                            <td style="padding:4px 8px 4px 0;">
                                <select name="bulan" class="input-control" style="margin-bottom:0;padding:6px;">
                                    <option value="">-- Semua Bulan --</option>
                                    <?php
                                    $bln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    for ($i = 1; $i <= 12; $i++):
                                    ?>
                                    <option value="<?= $i ?>" <?= $f_bulan==$i?'selected':'' ?>><?= $bln[$i] ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td style="padding:4px 8px 4px 0;font-size:13px;"><label>Kategori</label></td>
                            <td style="padding:4px 8px 4px 0;">
                                <select name="kategori" class="input-control" style="margin-bottom:0;padding:6px;">
                                    <option value="">-- Semua Kategori --</option>
                                    <?php while ($k = mysqli_fetch_array($kategori_list)): ?>
                                    <option value="<?= $k['kategori_id'] ?>" <?= $f_kategori==$k['kategori_id']?'selected':'' ?>><?= $k['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                            <td style="padding:4px 8px 4px 0;font-size:13px;"><label>Siswa</label></td>
                            <td style="padding:4px 8px 4px 0;">
                                <select name="siswa" class="input-control" style="margin-bottom:0;padding:6px;">
                                    <option value="">-- Semua Siswa --</option>
                                    <?php while ($s = mysqli_fetch_array($siswa_list)): ?>
                                    <option value="<?= $s['nis'] ?>" <?= $f_siswa==$s['nis']?'selected':'' ?>><?= $s['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                            <td style="padding:4px 0;">
                                <input type="submit" name="filter" value="Filter" class="btn">
                                &nbsp;<a href="data-aspirasi.php" class="btn-back" style="font-size:13px;padding:6px 12px;">Reset</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th width="90px">Tanggal</th>
                            <th>Nama / Kelas</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th width="80px">Status</th>
                            <th>Umpan Balik</th>
                            <th width="60px">Aksi</th>
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
                            <td><?= $row['nama'] ?><br><small><?= $row['kelas'] ?></small></td>
                            <td><?= $row['nama_kategori'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td><span class="badge <?= $class ?>"><?= $status ?></span></td>
                            <td><?= $row['feedback'] ? $row['feedback'] : '<i style="color:#aaa;">Belum ada</i>' ?></td>
                            <td><a href="umpan-balik.php?id=<?= $row['aspirasi_id'] ?>" class="aksi-edit">Balas</a></td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="9">Tidak ada data aspirasi.</td>
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

