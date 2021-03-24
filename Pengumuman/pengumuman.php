<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../Login/login1.php");
	exit ();
}

require_once("../config.php");
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
	header("Location: pengumuman.php?l=$jenis");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Pengumuman</title>
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../etc/wmRemover.css">
</head>
<body>
    <header class="banner">
        <h1 class="h1">Pengumuman</h1>
        <!-- <select name="A" id="pilihan"> 
            <option value="Semua Pengumuman">Semua Karyawan</option>
            <option value="Pengumuman Bagian">Pengumuman Bagian</option>
            <option value="Pengumuman Pribadi">Pengumuman Pribadi</option>
            <option value="Pengumuman Global">Pengumuman Global</option>
        </select>-->
<form id="form1" name="form1" method="post" action="">
        <div class="search">
        <div class="select">
            <select name="jenis" id="jenis">
<?php
//Menampilkan opsi search sesuai dengan kondisi
			if (!isset($_GET['l']) || $_GET['l'] == "All"){
			echo '
				<option value="All" class="searchTerm">Semua Pengumuman</option>
				<option value="'.$jabatan.'" class="searchTerm">Pengumuman Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Pengumuman Pribadi</option>
				<option value="globe" class="searchTerm">Pengumuman Global</option>
			';	
			}
			else if (isset($_GET['l'])){
				$l = $_GET['l'];
				
				if($l == $jabatan){
			echo '
				<option value="'.$jabatan.'" class="searchTerm">Pengumuman Bagian</option>
				<option value="All" class="searchTerm">Semua Pengumuman</option>
				<option value="'.$nik.'" class="searchTerm">Pengumuman Pribadi</option>
				<option value="globe" class="searchTerm">Pengumuman Global</option>
			';
				}
				
				else if($l == $nik){
			echo '
				<option value="'.$nik.'" class="searchTerm">Pengumuman Pribadi</option>
				<option value="All" class="searchTerm">Semua Pengumuman</option>
				<option value="'.$jabatan.'" class="searchTerm">Pengumuman Bagian</option>
				<option value="globe" class="searchTerm">Pengumuman Global</option>
			';
				}
				
				else if($l == "globe"){
			echo '
				<option value="globe" class="searchTerm">Pengumuman Global</option>
				<option value="All" class="searchTerm">Semua Pengumuman</option>
				<option value="'.$jabatan.'" class="searchTerm">Pengumuman Bagian</option>
				<option value="'.$nik.'" class="searchTerm">Pengumuman Pribadi</option>
			';
				}
			}
?>
            </select>
            <span class="focus"></span>
          </div>
          <button type="submit" name="search" id="search" class="Ktk"> 
            <i class="icon1 fas fa-search"></i>
          </button>
        </div>
</form>
        <a href="../Main Tab/etc/Main.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
    <header class="banner-used">
    
        </div>
           
    </header>
<div class="box-wrap">
<?php
//Menampilkan daftar tugas sesuai dengan opsi yang dipilih
if (!isset($_GET['l']) || $_GET['l'] == "All"){
	$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$nik' AND Tanggal<='$tgl' OR Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}$id = $row['id_pengumuman'];
	
	echo '
  		<div class="box">
    		<img class="poto" src="Icon.png" alt="poto">
    			<h1 class="gb">'.$judul.'</h1>
    			<h1 class="date">'.$pengiriman.'</h1>
    			<h1 class="to">'.$tujuan.'</h1>
    				<hr>
   			<a href="../unused.php?value=prevpengumuman&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
		</div>
	';
		}
	}
}
	
else if (isset($_GET['l']) && $_GET['l'] == $nik){
	$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='$nik' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_pengumuman'];
	
			if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}
			echo '
  		<div class="box">
    		<img class="poto" src="Icon.png" alt="poto">
    			<h1 class="gb">'.$judul.'</h1>
    			<h1 class="date">'.$pengiriman.'</h1>
    			<h1 class="to">'.$tujuan.'</h1>
    				<hr>
   			<a href="../unused.php?value=prevpengumuman&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
		</div>
	';
		}
	}
}
else if (isset($_GET['l']) && $_GET['l'] == $jabatan){
	$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='$jabatan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_pengumuman'];
	
	echo '
  		<div class="box">
    		<img class="poto" src="Icon.png" alt="poto">
    			<h1 class="gb">'.$judul.'</h1>
    			<h1 class="date">'.$pengiriman.'</h1>
    			<h1 class="to">'.$tujuan.'</h1>
    				<hr>
   			<a href="../unused.php?value=prevpengumuman&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
		</div>
	';
		}
	}
}
	
else if (isset($_GET['l']) == 'globe'){
	$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' AND Tanggal<='$tgl' ORDER BY Tanggal DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$judul = $row['Judul'];
			$pengiriman = $row['Tanggal'];
			$tujuan = $row['Tujuan'];
			$id = $row['id_pengumuman'];
	
	echo '
  		<div class="box">
    		<img class="poto" src="Icon.png" alt="poto">
    			<h1 class="gb">'.$judul.'</h1>
    			<h1 class="date">'.$pengiriman.'</h1>
    			<h1 class="to">'.$tujuan.'</h1>
    				<hr>
   			<a href="../unused.php?value=prevpengumuman&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
		</div>
	';
		}
	}
}
?>
</div>
<p>
<div class="banerr">
<h5> Officia, Copyright 2021. All Right Reserved</h5>
</div>
<!-- <div class="Banner-handap">
    <div class="o">Officia</div>
    <nav class="navbar">
        <a class="toggler-navbar">
            <div class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <div class="sidebar">
            <ul class="inline">
                <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                <li><a href="List-Karyawan.html" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="Banner-handap-used">
    <div class="o">Officia</div>
    <nav class="navbar">
        <a class="toggler-navbar">
            <div class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <div class="sidebar">
            <ul class="inline">
                <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                <li><a href="List-Karyawan.html" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
            </ul>
        </div>
    </nav>
</div> -->

    <script src="script.js"></script>
</body>
</html>
