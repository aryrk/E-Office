<?php
require_once("../config.php");

if(isset($_POST['SUBMIT'])){
		$nik = trim($_POST['NIK']);
		$pw = trim($_POST['PW']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$kantor = $row['Nama_Perusahaan'];
					
					header("Location: ../admin/Admin.php?kantor=$kantor && password=$pw && nik=$nik");
				}
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
<title>Login Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="Loginadmin.css">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form id="form1" name="form1" method="post" action="">
        <h1>LOGIN</h1>
<div class="imag">
<img src="../Icon/Inverted/Icon.png" width="200" height="200" usemap="#image-map">

<map name="image-map">
    <area target="_parent" alt="Admin" title="Admin" href="regis.html" coords="844,848,958,1002" shape="rect">
    <area target="_parent" alt="Admin" title="Admin" href="regis.html" coords="232,700,506,649" shape="rect">
</map>

</div>
	<p>
	<label for="name">NIK:</label><br>
	<input type="number" placeholder="Ketik NIK" name="NIK" id="NIK" autocomplete="off" required
class="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="16"><br>
	</p>
	<p>
	<label for="pass">Password:</label><br>
	<input type="password" placeholder="Ketik Password" name="PW" id="PW" autocomplete="off" required>
	</p>
	<p>
	<div class="cek">
	<input type="checkbox" name="show" id="sow"
	class="size" onclick="check()">Show Password<br>
	</div>
	</p>
	<p>
	<span id="meseg"></span><br>
	<button type="submit" name="SUBMIT" id="SUBMIT" value="Submit">Login</button><br>
	</p>
	<p>
	<a href="../index.html"><button type="button" class="canc">Back</button></a>
	</p>
<p>
<div class="ca">
<p>Daftar Sebagai Admin?<a href="Regisadmin.html">Daftar</a></p>
</div>
</p>
	</form>
	</div>	
</div>
	</div>
	</center>
</body>
</html>
