<?php
require_once("../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../Login/Loginadmin.php");
	exit ();
}

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

if(isset($_POST['search'])){
	$jenis = trim($_POST['pil']);
	header("Location: hp.php?l=$jenis");
}
if(isset($_POST['search_2'])){
	$date = trim($_POST['tgl']);
	$date = date('Y-m-d',strtotime($date));
	header("Location: hp.php?l=$date&&ldate=$date");
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
    <link rel="stylesheet" href="hpstyle.css">
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
        
        </div>
        <a href="pengumuman.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
    <header class="banner-used">
    
        </div>
           
    </header>
<form id="form1" name="form1" method="post" action="">
    <div class="search">
            <select name="pil" id="pil">
<?php
			if (!isset($_GET['l']) && !isset($_GET['ldate']) && $_GET['l'] == "All"){
			echo '
				<option value="All">Semua Terkirim</option>
				<option value="Global">Pengumuman Global</option>
				';
			}
			else if (isset($_GET['l']) && !isset($_GET['ldate']) && $_GET['l'] != "All"){
				$cari = $_GET['l'];
			echo '
				<option value="'.$cari.'">Pengumuman '.$cari.'</option>
				<option value="All">Semua Terkirim</option>
				<option value="Global">Pengumuman Global</option>
				';
			}
			else {
			echo '
				<option value="All">Semua Terkirim</option>
				<option value="Global">Pengumuman Global</option>
				';
			}

	$sql = mysqli_query($konek, "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Jabatan DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jabatan = $row['Jabatan'];
			echo '
				<option value="'.$jabatan.'">Pengumuman '.$jabatan.'</option>
			';
		}
			}
		}
			
	$sql_nama = mysqli_query($konek, "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql_nama) != 0){
			$A = "SELECT Nama, NIK FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
					$nik_tujuan = $row['NIK'];
			echo '
				<option value="'.$nik_tujuan.'">Pengumuman '.$nama.'</option>
			';
		}
			}
		}
?>
            </select>
            <button type="submit" name="search" id="search" class="Ktk"> 
                <i class="icon1 fas fa-search"></i>
            </button>
              <h6>Atau</h6>
            <input type="date" name="tgl" id="tgl">
            <button type="submit" name="search_2" id="search_2" class="Ktk2"> 
                <i class="icon1 fas fa-search"></i>
              </button>
    </div>
</form>
    <a href="hp.php"><button class="Rp">
        <h1>Reset Pencarian</h1>
    </button></a>
    <!-- <div class="search">
        <div class="select">
            <select id="standard-select">
              <option value="Semua Pengumuman Terkirim">Semua Pengumuman Terkirim</option>
              <option value="Pengumuman Bagian">Pengumuman Bagian</option>
              <option value="Pengumuman Pribadi">Pengumuman Pribadi</option>
              <option value="Pengumuman Global">Pengumuman Global</option>
            </select>
            <span class="focus"></span>
          </div> -->
<div class="box-wrap">
<?php
	if (!isset($_GET['l']) || $_GET['l'] == NULL || $_GET['l'] == "All"){
		$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$judul = $row['Judul'];
				$pengiriman = $row['Submitted_On_Date'];
				$tujuan = $row['Tujuan'];
				if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}
				$id = $row['id_pengumuman'];
				
				echo '
  		<div class="box">
    <img class="poto" src="Icon.png" alt="poto">
    <h1 class="gb">'.$judul.'</h1>
    <h1 class="date">'.$pengiriman.'</h1>
    <h1 class="to">'.$tujuan.'</h1>
    <hr>
   <a href="../unused.php?value=prevpengumuman_ad&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
   <a href="../unused.php?value=delpengumuman&&id_pengumuman='.$id.'"><button class="hps">Hapus</button></a>
</div>
		';
			}
		}
	}
	
	else if ($_GET['l'] == "Global"){
		$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$judul = $row['Judul'];
				$pengiriman = $row['Submitted_On_Date'];
				$tujuan = $row['Tujuan'];
				$id = $row['id_pengumuman'];
				
				echo '
  		<div class="box">
    <img class="poto" src="Icon.png" alt="poto">
    <h1 class="gb">'.$judul.'</h1>
    <h1 class="date">'.$pengiriman.'</h1>
    <h1 class="to">'.$tujuan.'</h1>
    <hr>
   <a href="../unused.php?value=prevpengumuman_ad&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
   <a href="../unused.php?value=delpengumuman&&id_pengumuman='.$id.'"><button class="hps">Hapus</button></a>
</div>
		';
			}
		}
	}
	
	else if (isset($_GET['l'])){
		$l = $_GET['l'];
		$A = "SELECT * FROM pengumuman WHERE Nama_Perusahaan='$kantor' AND Tujuan='$l' OR Nama_Perusahaan='$kantor' AND Submitted_On_Date='$l' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$judul = $row['Judul'];
				$pengiriman = $row['Submitted_On_Date'];
				$tujuan = $row['Tujuan'];
				if(is_numeric($tujuan)){
					$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
					$result_nama = mysqli_query($konek, $A_nama);
					$row_nama = mysqli_fetch_assoc($result_nama);
					
					$tujuan = $row_nama['Nama'];
				}
				$id = $row['id_pengumuman'];
				
				echo '
  		<div class="box">
    <img class="poto" src="Icon.png" alt="poto">
    <h1 class="gb">'.$judul.'</h1>
    <h1 class="date">'.$pengiriman.'</h1>
    <h1 class="to">'.$tujuan.'</h1>
    <hr>
   <a href="../unused.php?value=prevpengumuman_ad&&id_pengumuman='.$id.'"><button class="btr">Lihat Pengumuman</button></a>
   <a href="../unused.php?value=delpengumuman&&id_pengumuman='.$id.'"><button class="hps">Hapus</button></a>
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
