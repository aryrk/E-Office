<?php
session_start();
require_once("config.php");

if (!isset($_GET['value'])){	
header("Location: etc/error/index.php?condition=1");
exit();
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
	exit();
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
