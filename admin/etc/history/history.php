<?php
require_once("../../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../../Login/Loginadmin.php");
	exit ();
}

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

$count_nama_kantor = strlen($kantor);
if ($count_nama_kantor <= 7){
	$nama_kantor = $kantor." Administrator";
}
else {
	$nama_kantor = $kantor;
}

if(isset($_POST['search'])){
	$jenis = trim($_POST['jenis']);
	header("Location: history.php?l=$jenis");
}
if(isset($_POST['search_2'])){
	$date = trim($_POST['date']);
	$date = date('Y-m-d',strtotime($date));
	header("Location: history.php?l=$date&&ldate=$date");
}
if(isset($_POST['reset'])){
	header("Location: history.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Log Pengiriman Tugas</title>
    
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../../../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>

        <a href="../../Tugas.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
<!--Inner-->
<form id="form1" name="form1" method="post" action="">
	<div class="wrap" style="z-index: 10000;">
	<div class="search">
		<select name="jenis" id="jenis">
<?php
			if (!isset($_GET['l']) && !isset($_GET['ldate']) && $_GET['l'] == "All"){
			echo '
				<option value="All" class="searchTerm">Semua Tugas Terkirim</option>
				<option value="Global" class="searchTerm">Tugas Global</option>
				';
			}
			else if (isset($_GET['l']) && !isset($_GET['ldate']) && $_GET['l'] != "All"){
				$cari = $_GET['l'];
			echo '
				<option value="'.$cari.'" class="searchTerm">Tugas '.$cari.'</option>
				<option value="All" class="searchTerm">Semua Tugas Terkirim</option>
				<option value="Global" class="searchTerm">Tugas Global</option>
				';
			}
			else {
			echo '
				<option value="All" class="searchTerm">Semua Tugas Terkirim</option>
				<option value="Global" class="searchTerm">Tugas Global</option>
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
				<option value="'.$jabatan.'">Tugas Bagian '.$jabatan.'</option>
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
				<option value="'.$nik_tujuan.'">Tugas '.$nama.'</option>
			';
		}
			}
		}

if(!isset($_GET['ldate'])){
			echo'
		</select>
		<button type="submit" name="search" id="search" class="searchButton">
			<i class="fa fa-search"></i>
		</button>
		
		<label style="padding: 6px;">Atau</label><input type="date" name="date" id='."date".' value="'.$tgl.'"/>
		<button type="submit" name="search_2" id="search_2" class="searchButton">
			<i class="fa fa-search"></i>
		</button>';
}
else if(isset($_GET['ldate'])){
	$tanggal_cari = $_GET['ldate'];
			echo'
		</select>
		<button type="submit" name="search" id="search" class="searchButton">
			<i class="fa fa-search"></i>
		</button>
		
		<label style="padding: 6px;">Atau</label><input type="date" name="date" id='."date".' value="'.$tanggal_cari.'"/>
		<button type="submit" name="search_2" id="search_2" class="searchButton">
			<i class="fa fa-search"></i>
		</button>';
}
			?>
	</div>
		<br><button type="submit" name="reset" id="reset" class="searchButton_2">Reset Pencarian</button>
		</div>
	</form>
	
<div class="row">
<?php
	if (!isset($_GET['l']) || $_GET['l'] == NULL || $_GET['l'] == "All"){
		$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' ORDER BY Submitted_On_Date DESC;";
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
        			<p><a href="../../../unused.php?value=prevtugas_admin&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
				<p><a href="../../../unused.php?value=deltugas&&id_tugas='.$id.'"><button class="button_hapus" id="button_hapus">HAPUS</button></a></p>
    		</div>
  		</div>
		';
			}
		}
	}
	
	else if ($_GET['l'] == "Global"){
		$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='Seluruh Karyawan' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$judul = $row['Judul'];
				$pengiriman = $row['Submitted_On_Date'];
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
        			<p><a href="../../../unused.php?value=prevtugas_admin&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
				<p><a href="../../../unused.php?value=deltugas&&id_tugas='.$id.'"><button class="button_hapus" id="button_hapus">HAPUS</button></a></p>
    		</div>
  		</div>
		';
			}
		}
	}
	
	else if (isset($_GET['l'])){
		$l = $_GET['l'];
		$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Tujuan='$l' OR Nama_Perusahaan='$kantor' AND Submitted_On_Date='$l' ORDER BY Submitted_On_Date DESC;";
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
        			<p><a href="../../../unused.php?value=prevtugas_admin&&id_tugas='.$id.'"><button class="button" id="button1">Lihat Tugas</button></a></p>
      			</div>
				<p><a href="../../../unused.php?value=deltugas&&id_tugas='.$id.'"><button class="button_hapus" id="button_hapus">HAPUS</button></a></p>
    		</div>
  		</div>
		';
			}
		}
	}
?>
</div>
<!--Inner-->
    
    <div class="Banner-handap">
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
                    <li><a href="../../Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="../../Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="../../+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../../../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="../../List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="../../Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
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
