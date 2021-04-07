<?php
require_once("../config.php");

session_start();
if (isset($_SESSION['LOGIN_ADMIN'])){
	$_SESSION['first_login_admin'] = 1;
	header("Location: ../admin/Admin1.php");
	exit ();
}
if (isset($_SESSION['LOGIN'])){
	header("Location: ../Main Tab/etc/Main.php");
	$_SESSION['first_login'] = 1;
	exit ();
}

if(isset($_POST['SUBMIT'])){
		$nik_admin = trim($_POST['NIK']);
		$pw_admin = trim($_POST['PW']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik_admin' AND Password='$pw_admin'");

		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik_admin' AND Password='$pw_admin';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$kantor_admin = $row['Nama_Perusahaan'];
					
					$_SESSION['LOGIN_ADMIN'] = 1;
					$_SESSION['first_login_admin'] = 1;
					$_SESSION['kantor_admin'] = $kantor_admin;
					$_SESSION['NIK_admin'] = $nik_admin;
					$_SESSION['PW_admin'] = $pw_admin;
					
					header("Location: ../admin/Admin1.php");
				}
			}
		}
//Jika akun tidak ditemukan, akan dialihkan ke tampilan error
		else if (mysqli_num_rows($sql) == 0){
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik_admin'");
			if (mysqli_num_rows($sql) != 0){
				header("Location: ../etc/error/index.php?condition=4");
			}
			else if (mysqli_num_rows($sql) == 0){
				header("Location: ../etc/error/index.php?condition=5 && nik=$nik_admin");
			}
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Log-in Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="Loginadmin.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form id="form1" name="form1" method="post" action="">
        <h1>LOGIN ADMIN</h1>
<div class="imag">
<img src="../Icon/Inverted/Icon.png" width="200" height="200" usemap="#image-map">

</div>
	<p>
	<label for="NIK">NIK:</label>
	<input type="number" placeholder="Ketik NIK" name="NIK" id="NIK" autocomplete="off" required
class="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="16"><br>
	</p>
	<p>
	<label for="PW">Password:</label>
</p>
	<div class="form-contener">
	<input type="password" placeholder="Ketik Password" name="PW" id="PW"
	autocomplete="off" id="password" required>
		<i class="material-icons visibility">visibility_off</i>
	</div>
<p>
<input type="text" placeholder="NIK Atau Password Salah" id="salah"
class="plus" READONLY/>
</p>
<p>
<input type="submit" onclick="return falsepass()" name="SUBMIT" id="SUBMIT" value="Submit"><br>
</p>
<p>
	<a href="Forgotpassdesign.php">Forgot Your Password?</a>
	</p>
	<p>
	<a href="../index.html"><button type="button" class="canc">Back</button></a>
	</p>
<p>
<div class="ca">
<p>Punya Perusahaan Sendiri?<a href="Regisadmin.php">Daftar Admin</a></p>
</div>
</p>
	</form>
	</div>	
</div>
	</div>
	</body></center>

</html>
<script type="text/javascript">
function falsepass() {
var ask = document.getElementById('PW').value;
var ask1 = document.getElementById('NIK').value;
if (ask!=ask1) {
document.getElementById('salah').style.display='block';
return false;
}
else {
document.getElementById('salah').style.display='none';
return true;
}
}

</script>
<script src="show.js"></script>
