<?php
$min  = 1;
$max = 70;

$random1 = mt_rand($min, $max);
$random2 = mt_rand($min, $max);

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
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form action="capca.php" id="form1" name="form1" method="POST">
        <h1>Forgot Password?</h1>
        <p class="kuy"><b>
        Isi Form untuk mereset password Anda.<br><br>
       </b></p>
    <p>
    <label for="namae">NIK:</label>
    <input type="number" placeholder="Masukkan NIK" 
    name="namae" required autocomplete="off" class="nik" id="nik"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength="16">
    <span id="meseg"></span><br>
    </p>
	<p>
	<label for="name">Email:</label>
	<input type="email" placeholder="Ketik Email" name="name" 
	autocomplete="off" required id="namae"><br>
	</p>
	<p>
	<label for="telepon">No Telp:</label>
	<input type="number" name="telp" placeholder="Masukkan No Telp"
	autocomplete="off" id="notelp" class="nik" id="telp" required
	oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
	maxlength="13"><br>
	</p>
	<p>
<label for="ultah">Tanggal Lahir:</label>
<input type="date" class="datee" name="tgl" id="tgl" placeholder="Masukkan Tanggal Lahir">
</p>
<p>
<label for="jawaban">Masukkan Jawaban Pertanyaan Sebelumnya:
<input type="text" name="jawab" id="jawab" autocomplete="off"
placeholder="Ketik Jawaban" class="nik" required>
</p>
	<p>
	<label for="caca">Jawab Soal Dibawah Dengan Tepat!</label>
	<?php
	echo $random1 . ' + ' . $random2 . ' = ';
	?>
	<input type="number" name="capca" class="kin" autocomplete="off" />
	<input type="hidden" name="pertama" value="<?php echo $random1; ?>" />
	<input type="hidden" name="kedua" value="<?php echo $random2; ?>" />
	</p>
	<p>
	<input type="submit" onclick="return valid()" value="Submit" name="masuk"><br>
	</p>
	<p>
	<a href="../index.html"><button type="button" class="canc">Back</button></a>
	</p>
	</form>
	</div>	
</div>
	</div>
	</center>
</body>
</html>
<script>
</script>
