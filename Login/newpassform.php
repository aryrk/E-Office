<?php
require_once("../config.php");
session_start();
if (!isset($_SESSION['forgot'])){
	header("Location: Forgotpassdesign.php");
	exit ();
}

$NIK = $_SESSION['NIK_Lupa'];
$Mail = $_SESSION['Mail_Lupa'];
$Telp = $_SESSION['Telp_Lupa'];
$Hari = $_SESSION['Hari_Lupa'];
$Bulan = $_SESSION['Bulan_Lupa'];
$Tahun = $_SESSION['Tahun_Lupa'];

$A_cek = "SELECT Pertanyaan, Jawaban FROM login WHERE NIK='$NIK' AND Email='$Mail' AND Tanggal_Lahir='$Hari' AND Bulan_Lahir='$Bulan' AND Tahun_Lahir='$Tahun' AND No_Telp='$Telp';";
$result_cek = mysqli_query($konek, $A_cek);	
$row_cek = mysqli_fetch_assoc($result_cek);

$pertanyaan = $row_cek['Pertanyaan'];
$jawaban = $row_cek['Jawaban'];

if ($pertanyaan == 0){
	$pertanyaan = "Masukkan Jawaban Pertanyaan Sebelumnya:";
}
else if ($pertanyaan == 1){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Apa Pekerjaan Impianmu:";
}
else if ($pertanyaan == 2){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Makanan Terlezat Di Dunia:";
}
else if ($pertanyaan == 3){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Harta Karun Masa Kecil:";
}
else if ($pertanyaan == 4){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Hobimu:";
}
else if ($pertanyaan == 5){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Tempat Favoritmu:";
}
else if ($pertanyaan == 6){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Nama Ibumu:";
}
else if ($pertanyaan == 7){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Nama Panggilan Sahabat Masa Kecilmu:";
}
else if ($pertanyaan == 8){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Warna Pakaian Yang Dipakai Saat Melakukan Pendaftaran:";
}
else if ($pertanyaan == 9){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Peristiwa Menyenangkan Dalam Hidupmu:";
}
else if ($pertanyaan == 10){
	$pertanyaan = "*Pertanyaan Keamanan*<br>Sebutkan Apa Yang Harus Dirahasiakan Dari Keluarga:";
}

if(isset($_POST['SUBMIT'])){
	$jawaban_user = trim($_POST['jawab']);
	$pass_baru = trim($_POST['pass']);
	
	if($jawaban != $jawaban_user){
		header("Location: ../etc/error/index.php?condition=22");
	}
	else if($jawaban == $jawaban_user){
		unset($_SESSION['NIK_Lupa']);
		unset($_SESSION['Mail_Lupa']);
		unset($_SESSION['Telp_Lupa']);
		unset($_SESSION['Hari_Lupa']);
		unset($_SESSION['Bulan_Lupa']);
		unset($_SESSION['Tahun_Lupa']);
		unset($_SESSION['forgot']);
		
		$_SESSION['gantipw'] = 1;
		
		mysqli_query($konek, "UPDATE login SET Password='$pass_baru' WHERE NIK='$NIK' AND Email='$Mail' AND Tanggal_Lahir='$Hari' AND Bulan_Lahir='$Bulan' AND Tahun_Lahir='$Tahun' AND No_Telp='$Telp'");
		
		header("Location: login1.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Create New Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="newpassform.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
		<form id="form1" name="form1" method="post" action="">
	<p>
<label for="jawab"><?php echo $pertanyaan; ?></label>
<input type="text" name="jawab" id="jawab" autocomplete="off"
placeholder="Ketik Jawaban" class="nik" required><br>
</p>
<p>
	<label for="pass">Password Baru:</label><br>
</p>
<div class="form-contener">
	<input type="password" placeholder="Ketik Password" name="pass"
	autocomplete="off" id="pass" required><br>
	<i class="material-icons visibility">visibility_off</i>
	</div>
	<p>
	<label for="repeat">Ulangi Password:</label>
</p>
<div class="fai">
	<input type="password" placeholder="Ketik Password" name="repeat"
	autocomplete="off" id="repeat" required><br>
	</div>
	<p>
	<span id="meseg"></span><br>
	<input type="submit" onclick="return valid()" value="Submit" name="SUBMIT" id="SUBMIT"><br>
	</p>
	</form>
	</div>	
</div>
	</div>
	</center>
</body>
</html>
<script>
function valid () {
var pas = document.getElementById('pass').value;
var pos = document.getElementById('repeat').value;
if (pos != pas) {
document.getElementById('meseg').innerHTML="*Password Salah*";
return false;
}
}
function check() {
var pis = document.getElementById('pass');
var pes = document.getElementById('repeat');
if (pis.type==="pass" && pes.type==="pass") {
pis.type="text";
pes.type="text";
}
else {
pis.type="pass";
pes.type="pass";
}
}
</script>
<script src="show.js"></script>
