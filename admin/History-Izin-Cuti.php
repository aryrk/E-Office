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

$count_nama_kantor = strlen($kantor);
if ($count_nama_kantor <= 7){
	$nama_kantor = $kantor." Administrator";
}
else {
	$nama_kantor = $kantor;
}

if(isset($_POST['search'])){
	$nama = trim($_POST['nama']);
	header("Location: History-Izin-Cuti.php?l=$nama");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>History Izin Cuti</title>
    
    <link rel="stylesheet" href="History-Izin-Cuti.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor ?></h1>

        <a href="Izin-Cuti.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<!-- partial:index.partial.html -->
<section class="tampilan">
    <h2 class="h2">Data Cuti Semua Karyawan</h2>
<form id="form1" name="form1" method="post" action="">
    <div class="wrap">
        <div class="search">
        <input type="text" name="nama" id="nama" class="searchTerm" placeholder="Cari Nama Lengkap/NIK..." autocomplete="off">
        <button type="submit" name="search" id="search" class="searchButton">
            <i class="fa fa-search"></i>
        </button>
        </div>
    </div>
	</form>
    <div class="table-wrapper">
        <table class="fl-table" border="2" rules="cols">
            <thead>
            <tr>
                <th>NIK / ID</th>
                <th>Nama</th>
                <th>Jenis Cuti</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Diunggah Pada</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
<?php
	$sql = mysqli_query($konek, "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Status='Diterima' OR Nama_Perusahaan='$kantor' AND Status='Ditolak' OR Nama_Perusahaan='$kantor' AND Sampai<'$tgl'");
		
				
if (!isset($_GET['l']) || $_GET['l'] == NULL){
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Status='Diterima' OR Nama_Perusahaan='$kantor' AND Status='Ditolak' OR Nama_Perusahaan='$kantor' AND Sampai<'$tgl' ORDER BY Submitted_On_Date DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nik_kar = $row['NIK'];
					$nama = $row['Nama'];
					$jenis = $row['Jenis_Cuti'];
					$dari = $row['Dari'];
					$sampai = $row['Sampai'];
					$keterangan = $row['Keterangan'];
					$stat = $row['Status'];
					$upload = $row['Submitted_On_Date'];
					
					$aktif = "";
					
					$color_stat = "yellow";
				
					if ($stat == "Diterima"){
						$color_stat = "limegreen";
						
						if($dari > $tgl){
							$aktif = "Belum Aktif";
						}
						else if($dari <= $tgl && $sampai >= $tgl){
							$aktif = "Aktif";
						}
						else if($sampai < $tgl){
							$aktif = "Kadaluarsa";
						}
					}
					else if ($stat == "Ditolak"){
						$color_stat = "red";
						$aktif = "Tidak Aktif";
					}
					else if ($stat == "unknown"){
						$aktif = "Kadaluarsa";
					}
					$style_stat = 'Style="background-color:'.$color_stat.';"';
					
					echo'
				<tr>
                    <td>'.$nik_kar.'</td>
                    <td>'.$nama.'</td>
                    <td>'.$jenis.'</td>
                    <td>'.$dari.'</td>
                    <td>'.$sampai.'</td>
                    <td>'.$keterangan.'</td>
                    <td '.$style_stat.'>'.$stat.'</td>
                    <td>'.$upload.'</td>
                    <td>'.$aktif.'</td>
                </tr>
					';
				}
			}
		}
}
			
else if (isset($_GET['l'])){
	$l = $_GET['l'];
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM (SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Status='Diterima' OR Nama_Perusahaan='$kantor' AND Status='Ditolak' OR Nama_Perusahaan='$kantor' AND Sampai<'$tgl') as Jumlah WHERE Nama='$l' OR NIK='$l' ORDER BY Submitted_On_Date DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nik_kar = $row['NIK'];
					$nama = $row['Nama'];
					$jenis = $row['Jenis_Cuti'];
					$dari = $row['Dari'];
					$sampai = $row['Sampai'];
					$keterangan = $row['Keterangan'];
					$stat = $row['Status'];
					$upload = $row['Submitted_On_Date'];
					
					$aktif = "";
					
					$color_stat = "yellow";
				
					if ($stat == "Diterima"){
						$color_stat = "limegreen";
						
						if($dari > $tgl){
							$aktif = "Belum Aktif";
						}
						else if($dari <= $tgl && $sampai >= $tgl){
							$aktif = "Aktif";
						}
						else if($sampai < $tgl){
							$aktif = "Kadaluarsa";
						}
					}
					else if ($stat == "Ditolak"){
						$color_stat = "red";
						$aktif = "Tidak Aktif";
					}
					else if ($stat == "unknown"){
						$aktif = "Kadaluarsa";
					}
					$style_stat = 'Style="background-color:'.$color_stat.';"';
					
					echo'
				<tr>
                    <td>'.$nik_kar.'</td>
                    <td>'.$nama.'</td>
                    <td>'.$jenis.'</td>
                    <td>'.$dari.'</td>
                    <td>'.$sampai.'</td>
                    <td>'.$keterangan.'</td>
                    <td '.$style_stat.'>'.$stat.'</td>
                    <td>'.$upload.'</td>
                    <td>'.$aktif.'</td>
                </tr>
					';
				}
			}
		}
}
?>
            </tbody>
        </table>
    </div>
</section>
<!-- partial -->
    
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
                    <li><a href="Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
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
                    <li><a href="Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="../script.js"></script>
	<script src="../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
</body>
</html>
