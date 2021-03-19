<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
require_once("config.php");
if (isset($_SESSION['LOGIN'])){
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];
}
if (isset($_SESSION['LOGIN_ADMIN'])){
$kantor_admin = $_SESSION['kantor_admin'];
$nik_admin = $_SESSION['NIK_admin'];
$pw_admin = $_SESSION['PW_admin'];
	
$Nama_kar = $_GET['kar'];
$NIK_kar = $_GET['nik_kar'];
}
if (!isset($_GET['value'])){	
header("Location: etc/error/index.php?condition=1");
}

else if (isset($_GET['value'])){
if($_GET['value'] == "logout"){
//Menghapus data login dari browser
	if(isset($_SESSION['LOGIN'])){
		unset($_SESSION['LOGIN']);
		unset($_SESSION['nama']);
		unset($_SESSION['umur']);
		unset($_SESSION['jabatan']);
		unset($_SESSION['nik']);
		unset($_SESSION['tel']);
		unset($_SESSION['email']);
		unset($_SESSION['kantor']);
		unset($_SESSION['password']);
	}
	if (isset($_SESSION['condition'])){
		unset($_SESSION['condition']);
	}
	
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	
	header("Location: index.html");
}
else if($_GET['value'] == "logoutad"){
//Menghapus data login dari browser
	if(isset($_SESSION['LOGIN_ADMIN'])){
		unset($_SESSION['LOGIN_ADMIN']);
		unset($_SESSION['kantor_admin']);
		unset($_SESSION['NIK_admin']);
		unset($_SESSION['PW_admin']);
	}
	if (isset($_SESSION['condition'])){
		unset($_SESSION['condition']);
	}
	
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	
	header("Location: index.html");
}
else if($_GET['value'] == "hapuskar "){
	mysqli_query($konek, "DELETE FROM login WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	mysqli_query($konek, "DELETE FROM absen WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	mysqli_query($konek, "DELETE FROM cuti WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	$_SESSION['hapusKaryawan'] = 1;
	header("Location: admin/List-Karyawan.php");
}
	
else if($_GET['value'] == "pengumuman"){
	$_SESSION['Pengumuman'] = 1;
	header("Location: admin/+Pengumuman.php");
}
	
else if($_GET['value'] == "hapuspp"){
	$sql_cek = mysqli_query($konek, "SELECT pp_name FROM login WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
$row = mysqli_fetch_assoc($sql_cek);
$pp_name = $row['pp_name'];
	
	if ($pp_name != "default.png"){
		unlink('Main Tab/etc/upload/image/'.$pp_name);
		mysqli_query($konek, "UPDATE login SET pp_name='default.png' WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		$pp = 'src="upload/image/default.png"';
	}
	$_SESSION['hapusPP'] = 1;
	header("Location: Main Tab/etc/Main.php");
}
	
else if($_GET['value'] == "batalpp"){
	$sql_cek = mysqli_query($konek, "SELECT pp_name FROM login WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
$row = mysqli_fetch_assoc($sql_cek);
$pp_name = $row['pp_name'];
	
	if ($pp_name != "default.png"){
		unlink('Main Tab/etc/upload/image/'.$pp_name);
		mysqli_query($konek, "UPDATE login SET pp_name='default.png' WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		$pp = 'src="upload/image/default.png"';
	}
	header("Location: Main Tab/etc/Main.php");
}
else if($_GET['value'] == "konfirmUbahPP"){
	$_SESSION['ubahPP'] = 1;
	header("Location: Main Tab/etc/Main.php");
}
	
else if($_GET['value'] == "gantiabsen"){
	$_SESSION['ubahabsen'] = 1;
	header("Location: admin/Setting-Absen.php");
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "icon" href ="Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
	
<title>Officia Message</title>
	
<style>
img[alt*="000webhost"],
img[alt*="000webhost"][style],
img[src*="000webhost"],
img[src*="000webhost"][style],
body > div:nth-last-of-type(1)[style]{
	opacity: 0 !important;
	pointer-events:none !important;
	width: 0px !important;
	height: 0px !important;
	visibility:hidden !important;
	display:none !important;
}
</style>
</head>

<body>
redirecting...
	
</body>
</html>
