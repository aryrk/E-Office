<?php
require_once("../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../Login/Loginadmin.php");
	exit ();
}

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
	header("Location: Data-Absen-Karyawan.php?l=$nama");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Data Absensi</title>
    
    <link rel="stylesheet" href="Data-Absen-Karyawan.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>

        <a href="List-Karyawan.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<!-- partial:index.partial.html -->
<section class="tampilan">
    <h2 class="h2">Data Absen Semua Karyawan</h2>
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
                <th>Tanggal</th>
                <th>Jam Absen Masuk</th>
                <th>Jam Absen Pulang</th>
                <th>Terlambat Absen</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
<?php
	$sql = mysqli_query($konek, "SELECT * FROM absen WHERE Nama_Perusahaan='$kantor'");
		
				
if (!isset($_GET['l']) || $_GET['l'] == NULL){
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE Nama_Perusahaan='$kantor' ORDER BY Tanggal DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$data_status = $row['Status'];
					$nama = $row['Nama'];
					
					$color = "yellow";
					if ($data_status == "Terlambat Absen"){
						$color = "red";
					}
					else if ($data_status == "Sudah Absen Masuk" || $data_status == "Absen Terlalu Pagi"){
						$color = "limegreen";
					}
					else if ($data_status == "Sudah Absen"){
						$color = "green";
					}
					$style = 'style="background-color: '.$color.';"';
			echo "<tr><td>" . $nik . "</td><td>" . $nama . "</td><td>" . $row['Tanggal'] . "</td><td>" . $row['Jam_masuk'] . "</td><td>" . $row['Jam_pulang'] . "</td><td>" . $row['Terlambat'] . "</td><td $style>" . $data_status . "</td></tr>";
		}
			}
		}
}
else if (isset($_GET['l'])){
	$l = $_GET['l'];
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE Nama_Perusahaan='$kantor' AND Nama='$l' OR Nama_Perusahaan='$kantor' AND NIK='$l' ORDER BY Tanggal DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$data_status = $row['Status'];
					$nama = $row['Nama'];
			echo "<tr><td>" . $nik . "</td><td>" . $nama . "</td><td>" . $row['Tanggal'] . "</td><td>" . $row['Jam_masuk'] . "</td><td>" . $row['Jam_pulang'] . "</td><td>" . $row['Terlambat'] . "</td><td>" . $data_status . "</td></tr>";
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
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
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
