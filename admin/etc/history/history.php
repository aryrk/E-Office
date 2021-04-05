<?php
require_once("../../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../../Login/Loginadmin.php");
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
    <title>Data Tugas</title>
    
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../../../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../../Main Tab/etc/Animate.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>

        <a href="../../Tugas.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<!-- partial:index.partial.html -->
<section class="tampilan">
    <h2 class="h2">Data Pengerjaan Tugas</h2>
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
                <th>ID Tugas</th>
                <th>Judul</th>
                <th>Tanggal Pengiriman</th>
                <th>Tujuan</th>
                <th>Dikerjakan Oleh</th>
                <th>Aksi 1</th>
                <th>Aksi 2</th>
            </tr>
            </thead>
            <tbody>
<?php
$A = "SELECT * FROM tugas WHERE NIK_Admin='$nik' AND Nama_Perusahaan='$kantor' ORDER BY Tanggal DESC;";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$id_tugas = $row['id_tugas'];
			$judul_tugas = $row['Judul'];
			$tanggal_tugas = $row['Tanggal'];
			$tujuan_tugas = $row['Tujuan'];
			
			$A_count = "SELECT COUNT(id_laporan) FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id_tugas' ORDER BY Submitted_On_Hours DESC;";
			$result_count = mysqli_query($konek, $A_count);
			$row_count = mysqli_fetch_assoc($result_count);
			
			$jumlah_orang = $row_count['COUNT(id_laporan)'];
			
			if ($jumlah_orang == 0){
				$jumlah_orang = "Belum ada";
			}
			else {
				$jumlah_orang = $jumlah_orang." Pegawai";
			}
			
			echo '
			<tr>
                <td>'.$id_tugas.'</td>
                <td>'.$judul_tugas.'</td>
                <td>'.$tanggal_tugas.'</td>
                <td>'.$tujuan_tugas.'</td>
                <td>'.$jumlah_orang.'</td>
                <td class="button_collumn" style="padding: 0px;"><a href="../../../unused.php?value=prevtugas_admin&&id_tugas='.$id_tugas.'"><button class="button_detail">Lihat Detail</button></a></td>
                <td class="button_collumn2" style="padding: 0px;"><a href="../../../unused.php?value=deltugas&&id_tugas='.$id_tugas.'"><button class="button_detail2">Hapus</button></a></td>
            </tr>
			';
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
                    <li><a href="../../Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="../../Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="../../+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../../../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="../../List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="../../Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="../script.js"></script>
	<script src="../Main Tab/etc/wow.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	new WOW().init();
</script>
	
<?php
if (isset($_SESSION['deltugas'])){
	echo "<script> deltugas(); </script>";
		unset($_SESSION['deltugas']);
}
?>
</body>
</html>
