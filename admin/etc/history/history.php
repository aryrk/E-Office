<?php
require_once("../../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../Login/Loginadmin.php");
	exit ();
}

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

if(isset($_POST['search'])){
	$nama_cek = trim($_POST['nama']);
	$nama = date('Y-m-d',strtotime($nama_cek));
	header("Location: history.php?l=$nama");
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
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $kantor; ?> Administrator</h1>

        <a href="../../Tugas.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<!-- partial:index.partial.html -->
<section class="tampilan">
    <h2 class="h2">Data Pengiriman Tugas</h2>
<form id="form1" name="form1" method="post" action="">
    <div class="wrap" style="z-index: 10000;">
		<label for="nama">Cari Berdasarkan Tanggal Pengiriman</label>
        <div class="search">
        <input type="date" name="nama" id="nama" class="searchTerm" autocomplete="off">
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
                <th>Tanggal Pengiriman</th>
                <th>Isi Tugas</th>
                <th>Tujuan</th>
                <th>Tanggal Tujuan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
<?php
	$sql = mysqli_query($konek, "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor'");
		
				
if (!isset($_GET['l']) || $_GET['l'] == "1970-01-01"){
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' ORDER BY Tanggal DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$tanggal_tujuan = $row['Tanggal'];
					$isi_cek = $row['Isi_Tugas'];
					$tujuan = $row['Tujuan'];
					$tanggal = $row['Submitted_On_Date'];
					$jam = $row['Submitted_On_Hours'];
					
					$cek = strlen($isi_cek);
					if ($cek >= 10){
						$isi_cek2 = substr($isi_cek, 0, 10);
						$a = htmlentities($isi_cek2);
						$isi = $a.'...'. '<a href="../../preview_tugas/preview.php?kantor='.$kantor.'&&nik='.$nik.'&&tanggal='.$tanggal.'&&jam='.$jam.'&&his=1'.'" style="color: blue;"> Selengkapnya...</a>';
					}
					else if ($cek < 10) {
						$isi = $isi_cek;
					}
			echo "<tr><td>" . $tanggal . "</td><td>" . $isi . "</td><td>" . $tujuan . "</td><td>" . $tanggal_tujuan . "</td><td style='padding: 0; background-color: red;'><button style='width: 100%; height: 100%; border: none; color: white; background-color: red; display: block; flex-grow:1;align-items: stretch;'>HAPUS</button></td></tr>";
		}
			}
		}
}
else if (isset($_GET['l'])){
	$l = $_GET['l'];
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Submitted_On_Date='$l' ORDER BY Tanggal DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$tanggal_tujuan = $row['Tanggal'];
					$isi_cek = $row['Isi_Tugas'];
					$tujuan = $row['Tujuan'];
					$tanggal = $row['Submitted_On_Date'];
					$jam = $row['Submitted_On_Hours'];
					
					$cek = strlen($isi_cek);
					if ($cek >= 10){
						$isi_cek2 = substr($isi_cek, 0, 10);
						$a = htmlentities($isi_cek2);
						$isi = $a.'...'. '<a href="../../preview_tugas/preview.php?kantor='.$kantor.'&&nik='.$nik.'&&tanggal='.$tanggal.'&&jam='.$jam.'&&his=1'.'" style="color: blue;"> Selengkapnya...</a>';
					}
					else if ($cek < 10) {
						$isi = $isi_cek;
					}
			echo "<tr><td>" . $tanggal . "</td><td>" . $isi . "</td><td>" . $tujuan . "</td><td>" . $tanggal_tujuan . "</td><td style='padding: 0; background-color: red;'><button style='width: 100%; height: 100%; border: none; color: white; background-color: red; display: block; flex-grow:1;align-items: stretch;'>HAPUS</button></td></tr>";
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
                    <li><a href="../../Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="../../Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
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

    <script src="../script.js"></script>
	<script src="../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
</body>
</html>
