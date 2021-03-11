<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];

if(isset($_POST['SUBMIT'])){
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");
	
		$nama = trim($_POST['nama']);
		$mail = trim($_POST['mail']);
		$nik_reg = trim($_POST['namae']);
		$no = trim($_POST['telp']);
		$jenis = trim($_POST['gender']);
		$alamat = trim($_POST['alamat']);
		$pass = trim($_POST['password']);
		$jabatan = trim($_POST['jabatan']);
		$hari = trim($_POST['hari']);
		$bulan = trim($_POST['bulan']);
		$tahun = trim($_POST['tahun']);
	
	if($jenis == "Laki-Laki"){
		$jenis = "L";
	}
	else if($jenis == "Perempuan"){
		$jenis = "P";
	}
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik_reg'");
		
		if (mysqli_num_rows($sql) != 0){
			header("Location: ../index.html");
		}
		else {
			$sql = mysqli_query($konek, "INSERT INTO login VALUES ('$nik_reg','$pass','$nama','$kantor','$mail','$jabatan','$hari','$bulan','$tahun','$jenis','$no','$alamat','$jam','$tgl')");
		}
	}

if(isset($_POST['BACK'])){
		header("Location: ../admin/Admin.php?kantor=$kantor && nik=$nik && password=$pw");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Registration</title>
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
        <h1>Registration Account</h1>
<hr>
<p>
<label for="nama">Nama Lengkap:</label>
<input type="text" placeholder="Masukkan Nama Karyawan"
name="nama" id="nama" required autocomplete="off"><br>
</p>
<p>
<label for="mail">Email:</label>
<input type="email" placeholder="Masukkan Email"
name="mail" id="mail" required autocomplete="off"><br>
</p>
<p>
<label for="namae">NIK:</label>
<input type="number" placeholder="Masukkan NIK" 
name="namae" id="namae" required autocomplete="off" class="nik"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="16"><br>
</p>
<p>
<label for="telepon">Masukkan No Telp:</label>
<input type="tel" name="telp" placeholder="Masukkan No Telp"
autocomplete="off" id="telp" class="nik" required
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="12"><br>
</p>
<p>
<label for="jabatan">Jabatan:</label>
<input type="text" placeholder="(contoh: Satpam)"
name="jabatan" id="jabatan" required autocomplete="off"><br>
</p>
<p>
<label for="jk">Jenis Kelamin: </label><br>
<input type="radio" name="gender" value="Laki-Laki">Laki-Laki&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="gender" value="Perempuan">Perempuan<br>
<br><br>
</p>
<p>
<label for="ultah">Tanggal Lahir(dd/mm/yyyy)</label>
<input type="number" name="hari" id="hari" class="datee"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="2">//
<input type="number" name="bulan" id="bulan" class="datee"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="2">//
<input type="number" name="tahun" id="tahun" class="datee"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="4"><br>
</p>
<p>
<label for="alamat">Alamat:</label>
<textarea name="alamat" id="alamat" class="almt"
cols="67">
</textarea><br>
</p>
<p>
<label for="password">Password </label>
<input type="password" placeholder="Masukkan Password"
name="password" id="password" required autocomplete="off"><br>
</p>
<p>
<label for="repeat">Ulangi Password</label>
<input type="password" placeholder="Masukkan Password"
name="repeat" id="repeat" required autocomplete="off">
</p>
<p>
<div class="cek">
<input type="checkbox" name="show" id="sow"
class="size" onclick="check()">Show Password<br>
</div>
</p>
<p>
<div class="sub">
<span id="meseg"></span><br>
<input type="submit" onclick="return valid()" name="SUBMIT" id="SUBMIT" value="Submit">
</div>
</p>
<p>
</p>
</form>

<form id="form2" name="form2" method="post" action="">
	<center>
<input type="submit" name="BACK" id="BACK" value="Back">
	</center>
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
