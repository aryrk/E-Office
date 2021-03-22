<?php
require_once("../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../Login/Loginadmin.php");
	exit ();
}
date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

$A = "SELECT Nama_Admin FROM data_perusahaan WHERE NIK_Admin='$nik' AND Nama_Perusahaan='$kantor' AND Password='$pw';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);

$nama = $row['Nama_Admin'];

if (isset($_SESSION['isi'])){
	$tujuan = $_GET['tujuan'];
	$tanggal = $_GET['tanggal'];
	$isiPrev = $_SESSION['isi'];
	$judul = $_SESSION['judul'];
}
else if (isset($_SESSION['id_tugas'])){
	$id_tugas = $_SESSION['id_tugas'];
}
else {
	header("Location: ../Admin1.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Preview Tugas</title>
    
    <link rel="stylesheet" href="prev.css">
	<link rel="stylesheet" href="../../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $kantor; ?> Administrator</h1>
<?php
		if (isset($_SESSION['isi'])){
		}
		else if (isset($_SESSION['id_tugas'])) {
			echo '
        <a href="../etc/history/history.php"><i class="back fas fa-arrow-circle-left"></i></a>
		';
		}
?>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
<!--Inner-->
<?php
	if(isset($_SESSION['isi'])){
		echo '
<div class="row">
  		<div class="column">
    		<div class="card">
				
        			<center><h2 class="judul">'.$judul.'</h2></center>
				<div class="container">
		  			<div class="textB">
        			<p>'.$kantor.' Company</p>
			  		</div>
					
					<div class="box_shadow">
  						<div class="box_container">
							'.$isiPrev.'
  						</div>
					</div>
					<p>'.$nama.' - '.$tujuan.'<br>('.$tgl.') -  Akan dikirim pada ('.$tanggal.')</p>
        			<p><button class="button" id="button1">#To go back, just simply press '."'back'".' button </button></p>
      			</div>
    		</div>
  		</div>
	</div>
	';
		unset($_SESSION['isi']);
		unset($_SESSION['judul']);
	}
	
	if(isset($_SESSION['id_tugas'])){
		
		$A = "SELECT * FROM tugas WHERE id_tugas='$id_tugas';";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		
		$judul = $row['Judul'];
		$isi = $row['Isi_Tugas'];
		$nama = $row['Nama_Admin'];
		$tujuan = $row['Tujuan'];
		$tanggal = $row['Tanggal'];
		$from = $row['Submitted_On_Date'];
		
		echo '
<div class="row">
  		<div class="column">
    		<div class="card">
				
        			<center><h2 class="judul">'.$judul.'</h2></center>
				<div class="container">
		  			<div class="textB">
        			<p>'.$kantor.' Company</p>
			  		</div>
					
					<div class="box_shadow">
  						<div class="box_container">
							'.$isi.'
  						</div>
					</div>
					<p>'.$nama.' - '.$tujuan.'<br>('.$from.') -  Dikirim pada ('.$tanggal.')</p>
        			<p><a href="../etc/history/history.php"><button class="button" id="button1">Back</button></a></p>
      			</div>
    		</div>
  		</div>
	</div>
	';
		unset($_SESSION['id_tugas']);
	}
?>
<!--Inner-->
    
    <div class="Banner-handap">
        <div class="o">Officia</div>
        <nav class="navbar">
            <a class="toggler-navbar">
            </a>
            <div class="sidebar">
                <ul class="inline">

                </ul>
            </div>
        </nav>
    </div>

    <div class="Banner-handap-used">
        <div class="o">Officia</div>
        <nav class="navbar">
            <a class="toggler-navbar">
            </a>
            <div class="sidebar">
                <ul class="inline">
                    <li><a href="Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="../../script.js"></script>
	<script src="../../../Main Tab/etc/wow.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="../../../etc/allert.js"></script>
	
	<?php
		if (isset($_SESSION['deltugas'])){
			echo "<script> deltugas(); </script>";
			unset($_SESSION['deltugas']);
		}
?>
<script>
	new WOW().init();
</script>
</body>
</html>
