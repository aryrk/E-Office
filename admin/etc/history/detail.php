<?php
require_once("../../../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../../Login/Loginadmin.php");
	exit ();
}
if (!isset($_SESSION['id_tugas'])){
	header("Location: history.php");
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

$A = "SELECT Nama_Admin FROM data_perusahaan WHERE NIK_Admin='$nik' AND Nama_Perusahaan='$kantor' AND Password='$pw';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);

$nama = $row['Nama_Admin'];

$id_tugas = $_SESSION['id_tugas'];

if(isset($_POST['search'])){
	$nama = trim($_POST['nama']);
	header("Location: detail.php?l=$nama");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Preview Tugas</title>
    
    <link rel="stylesheet" href="../../preview_tugas/prev.css">
	<link rel="stylesheet" href="../../../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../../Main Tab/etc/Animate.css">
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor ?></h1>
        <a href="history.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
<!--Inner-->
<?php
$A = "SELECT * FROM tugas WHERE NIK_Admin='$nik' AND Nama_Perusahaan='$kantor' AND id_tugas='$id_tugas';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);
			
$judul_tugas = $row['Judul'];
$isi_tugas = $row['Isi_Tugas'];
$tujuan_tugas = $row['Tujuan'];
$tanggal_tugas = date("D - d/m/Y", strtotime($row['Tanggal']));
$deadline_tugas = date("D - d/m/Y", strtotime($row['Deadline']));
			
if ($tgl >= $row['Tanggal'] && $tgl <= $row['Deadline']){
	$status_tugas = "Aktif";
}
else if ($tgl < $row['Tanggal'] && $tgl <= $row['Deadline']){
	$status_tugas = "Belum Terkirim";
}
else if ($tgl >= $row['Tanggal'] && $tgl > $row['Deadline']){
	$status_tugas = "Kadaluarsa";
}
?>
<div class="row">
  		<div class="column">
    		<div class="card">
				
        			<center><h2 class="judul"><?php echo $judul_tugas; ?></h2></center>
				<div class="container">
		  			<div class="textB">
        			<p><?php echo $kantor; ?> Company</p>
			  		</div>
					
					<div class="box_shadow">
  						<div class="box_container">
							<?php echo $isi_tugas; ?>
  						</div>
					</div>
					<p><?php echo $nama." - ".$tujuan_tugas; ?><br><?php echo "(".$tanggal_tugas.") - (".$deadline_tugas.")" ?></p>
					<br><p>Status: <?php echo $status_tugas; ?></p>
        			<p><a href="history.php"><button class="button" id="button1">Back</button></a></p>
      			</div>
    		</div>
  		</div>
	</div>
<!--Inner-->
<!--Jawaban publik-->
<?php
if (!isset($_GET['l']) || $_GET['l'] == NULL){
	
$A = "SELECT * FROM kirim_tugas WHERE id_tugas='$id_tugas' AND Nama_Perusahaan='$kantor' ORDER BY Submitted_On_Date DESC;";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
if ($check > 0){
	echo '
<hr style="margin-bottom: 10px; margin-top: 10px;">
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
	while ($row = mysqli_fetch_assoc($result)){
		$nik_public = $row['NIK'];
		$sql_cek = mysqli_query($konek, "SELECT pp_name, Nama FROM login WHERE NIK='$nik_public' AND Nama_Perusahaan='$kantor'");
		$row_pp = mysqli_fetch_assoc($sql_cek);
		$pp_name = $row_pp['pp_name'];
		$pp = 'src="../../../Main Tab/etc/upload/image/'.$pp_name.'"';
		
		$nama_public = $row_pp['Nama'];
		
		$isi_laporan = $row['Laporan'];
		$nama_file = $row['file_name'];
		$dir_to_file = "../../../Main Tab/etc/tugas/".$row['dir_to_file'];
		$diupload_pada = date("D - d/m/Y", strtotime($row['Submitted_On_Date']));
		
		$file_saver = $row['is_file'];
		if ($file_saver == true){
			$file_dir = '<a href="'.$dir_to_file.'" target="_blank" style="color: blue; text-decoration: underline;"><p>'.$nama_file.'</p></a>';
		}
		else {
			$file_dir = '<p></p>';
		}
		$edit_detect = $row['Edit_left'];
		
		if($edit_detect < 2){
			$diupload_pada = $diupload_pada." (edited)";
		}
		
		echo '
		<div class="row">
  		<div class="column">
    		<div class="card">
				<div class="container">
					<table>
			<tr>
				<td rowspan="2">
					<div class="textB">
        			<p>'.$nama_public.'</p>
			  		</div>
				</td>
			</tr>
	  		<tr style="padding: 0px; margin: 0px;">
    			<td rowspan="2"><img '.$pp.' alt="" draggable="false" style="overflow: hidden" width="100px;"></td>
  			</tr>
			<tr>
				<td class="laporan">
					
  						<div class="box_shadow">
  						<div class="box_container">
							'.$isi_laporan.'
  						</div>
					</div>
					'.$file_dir.'
					</td>
			</tr>
			<tr>
				<td>
					<p style="margin-bottom: 10px;">'.$diupload_pada.'</p>
				</td>
			</tr>
					</table>
      			</div>
    		</div>
  		</div>
	</div>
		';
	}
}
}
	
else if (isset($_GET['l'])){
	$l = $_GET['l'];
	
echo '
<hr style="margin-bottom: 10px; margin-top: 10px;">
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
	
$A = "SELECT * FROM kirim_tugas WHERE id_tugas='$id_tugas' AND Nama_Perusahaan='$kantor' AND Pengirim='$l' OR id_tugas='$id_tugas' AND Nama_Perusahaan='$kantor' AND NIK='$l' ORDER BY Submitted_On_Date DESC;";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
if ($check > 0){
	while ($row = mysqli_fetch_assoc($result)){
		$nik_public = $row['NIK'];
		$sql_cek = mysqli_query($konek, "SELECT pp_name, Nama FROM login WHERE NIK='$nik_public' AND Nama_Perusahaan='$kantor'");
		$row_pp = mysqli_fetch_assoc($sql_cek);
		$pp_name = $row_pp['pp_name'];
		$pp = 'src="../../../Main Tab/etc/upload/image/'.$pp_name.'"';
		
		$nama_public = $row_pp['Nama'];
		
		$isi_laporan = $row['Laporan'];
		$nama_file = $row['file_name'];
		$dir_to_file = "../../../Main Tab/etc/tugas/".$row['dir_to_file'];
		$diupload_pada = date("D - d/m/Y", strtotime($row['Submitted_On_Date']));
		
		$file_saver = $row['is_file'];
		if ($file_saver == true){
			$file_dir = '<a href="'.$dir_to_file.'" target="_blank" style="color: blue; text-decoration: underline;"><p>'.$nama_file.'</p></a>';
		}
		else {
			$file_dir = '<p></p>';
		}
		
		echo '
		<div class="row">
  		<div class="column">
    		<div class="card">
				<div class="container">
					<table>
			<tr>
				<td rowspan="2">
					<div class="textB">
        			<p>'.$nama_public.'</p>
			  		</div>
				</td>
			</tr>
	  		<tr style="padding: 0px; margin: 0px;">
    			<td rowspan="2"><img '.$pp.' alt="" draggable="false" style="overflow: hidden" width="100px;"></td>
  			</tr>
			<tr>
				<td class="laporan">
					
  						<div class="box_shadow">
  						<div class="box_container">
							'.$isi_laporan.'
  						</div>
					</div>
					'.$file_dir.'
					</td>
			</tr>
			<tr>
				<td>
					<p style="margin-bottom: 10px;">'.$diupload_pada.'</p>
				</td>
			</tr>
					</table>
      			</div>
    		</div>
  		</div>
	</div>
		';
	}
}
}
?>
    
    <div class="Banner-handap">
        <div class="o">Officia</div>
        <nav class="navbar">
            <a class="toggler-navbar">
            </a>
            <div class="sidebar">
                <ul class="inline">
                    <li><a href="../../Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="../../Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="../../+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../../../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
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
            </a>
            <div class="sidebar">
                <ul class="inline">
                    <li><a href="../../Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="../../Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="../../+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../../../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="../../List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="../../Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="../script.js"></script>
	<script src="../../../Main Tab/etc/wow.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="../../../etc/allert.js"></script>
<script>
	new WOW().init();
</script>
</body>
</html>
