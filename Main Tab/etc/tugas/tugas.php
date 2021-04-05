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
if (!empty($_POST)){
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
		<select name="jenis" id="jenis" onchange='if(this.value != 0) { this.form.submit(); }'>
<?php
//Menampilkan opsi search sesuai dengan kondisi
			if (!isset($_GET['l']) || $_GET['l'] == "All"){
			echo '
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="done" class="searchTerm">Tugas Selesai</option>
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
			';	
			}
			else if (isset($_GET['l'])){
				$l = $_GET['l'];
				
				if($l == $jabatan){
			echo '
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="done" class="searchTerm">Tugas Selesai</option>
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
			';
				}
				
				else if($l == $nik){
			echo '
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="done" class="searchTerm">Tugas Selesai</option>
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
			';
				}
				
				else if($l == "globe"){
			echo '
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="done" class="searchTerm">Tugas Selesai</option>
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
			';
				}
				else if ($l == "done"){
			echo '
				<option value="done" class="searchTerm">Tugas Selesai</option>
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
			';	
				}
				else if ($l == "dead"){
			echo '
				<option value="dead" class="searchTerm">Tugas Kadeluarsa</option>
				<option value="All" class="searchTerm">Semua Tugas Aktif</option>
				<option value="'.$jabatan.'" class="searchTerm">Tugas Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Tugas Pribadi</option>
				<option value="globe" class="searchTerm">Tugas Global</option>
				<option value="done" class="searchTerm">Tugas Selesai</option>
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
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' AND Deadline>='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$nik' AND Tanggal<='$tgl' AND Deadline>='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' AND Deadline>='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			
			$tujuan = $row['Tujuan'];
			if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}
			$id = $row['id_tugas'];
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver == 0){
	
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
					<p>Deadline:</p>
					<p class="title">'.$dead.'</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l=All"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
		}
	}
}
	
else if (isset($_GET['l']) && $_GET['l'] == $nik){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='$nik' AND Tanggal<='$tgl' AND Deadline>='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
	
			if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver == 0){
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
					<p>Deadline:</p>
					<p class="title">'.$dead.'</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l='.$nik.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
		}
	}
}
else if (isset($_GET['l']) && $_GET['l'] == $jabatan){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' AND Deadline>='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver == 0){
	
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
					<p>Deadline:</p>
					<p class="title">'.$dead.'</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l='.$jabatan.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
		}
	}
}

else if (isset($_GET['l']) && $_GET['l'] == 'dead'){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Deadline<'$tgl' AND Tujuan='Seluruh Karyawan' OR Nama_Perusahaan='$kantor' AND Deadline<'$tgl' AND Tujuan='$nik' OR Nama_Perusahaan='$kantor' AND Deadline<'$tgl' AND Tujuan='$jabatan' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver == 0){
	
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
					<p>Deadline:</p>
					<p class="title">'.$dead.'</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l=dead"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
		}
	}
}
	
else if (isset($_GET['l']) && $_GET['l'] == 'done'){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' OR Nama_Perusahaan='$kantor' AND Tujuan='$nik' OR Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver > 0){
	
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
					<p class="title">(Telah Dikerjakan)</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l=done"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
		}
	}
}
	
else if (isset($_GET['l']) == 'globe'){
	$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' AND Deadline>='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = date("D - d/m/Y", strtotime($row['Tanggal']));
			$dead = date("D - d/m/Y", strtotime($row['Deadline']));
			$tujuan = $row['Tujuan'];
			$id = $row['id_tugas'];
			
			$A_saver = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama'";
			$result_saver = mysqli_query($konek, $A_saver);
			$check_saver = mysqli_num_rows($result_saver);
				
			if ($check_saver == 0){
	
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
					<p>Deadline:</p>
					<p class="title">'.$dead.'</p>
        			<p><a href="../../../unused.php?value=prevtugas&&id_tugas='.$id.'&&l=globe"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
    		</div>
  		</div>
	';
			}
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
