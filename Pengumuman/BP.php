<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN']) || !isset($_SESSION['id_pengumuman'])){
	header("Location: ../Login/login1.php");
	exit ();
}
require_once("../config.php");

$id = $_SESSION['id_pengumuman'];

$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];

$A = "SELECT * FROM pengumuman WHERE id_pengumuman='$id' AND Nama_Perusahaan='$kantor';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);

$judul = $row['Judul'];
$isi = $row['Isi_Pengumuman'];
$tanggal_tujuan = $row['Tanggal'];
$pengirim = $row['Nama_Admin'];
$tujuan = $row['Tujuan'];
if(is_numeric($tujuan)){
	$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
	$result_nama = mysqli_query($konek, $A_nama);
	$row_nama = mysqli_fetch_assoc($result_nama);
					
	$tujuan = $row_nama['Nama'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Pengumuman</title>
    <link rel="stylesheet" href="stylebp.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
</head>
<body>
    <header>
        <h1><?php echo $kantor; ?></h1>
    </header>
    <header-used">
        <h1>Officia</h1>
    </header-used>
    <div class="box">
        <h1 class="jd"><?php echo $judul; ?></h1>
        <p><?php echo $kantor; ?></p>
        <div class="kotakisi">
			<?php echo $isi; ?>
        </div>
        <p><?php echo $tujuan; ?></p>
        <p><?php echo $tanggal_tujuan; ?></p>
    </div>
        <a href="../unused.php?value=pengumuman_kembali"><button class="btn">
                Kembali
        </button></a>
    <div class="banerr-used">
        <h5> Officia, Copyright 2021. All Right Reserved</h5>
    </div>
    <div class="banerr">
        <h5> Officia, Copyright 2021. All Right Reserved</h5>
    </div>

</body>
</html>
