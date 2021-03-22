<?php
require_once("../config.php");
session_start();
$min  = 1;
$max = 70;

$random1 = mt_rand($min, $max);
$random2 = mt_rand($min, $max);

if(isset($_POST['SUBMIT'])){
	$nik = trim($_POST['namae']);
	$mail = trim($_POST['name']);
	$telp = trim($_POST['telp']);
	$tgl = trim($_POST['tgl']);
	
	$hari = date('d',strtotime($tgl));
	$bulan = date('m',strtotime($tgl));
	$tahun = date('Y',strtotime($tgl));
	
	$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Email='$mail' AND No_Telp='$telp' AND Tanggal_Lahir='$hari' AND Bulan_Lahir='$bulan' AND Tahun_Lahir='$tahun'");
		
		if (mysqli_num_rows($sql) != 0){
	
	$num1 = trim($_POST['pertama']);
	$num2 = trim($_POST['kedua']);
	$hasil = trim($_POST['capca']);
	$_SESSION['forgot'] = 1;
			
	header("Location: capca.php?1=$num1&&2=$num2&&3=$hasil&&nik=$nik&&mail=$mail&&telp=$telp&&hari=$hari&&bln=$bulan&&thn=$tahun");
		}
	
	else if (mysqli_num_rows($sql) == 0){
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) == 0){
			header("Location: ../etc/error/index.php?condition=18&&nik=$nik");
		}
		else if (mysqli_num_rows($sql) != 0){
			$sql = mysqli_query($konek, "SELECT * FROM login WHERE Email='$mail' AND NIK='$nik'");
		
			if (mysqli_num_rows($sql) == 0){
				header("Location: ../etc/error/index.php?condition=19 && mail=$mail");
			}
			else if (mysqli_num_rows($sql) != 0){
				$sql = mysqli_query($konek, "SELECT * FROM login WHERE Email='$mail' AND NIK='$nik' AND No_Telp='$telp'");
		
				if (mysqli_num_rows($sql) == 0){
					header("Location: ../etc/error/index.php?condition=20&&telp=$telp");
				}
				else if (mysqli_num_rows($sql) != 0){
					header("Location: ../etc/error/index.php?condition=21");
				}
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
<title>Forgot Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="Forgotpassdesign.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form action="" id="form1" name="form1" method="POST">
        <h1>Forgot Password?</h1>
        <p class="kuy"><b>
        Isi Form untuk mereset password Anda.<br><br>
       </b></p>
    <p>
    <label for="namae">NIK:</label>
    <input type="number" placeholder="Masukkan NIK" 
    name="namae" required autocomplete="off" class="nik" id="namae"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength="16">
    <span id="meseg"></span><br>
    </p>
	<p>
	<label for="name">Email:</label>
	<input type="email" placeholder="Ketik Email" name="name" id="name"
	autocomplete="off" required><br>
	</p>
	<p>
	<label for="telp">No Telp:</label>
	<input type="number" name="telp" placeholder="Masukkan No Telp"
	autocomplete="off" id="telp" class="nik" required
	oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
	maxlength="13"><br>
	</p>
	<p>
<label for="tgl">Tanggal Lahir:</label>
<input type="date" class="datee" name="tgl" id="tgl" placeholder="Masukkan Tanggal Lahir">
</p>
	<p>
	<label for="caca">Jawab Soal Dibawah Dengan Tepat!</label>
	<?php
	echo $random1 . ' + ' . $random2 . ' = ';
	?>
	<input type="number" name="capca" id="capca" class="kin" autocomplete="off" />
	<input type="hidden" name="pertama" id="pertama" value="<?php echo $random1?>" />
	<input type="hidden" name="kedua" id="kedua" value="<?php echo $random2?>" />
	</p>
	<p>
	<input type="submit" onclick="return valid()" value="Submit" name="SUBMIT" id="SUBMIT"><br>
	</p>
	<p>
	<a href="../index.html"><button type="button" class="canc">Back</button></a>
	</p>
	</form>
	</div>	
</div>
	</div>
	</body></center>

</html>
<script>
</script>
