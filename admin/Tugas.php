<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];

$tgl = date("Y-m-d");
$jam = date("H:i:s");

if(isset($_POST['SET_ABSEN'])){
	header("Location: Setting-Absen.php?kantor=$kantor && nik=$nik && password=$pw");
}
if(isset($_POST['PENGUMUMAN'])){
	header("Location: +Pengumuman.php?kantor=$kantor && nik=$nik && password=$pw");
}

if(isset($_POST['kirim'])){
	$tujuan = trim($_POST['tujuan']);
	$tanggal = $_POST["time"];
	$isi = trim($_POST['isi']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama_Admin'];
					
					$sql = mysqli_query($konek, "INSERT INTO tugas VALUES ('$kantor','$nama','$nik','$tanggal','$isi','$tujuan','$jam','$tgl')");
				}
			}
		}
	}
if(isset($_POST['prev'])){
	$tujuan = trim($_POST['tujuan']);
	$tanggal = $_POST["time"];
	$isi = trim($_POST['isi']);
		
	header("Location: preview_tugas/preview.php?tujuan=$tujuan && tanggal=$tanggal && isi=$isi");
	}
if(isset($_POST['DAFTAR'])){
	header("Location: ../Login/regis.php?kantor=$kantor && nik=$nik && password=$pw");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Tambah Tugas</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="etc/style.css">
<link rel="stylesheet" href="../Main Tab/etc/Animate.css">
</head>

<body>

<!--Used Navigation-->
<nav id="navigation">
		<div class="logo1">
	<h3>Officia Administrator</h3>
</nav>
	</div>
<form id="form1" name="form1" method="post" action="">
<section class="tugas_box wow fadeInDown">
		<center><h1 class="judul wow zoomIn">Tambah Tugas</h1></center>
	<hr class="wow jackInTheBox">
	<div class="inner wow fadeIn">
<label for="tujuan" class="wow slideInLeft">Akan Dikirimkan Kepada</label>
 	<select name="tujuan" id="tujuan" class="tujuan wow slideInUp">
		<option value="Seluruh Karyawan">Seluruh Karyawan</option>
		<option value="Satpam">Satpam</option>
		<option value="OB">OB</option>
		<option value="Sekertaris">Sekertaris</option>
		<option value="Akutansi">Akutansi</option>
		<option value="Desain">Desain</option>
		<option value="IT">IT</option>
	</select>
		
		<label for="time" class="wow slideInLeft"> Pada Tanggal</label>
		<input class="tujuan wow slideInUp" type="date" name="time" id="time" min="<?php echo $tgl ?>" value="<?php echo $tgl ?>">
		
		<label for="isi" class="wow slideInLeft"> Dan Berisi:</label><br>
		<textarea name="isi" id="isi" rows="2" placeholder="Isi tugas (Styling with Markdown is supported)" required></textarea>
		<center><button type="submit" class="sumbit wow bounce" value="Kirim" id="kirim" name="kirim">Kirim</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="sumbit wow bounce" value="Preview" id="prev" name="prev">Preview</button></center>
	</div>
</section>
</form>
	
	
<div class="Banner-handap">
            <div class="o">Officia</div>
		   <form id="form2" name="form2" method="post" action="">
            <ul class="inline">
                <li><button style="background-color: transparent;border: none;" type="submit" name="SET_ABSEN" id="SET_ABSEN" value="set_absen"><a class="absen"><a class="mobile">Setting Absen</a><i class="logo fas fa-calendar-check absenl"></i></a></button></li>
				<li><a class="cuti"><a class="mobile">Izin Cuti</a><i class="logo fas fa-calendar-minus cutil"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="PENGUMUMAN" id="PENGUMUMAN" value="pengumuman"><a class="pengumuman"><a class="mobile">Pengumuman</a><i class="logo fas fa-bullhorn pengumumanl"></i> </a></button></li>
				<li><button style="background-color: transparent;border: none;" type="submit" name="DAFTAR" id="DAFTAR" value="daftar"><a class="karyawan"><a class="karyawan"><a class="mobile">+Karyawan</a><i class="logo fas fa-id-card karyawanl"></i></a></button></li>
				<li><a href="" class="list-karyawan"><a class="mobile">List Karyawan</a><i class="logo fas fa-tasks listl"></i></a></li>
				<li><a href="" class="tugas"><a class="mobile">Tugas</a><i class="logo fas fa-briefcase tugasl"></i></a></li>
            </ul>
		   </form>
        </div>

<script src="etc/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
