<?php
session_start();
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
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
		header("Location: index.html");
	exit();
	}

require_once("config.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>logout</title>
</head>

<body>
redirecting...
</body>
</html>
