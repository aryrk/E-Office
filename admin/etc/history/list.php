<?php
require_once("../../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../../Login/Loginadmin.php");
	exit ();
}

if (isset($_GET['id'])){
	$id_data_tugas = $_GET['id'];
	$_SESSION['id_data_tugas'] = $id_data_tugas;
	header("Location: list.php");
}
else if (!isset($_GET['id']) && isset($_SESSION['id_data_tugas'])){
	$id_data_tugas = $_SESSION['id_data_tugas'];
}
else {
	header("Location: history.php");
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
	header("Location: list.php?l=$nama");
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

        <a href="history.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<!-- partial:index.partial.html -->
<section class="tampilan">
    <h2 class="h2">Data Pengerjaan Tugas</h2>
	
<?php
$A_src = "SELECT Tujuan FROM tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id_data_tugas'";
$result_src = mysqli_query($konek, $A_src);
$row_src = mysqli_fetch_assoc($result_src);
				
$tujuan_saver_src = $row_src['Tujuan'];
	
if (!is_numeric($tujuan_saver_src)){
	echo'
	
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
	';
}
?>
    <div class="table-wrapper">
        <table class="fl-table" border="2" rules="cols">
            <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Sisa Upload</th>
                <th>Status</th>
                <th>Diunggah Pada</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
<?php
$A_jab = "SELECT Tujuan FROM tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id_data_tugas'";
$result_jab = mysqli_query($konek, $A_jab);
$row_jab = mysqli_fetch_assoc($result_jab);
				
$tujuan_saver = $row_jab['Tujuan'];
				
if (!isset($_GET['l']) || $_GET['l'] == NULL){
if ($tujuan_saver == "Seluruh Karyawan"){
	$A = "SELECT NIK, Nama FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
}
else{
	$A = "SELECT NIK, Nama FROM login WHERE Nama_Perusahaan='$kantor' AND Jabatan='$tujuan_saver' OR Nama_Perusahaan='$kantor' AND NIK='$tujuan_saver' ORDER BY Nama DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
}
}
				
else if (isset($_GET['l'])){
	$l = $_GET['l'];
if ($tujuan_saver == "Seluruh Karyawan"){
	$A = "SELECT NIK, Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$l' OR Nama_Perusahaan='$kantor' AND Nama='$l' ORDER BY Nama DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
}
else{
	$A = "SELECT NIK, Nama FROM login WHERE Nama_Perusahaan='$kantor' AND Jabatan='$tujuan_saver' AND NIK='$l' OR Nama_Perusahaan='$kantor' AND Nama='$l' AND NIK='$tujuan_saver' OR Nama_Perusahaan='$kantor' AND Nama='$l' AND Jabatan='$tujuan_saver' ORDER BY Nama DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
}
}
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$nik_kar = $row['NIK'];
			$nama_kar = $row['Nama'];
			
			$status = "<td style='background-color: firebrick; color: white;'>Belum Mengerjakan</td>";
			
			$A_log = "SELECT * FROM kirim_tugas WHERE Nama_Perusahaan='$kantor' AND id_tugas='$id_data_tugas' AND NIK='$nik_kar';";
			$result_log = mysqli_query($konek, $A_log);
			$check_log = mysqli_num_rows($result_log);
				
				if ($check_log > 0){
					$row_log = mysqli_fetch_assoc($result_log);
					$status = "<td style='background-color: limegreen; color: white;'>Sudah Mengerjakan</td>";
					
					$sisa = $row_log['Edit_left'];
					$unggah = $row_log['Submitted_On_Date'];
				}
			else if ($check_log == 0){
				$sisa = 3;
				$unggah = "-";
			}
			
			echo '
			<tr>
                <td>'.$nik_kar.'</td>
                <td>'.$nama_kar.'</td>
                <td>'.$sisa.'</td>
                '.$status.'
                <td>'.$unggah.'</td>
                ';
			if ($status == "<td style='background-color: limegreen; color: white;'>Sudah Mengerjakan</td>"){
			echo
			'
			<td class="button_collumn3" style="padding: 0px;">
			<a href="../../../unused.php?value=prevtugas_admin_data&&id_tugas='.$id_data_tugas.'&&l='.$nik_kar.'"><button class="button_detail3">Lihat Jawaban</button></a>';
			}
			else{
				echo'
				<td>
				';
			}
			echo
			'</td>
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
