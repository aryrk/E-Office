<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../../../Login/login1.php");
	exit ();
}

require_once("../../../config.php");
date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");
//Session akan membuat link terlihat polos dan membuat website lebih teroptimisasi dibanding sebelumnya
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];
$nama = $_SESSION['nama'];
$jabatan = $_SESSION['jabatan'];

if(isset($_POST['search'])){
	$jenis = trim($_POST['jenis']);
	header("Location: tugas.php?l=$jenis");
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
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
            <div class="wow fadeInLeft"><li><a href="../../../Absensi/Home.php">Absen</a></li></div>
			<div class="wow fadeInLeft"><li><a href="../../../Pengumuman/pengumuman.php">Pengumuman</a></li></div>
        </ul>
</nav>
<form id="form1" name="form1" method="post" action="">
	<div class="wrap" style="z-index: 10000;">
	<div class="search">
		<select name="jenis" id="jenis">
<?php
//Menampilkan opsi search sesuai dengan kondisi
			if (!isset($_GET['l']) || $_GET['l'] == "All"){
			echo '
				<option value="All" class="searchTerm">Semua Tugas</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nama.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
			';	
			}
			else if (isset($_GET['l'])){
				$l = $_GET['l'];
				
				if($l == $jabatan){
			echo '
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="All" class="searchTerm">Semua Tugas</option>
				<option value="'.$nama.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
			';
				}
				
				else if($l == $nama){
			echo '
				<option value="'.$nama.'" class="searchTerm">Tugas Pribadi</option>
				<option value="All" class="searchTerm">Semua Tugas</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
			';
				}
				
				else if($l == "globe"){
			echo '
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="All" class="searchTerm">Semua Tugas</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nama.'" class="searchTerm">Tugas Pribadi</option>
			';
				}
			}
?>
		</select>
		<button type="submit" name="search" id="search" class="searchButton">
			<i class="fa fa-search"></i>
		</button>
	</div>
		</div>
	</form>
<div class="row">
<?php
//Menampilkan daftar tugas sesuai dengan opsi yang dipilih
if (!isset($_GET['l']) || $_GET['l'] == "All"){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$nama' AND Tanggal<='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
	
	echo '
  		<div class="column">
    		<div class="card">
      			<img src="../../../Icon/Textless/Icon.png" alt="Logo" style="width:100%">
      			<div class="container">
        			<h2 class="nama">'.$judul.'</h2>
		  			<div class="textB">
        			<p class="title">'.$pengiriman.'</p>
        			<p style="font-size: 90%">'.$tujuan.'</p>
					<p>'.$kantor.' Company</p>
			  		</div>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
		}
	}
}
	
else if (isset($_GET['l']) && $_GET['l'] == $nama){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='$nama' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
	
	echo '
  		<div class="column">
    		<div class="card">
      			<img src="../../../Icon/Textless/Icon.png" alt="Logo" style="width:100%">
      			<div class="container">
        			<h2 class="nama">'.$judul.'</h2>
		  			<div class="textB">
        			<p class="title">'.$pengiriman.'</p>
        			<p style="font-size: 90%">'.$tujuan.'</p>
					<p>'.$kantor.' Company</p>
			  		</div>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
		}
	}
}
else if (isset($_GET['l']) && $_GET['l'] == $jabatan){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
	
	echo '
  		<div class="column">
    		<div class="card">
      			<img src="../../../Icon/Textless/Icon.png" alt="Logo" style="width:100%">
      			<div class="container">
        			<h2 class="nama">'.$judul.'</h2>
		  			<div class="textB">
        			<p class="title">'.$pengiriman.'</p>
        			<p style="font-size: 90%">'.$tujuan.'</p>
					<p>'.$kantor.' Company</p>
			  		</div>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
		}
	}
}
	
else if (isset($_GET['l']) == 'globe'){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
	
	echo '
  		<div class="column">
    		<div class="card">
      			<img src="../../../Icon/Textless/Icon.png" alt="Logo" style="width:100%">
      			<div class="container">
        			<h2 class="nama">'.$judul.'</h2>
		  			<div class="textB">
        			<p class="title">'.$pengiriman.'</p>
        			<p style="font-size: 90%">'.$tujuan.'</p>
					<p>'.$kantor.' Company</p>
			  		</div>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
		}
	}
}
?>
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
