<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['SUBMIT'])){
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");
	
		$mail = trim($_POST['mail']);
		$nik = trim($_POST['name']);
		$nama = trim($_POST['admin']);
		$kantor = trim($_POST['peru']);
		$no = trim($_POST['telp']);
		$jenis = trim($_POST['gender']);
		$alamat = trim($_POST['alamat']);
		$pass = trim($_POST['password']);
	
	if($jenis == "Laki-Laki"){
		$jenis = "L";
	}
	else if($jenis == "Perempuan"){
		$jenis = "P";
	}
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' OR Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik'");
				if (mysqli_num_rows($sql) != 0){
					header("Location: ../etc/error/index.php?condition=6");
				}
				else {
					header("Location: ../etc/error/index.php?condition=8");
				}
		}
		else {
			$sql = mysqli_query($konek, "INSERT INTO data_perusahaan VALUES ('$kantor','$nama','$nik','$jenis','$mail','$no','$pass','$alamat','06:00:00','10:00:00','15:00:00','00:00:00','$jam','$tgl')");
			
			header("Location: ../admin/Admin.php?kantor=$kantor && password=$pass && nik=$nik");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Registration Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="styregis.css">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form id="form1" name="form1" method="post" action="">
        <h1>Registration Admin</h1>
<hr>
<p>
<label for="mail">Email:</label>
<input type="email" placeholder="Masukkan Email"
name="mail" id="mail" required autocomplete="off"><br>
</p>
<p>
<label for="name">NIK:</label>
<input type="number" placeholder="Masukkan NIK" 
name="name" id="name" required autocomplete="off" class="nik"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="16"><br>
</p>
<p>
<label for="admin">Nama Admin:</label>
<input type="text" placeholder="Masukkan Nama Admin"
name="admin" id="admin" required autocomplete="off"><br>
</p>
<p>
<label for="peru">Nama Perusahaan:</label>
<input type="text" placeholder="Masukkan Nama Perusahaan"
name="peru" id="peru" required autocomplete="off"><br>
</p>
<p>
<label for="telp">Masukkan No Telp:</label>
<input type="tel" name="telp" placeholder="Masukkan No Telp"
autocomplete="off" id="telp" class="nik" required
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="12"><br>
</p>
<p>
<label for="gender">Jenis Kelamin: </label><br>
<input type="radio" name="gender" value="Laki-Laki">Laki-Laki&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="gender" value="Perempuan">Perempuan<br><br>
</p>
<p>
<label for="alamat">Alamat Perusahaan:</label>
<textarea name="alamat" id="alamat" class="almt"
cols="67">
</textarea><br>
</p>
<p>
<label for="password">Password:</label>
<input type="password" placeholder="Masukkan Password"
name="password" id="password" required autocomplete="off"><br>
</p>
<p>
<label for="repeat">Ulangi Password:</label>
<input type="password" placeholder="Masukkan Password"
name="repeat" id="repeat" required autocomplete="off"><br>
</p>
<p>
<div class="cek">
<input type="checkbox" name="show" id="sow"
class="size" onclick="check()">Show Password<br>
</div>
</p>
<p>
<div class="sub">
<span id="meseg"></span>
<input type="submit" onclick="return valid()" name="SUBMIT" id="SUBMIT" value="Submit">
</div>
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
var pas = document.getElementById('password').value;
var pos = document.getElementById('repeat').value;
if (pos != pas) {
document.getElementById('meseg').innerHTML="*Password Salah*";
return false;
}
}
function check() {
var pis = document.getElementById('password');
var pes = document.getElementById('repeat');
if (pis.type==="password" && pes.type==="password") {
pis.type="text";
pes.type="text";
}
else {
pis.type="password";
pes.type="password";
}
}
</script>
</script>
