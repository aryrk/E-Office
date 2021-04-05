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
	if (isset($_SESSION['first_cuti'])){
		unset($_SESSION['first_cuti']);
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
		$sql_cek = mysqli_query($konek, "SELECT pp_name FROM login WHERE NIK='$NIK_kar' AND Nama_Perusahaan='$kantor_admin' AND Nama='$Nama_kar'");
		$row = mysqli_fetch_assoc($sql_cek);
		$pp_name = $row['pp_name'];
	
		if ($pp_name != "default.png"){
			unlink('Main Tab/etc/upload/image/'.$pp_name);
			mysqli_query($konek, "UPDATE login SET pp_name='default.png' WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		}
	
	
	mysqli_query($konek, "DELETE FROM login WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	mysqli_query($konek, "DELETE FROM absen WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	mysqli_query($konek, "DELETE FROM cuti WHERE Nama='$Nama_kar' AND Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	mysqli_query($konek, "DELETE FROM pengumuman WHERE Tujuan='$NIK_kar' AND Nama_Perusahaan='$kantor_admin';");
	
	$A = "SELECT id_tugas FROM tugas WHERE Nama_Perusahaan='$kantor_admin' ORDER BY Submitted_On_Date DESC;";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$id_pengiriman = $row['id_tugas'];
			
			$A_del = "SELECT id_tugas FROM kirim_tugas WHERE Nama_Perusahaan='$kantor_admin' AND id_tugas='$id_pengiriman' AND NIK='$NIK_kar' ORDER BY Submitted_On_Date DESC;";
			$result_del = mysqli_query($konek, $A_del);
			$check_del = mysqli_num_rows($result_del);
				
			if ($check_del > 0){
				while ($row_del = mysqli_fetch_assoc($result_del)){
					$del_folder = $row_del['id_tugas'];
					
					$files = glob("Main Tab/etc/tugas/uploads/".$NIK_kar.$del_folder."/*"); // get all file names
						foreach($files as $file){ // iterate files
  					if(is_file($file)) {
						unlink($file); // delete file
  					}
						}
					rmdir("Main Tab/etc/tugas/uploads/".$NIK_kar.$del_folder);
				}
			}
		}
	}
	mysqli_query($konek, "DELETE FROM kirim_tugas WHERE Nama_Perusahaan='$kantor_admin' AND NIK='$NIK_kar';");
	
	mysqli_query($konek, "DELETE FROM tugas WHERE Tujuan='$NIK_kar' AND Nama_Perusahaan='$kantor_admin';");
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

else if($_GET['value'] == "prevtugas"){
	$_SESSION['id_tugas'] = $_GET['id_tugas'];
	$_SESSION['l_back'] = $_GET['l'];
	header("Location: Main Tab/etc/tugas/detail.php");
}
else if($_GET['value'] == "tugas_kembali"){
	unset($_SESSION['id_tugas']);
	$l = $_SESSION['l_back'];
	unset($_SESSION['l_back']);
	
	if ($l == "All"){
		header("Location: Main Tab/etc/tugas/tugas.php");
	}
	else {
		header("Location: Main Tab/etc/tugas/tugas.php?l=$l");
	}
}
else if($_GET['value'] == "cuti"){
	unset($_SESSION['cuti']);
	header("Location: Absensi/Cuti.php");
}
else if($_GET['value'] == "hapusCuti"){
	$id = $_GET['idCuti'];
	$_SESSION['hapusCuti'] = 1;
	
	mysqli_query($konek, "DELETE FROM cuti WHERE id='$id';");
	header("Location: Absensi/Cuti.php");
}
else if($_GET['value'] == "terimaCuti"){
	$id = $_GET['idCuti'];
	$_SESSION['terimaCuti'] = 1;
	
	mysqli_query($konek, "UPDATE cuti SET Status='Diterima' WHERE id='$id'");
	header("Location: admin/Izin-Cuti.php");
}
else if($_GET['value'] == "tolakCuti"){
	$id = $_GET['idCuti'];
	$_SESSION['tolakCuti'] = 1;
	
	mysqli_query($konek, "UPDATE cuti SET Status='Ditolak' WHERE id='$id'");
	header("Location: admin/Izin-Cuti.php");
}
else if($_GET['value'] == "deltugas"){
	$id = $_GET['id_tugas'];
	$_SESSION['deltugas'] = 1;
			
	$A_del = "SELECT NIK, id_tugas FROM kirim_tugas WHERE Nama_Perusahaan='$kantor_admin' AND id_tugas='$id' ORDER BY Submitted_On_Date DESC;";
	$result_del = mysqli_query($konek, $A_del);
	$check_del = mysqli_num_rows($result_del);
				
		if ($check_del > 0){
			while ($row_del = mysqli_fetch_assoc($result_del)){
				$del_folder = $row_del['id_tugas'];
				$nik_karyawan = $row_del['NIK'];
					
				$files = glob("Main Tab/etc/tugas/uploads/".$nik_karyawan.$del_folder."/*"); // get all file names
				foreach($files as $file){ // iterate files
  					if(is_file($file)) {
						unlink($file); // delete file
  					}
						}
					rmdir("Main Tab/etc/tugas/uploads/".$nik_karyawan.$del_folder);
				}
			}
	mysqli_query($konek, "DELETE FROM kirim_tugas WHERE Nama_Perusahaan='$kantor_admin' AND id_tugas='$id';");
	mysqli_query($konek, "DELETE FROM tugas WHERE id_tugas='$id'");
	header("Location: admin/etc/history/history.php");
}
else if($_GET['value'] == "delpengumuman"){
	$id = $_GET['id_pengumuman'];
	
	mysqli_query($konek, "DELETE FROM pengumuman WHERE id_pengumuman='$id'");
	header("Location: Pengumuman/hp.php");
}
else if($_GET['value'] == "prevtugas_admin"){
	$_SESSION['id_tugas'] = $_GET['id_tugas'];
	header("Location: admin/etc/history/detail.php");
}
else if($_GET['value'] == "prevtugas_admin_data"){
	$_SESSION['id_tugas'] = $_GET['id_tugas'];
	$l = $_GET['l'];
	header("Location: admin/etc/history/detail.php?l=".$l);
}
	
else if($_GET['value'] == "prevpengumuman"){
	$_SESSION['id_pengumuman'] = $_GET['id_pengumuman'];
	header("Location: Pengumuman/BP.php");
}
else if($_GET['value'] == "prevpengumuman_ad"){
	$_SESSION['id_pengumuman'] = $_GET['id_pengumuman'];
	header("Location: Pengumuman/BP_admin.php");
}
else if($_GET['value'] == "pengumuman_kembali"){
	unset($_SESSION['id_pengumuman']);
	header("Location: Pengumuman/pengumuman.php");
}
else if($_GET['value'] == "pengumuman_kembali_admin"){
	unset($_SESSION['id_pengumuman']);
	header("Location: Pengumuman/hp.php");
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
