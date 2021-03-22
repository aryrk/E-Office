<?php
session_start();

if (!isset($_SESSION['forgot'])){
	header("Location: Forgotpassdesign.php");
	exit ();
}

$captcha = $_GET["3"];
$angka1 = $_GET["1"];
$angka2 = $_GET["2"];

$cek = $angka1 + $angka2;
if ($captcha != $cek) {
	header("Location: ../etc/error/index.php?condition=17&&1=$angka1&&2=$angka2&&3=$captcha");
}
	else {
		$_SESSION['NIK_Lupa'] = $_GET['nik'];
		$_SESSION['Mail_Lupa'] = $_GET['mail'];
		$_SESSION['Telp_Lupa'] = $_GET['telp'];
		$_SESSION['Hari_Lupa'] = $_GET['hari'];
		$_SESSION['Bulan_Lupa'] = $_GET['bln'];
		$_SESSION['Tahun_Lupa'] = $_GET['thn'];
		
		header("Location: newpassform.php");
	}
?>
