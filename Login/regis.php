<?php
require_once("../config.php");
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: Loginadmin.php");
	exit ();
}

date_default_timezone_set('Asia/Jakarta');
$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

if(isset($_POST['SUBMIT'])){
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");
	
		$nama = trim($_POST['nama']);
		$mail = trim($_POST['mail']);
		$nik_reg = trim($_POST['namae']);
		$no = trim($_POST['telp']);
		$jenis = $_POST['gender'];
		$alamat = trim($_POST['alamat']);
		$pass = trim($_POST['password']);
		$jabatan = trim($_POST['jabatan']);
		$tgl = trim($_POST['tgl']);
	
		$hari = date('d',strtotime($tgl));
		$bulan = date('m',strtotime($tgl));
		$tahun = date('Y',strtotime($tgl));
	
		$pertanyaan = trim($_POST['secret']);
		$jawab = trim($_POST['jawab']);
		
//Mengecek agar tidak terjadi akun ganda yang memiliki NIK yang sama
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik_reg'");
		
		if (mysqli_num_rows($sql) != 0){
			header("Location: ../etc/error/index.php?condition=7 && kantor=$kantor && nik=$nik && password=$pw nikreg=$nik_reg");
		}
		else if (mysqli_num_rows($sql) == 0) {
			if($jenis == "L"){
				mysqli_query($konek, "INSERT INTO login VALUES ('$nik_reg','$pass','$nama','$kantor','$mail','$jabatan','$hari','$bulan','$tahun','L','$no','$alamat','default.png','$pertanyaan','$jawab','$jam','$tgl');");
			}
			else if($jenis == "P"){
				mysqli_query($konek, "INSERT INTO login VALUES ('$nik_reg','$pass','$nama','$kantor','$mail','$jabatan','$hari','$bulan','$tahun','P','$no','$alamat','default.png','$pertanyaan','$jawab','$jam','$tgl');");
			}
			
			$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik_reg' AND Password='$pass' AND Nama_Perusahaan='$kantor'");
				if (mysqli_num_rows($sql) == 0){
					header("Location: ../etc/error/index.php?condition=11 && kantor=$kantor && nik=$nik && password=$pw nikreg=$nik_reg");
				}
	}
}
if(isset($_POST['BACK'])){
		header("Location: ../admin/Admin1.php");
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
<label for="gender">Jenis Kelamin:</label><br>
<input type="radio" name="gender" id="gender" value="L"/>Laki-Laki&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="gender" id="gender" value="P"/>Perempuan<br>
<br><br>
</p>
<p>
<label for="ultah">Tanggal Lahir:</label>
<input type="date" class="datee" name="tgl" id="tgl" placeholder="Masukkan Tanggal Lahir">
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
<br><label for="question">Pertanyaan Keamanan:</label>
<select name="secret" id="secret" class="nik">
<option value="0">Pilih Pertanyaan Rahasia</option>
<option value="1">Apa Pekerjaan Impianmu</option>
<option value="2">Makanan Terlezat Di Dunia</option>
<option value="3">Harta Karun Masa Kecil</option>
<option value="4">Hobi</option>
<option value="5">Salah Satu Tempat Favorit</option>
<option value="6">Nama Ibumu</option>
<option value="7">Nama Panggilan Sahabat Masa Kecilmu</option>
<option value="8">Warna Pakaian Yang Dipakai Saat Ini</option>
<option value="9">Peristiwa Menyenangkan Dalam Hidupmu</option>
<option value="10">Apa Yang Harus Dirahasiakan Dari Keluarga</option>
</select>
<input type="text" name="jawab" id="jawab" autocomplete="off"
placeholder="Masukkan Jawaban" required>
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
	</body></center>

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
