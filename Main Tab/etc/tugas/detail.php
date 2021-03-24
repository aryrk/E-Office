<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN']) || !isset($_SESSION['id_tugas'])){
	header("Location: ../../../Login/login1.php");
	exit ();
}
require_once("../../../config.php");

$id = $_SESSION['id_tugas'];

$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];

$A = "SELECT * FROM tugas WHERE id_tugas='$id' AND Nama_Perusahaan='$kantor';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);

$judul_tugas = $row['Judul'];
$isi_tugas = $row['Isi_Tugas'];
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
    	<title>Tugas</title>
<link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="detail.css">
<link rel="stylesheet" href="../Animate.css">
<link rel="stylesheet" href="../../../etc/wmRemover.css">
</head>

<body>
	
<nav id="navigation1" class="nav1">
</nav>
<nav id="navigation">
		<div class="menu-toggle">
		<input type="checkbox" onClick="Hamburger()">
            <span></span>
            <span></span>
            <span></span>
	</div>
	<div class="logo">
	<div class="wow logo">
		<h3><?php echo $kantor; ?></h3>
	</div>
	</div>

        <ul>
            <div class="wow fadeInLeft"><li><a href="../Main.php">Profile</a></li></div>
            <div class="wow fadeInLeft"><li><a href="../../../Absensi/Absen.php">Absen</a></li></div>
			<div class="wow fadeInLeft"><li><a href="../../../Pengumuman/pengumuman.php">Pengumuman</a></li></div>
        </ul>
</nav>
	
<!--Aryo's Card-->
	<div class="row">
  		<div class="column">
    		<div class="card">
				
        			<center><h2 class="judul"><?php echo $judul_tugas; ?></h2></center>
				<div class="container">
		  			<div class="textB">
        			<p><?php echo $kantor; ?> Company</p>
			  		</div>
					
					<div class="box_shadow">
  						<div class="box_container">
							<?php echo $isi_tugas; ?>
  						</div>
					</div>
					<p><?php echo $pengirim; ?> - <?php echo $tujuan;?><br>(<?php echo $tanggal_tujuan; ?>)</p>
					
        			<p><a href="../../../unused.php?value=tugas_kembali"><button class="button" id="button1">Kembali</button></a></p>
      			</div>
    		</div>
  		</div>
	</div>
		<h5 class="copyr">&copy; Officia, Copyright 2021. All Right Reserved</h5>
		<h5 class="copyrUnused">Officia, Copyright &copy; 2021. All Right Reserved</h5>

<script src="../script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../wow.min.js"></script>
<script>
	new WOW().init();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
