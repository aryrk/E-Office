<?php
//Set session agar user tidak perlu login berkali kali
session_start();
if (isset($_SESSION['LOGIN'])){
	header("Location: ../Main Tab/etc/Main.php");
	$_SESSION['first_login'] = 1;
	exit ();
}
else if (isset($_SESSION['LOGIN_ADMIN'])){
	$_SESSION['first_login_admin'] = 1;
	header("Location: ../admin/Admin1.php");
	exit ();
}

require_once("../config.php");

if(isset($_POST['SUBMIT'])){
		$nik = trim($_POST['NIK']);
		$pw = trim($_POST['PW']);
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password = '$pw'");
		
		if (mysqli_num_rows($sql) != 0){
			
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
					$tgl = $row['Tanggal_Lahir'];
					$bln = $row['Bulan_Lahir'];
					$thn = $row['Tahun_Lahir'];
					$jabatan = $row['Jabatan'];
					$tel = $row['No_Telp'];
					$email = $row['Email'];
					$kantor = $row['Nama_Perusahaan'];
					
					//date in mm/dd/yyyy format; or it can be in other formats as well
  					$birthDate = "$bln/$tgl/$thn";
  					//explode the date to get month, day and year
  					$birthDate = explode("/", $birthDate);
  					//get age from date or birthdate
  					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    				? ((date("Y") - $birthDate[2]) - 1)
    				: (date("Y") - $birthDate[2]));
//Jika akun ditemukan, data login akan tersimpan pada browser lewat session
					$_SESSION['LOGIN'] = 1;
					$_SESSION['nama'] = $nama;
					$_SESSION['umur'] = $age;
					$_SESSION['jabatan'] = $jabatan;
					$_SESSION['nik'] = $nik;
					$_SESSION['tel'] = $tel;
					$_SESSION['email'] = $email;
					$_SESSION['kantor'] = $kantor;
					$_SESSION['password'] = $pw;
					
					$_SESSION['first_login'] = 1;
					$_SESSION['first_cuti'] = 1;
					
					header("Location: ../Main Tab/etc/Main.php");
				}
			}
		}
//Web akan dialihkan ke tampilan error jika NIK atau Password salah
	else if (mysqli_num_rows($sql) == 0){
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
			if (mysqli_num_rows($sql) != 0){
				header("Location: ../etc/error/index.php?condition=2");
			}
			else if (mysqli_num_rows($sql) == 0){
				header("Location: ../etc/error/index.php?condition=3 && nik=$nik");
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
		<title>Log in</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="sutail.css">
<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
<link rel="stylesheet" href="../Main Tab/etc/Animate.css">
</head>
	
	<center>
<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
		
	<form id="form1" name="form1" method="post" action="">
        <h1>LOGIN</h1>
	<div class="imag">
		<a id="golink" href="Loginadmin.php">
		<img src="../Icon/Inverted/Icon.png" width="200" height="200" usemap="#image-map">
</a>
</div>
	<p><br>
	<label for="name">NIK:</label>
	<input type="number" placeholder="Ketik NIK" name="NIK" id="NIK" 
	autocomplete="off" class="nik" required><br>
	</p>
	<p>
	<label for="pass">Password:</label>
	</p>
	<div class="form-contener">
	<input type="password" placeholder="Ketik Password" name="PW" id="PW"
	autocomplete="off" id="password" required>
		<i class="material-icons visibility">visibility_off</i>
	</div>
	<p>
	<button type="submit" name="SUBMIT" id="SUBMIT" value="Submit">Login</button><br>
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
	</body>
</center>

</html>
<script>
const visibilityToogle = document.querySelector('.visibility');
const input = document.querySelector('.form-contener input');
var password = true;
visibilityToogle.addEventListener('click', function() {
if (password) {
input.setAttribute('type', 'text');
visibilityToogle.innerHTML = 'visibility';
}
else {
input.setAttribute('type', 'password');
visibilityToogle.innerHTML = 'visibility_off';
}
password = !password;
});

function check() {
var pas = document.getElementById('password');
if (pas.type==="password") {
pas.type="text";
}
else {
pas.type="password";
}
}
jQuery(function($) {
    $('#golink').click(function() {
        return false;
    }).dblclick(function() {
        window.location = this.href;
        return false;
    });
});
</script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="../etc/allert.js"></script>
	
	<?php
		if (isset($_SESSION['gantipw'])){
			echo "<script> gantipw(); </script>";
			unset($_SESSION['gantipw']);
		}
?>
