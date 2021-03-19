<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../../config.php");

session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../Login/Loginadmin.php");
	exit ();
}

$tujuan = $_GET['tujuan'];
$tanggal = $_GET['tanggal'];
$isi = "<p>".$_SESSION['isi']."</p>";

$nik = $_GET['nik'];
$kantor = $_GET['kantor'];
$jam = $_GET['jam'];

if (isset($_GET['his'])){
$A = "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Submitted_On_Date='$tanggal' AND NIK_Admin='$nik' AND Submitted_On_Hours='$jam';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);
$isi_tugas = "<p>".$row['Isi_Tugas']."</p>";
	
}
?>
<!doctype html>
<html>
<head>
<link rel = "icon" href ="../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
<link rel="stylesheet" href="prev.css">
<link rel="stylesheet" href="../../Main Tab/etc/Animate.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Preview</title>
	
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<?php echo $isi; ?>
<?php
if (isset($_GET['his'])){
	echo $isi_tugas.'<br>Diunggah pada: '.$tanggal.' ('.$jam.')';
}
?>
<?php unset($_SESSION['isi']); ?>
	
<p class="back wow fadeInUpBig">#Note: To go back without losing any data, just simply press 'back' button.</p>
</form>
</body>
<script src="../../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
</html>
