<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../Login/Loginadmin.php");
	exit ();
}

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

$count_nama_kantor = strlen($kantor);
if ($count_nama_kantor <= 7){
	$nama_kantor = $kantor." Administrator";
}
else {
	$nama_kantor = $kantor;
}

$tgl = date("Y-m-d");
$jam = date("H:i:s");

if(isset($_POST['kirim'])){
	$tujuan = trim($_POST['tujuan']);
	$tanggal = $_POST["date"];
	$deadline = $_POST["dead"];
	$isi = trim($_POST['isi']);
	$judul = trim($_POST['judul']);
	$id = $kantor.time();
	
	$jawaban = $_POST["kolom"];
	$pub = $_POST["publik"];
	
	if ($jawaban != "true"){
		$jawaban = "false";
	}
	if ($pub != "true"){
		$pub = "false";
	}
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama_Admin'];
					
					$sql = mysqli_query($konek, "INSERT INTO tugas VALUES ('$id','$kantor','$nama','$nik','$tanggal','$deadline','$judul','$isi','$tujuan',$jawaban,$pub,'$jam','$tgl')");
				}
//Mengecek apakah tugas berhasil terkirim
	$sql = mysqli_query($konek, "SELECT * FROM tugas WHERE Nama_Perusahaan='$kantor' AND Nama_Admin='$nama' AND NIK_Admin='$nik' AND Tanggal='$tanggal' AND Isi_Tugas='$isi' AND Tujuan='$tujuan'");
		if (mysqli_num_rows($sql) == 0){
			header("Location: ../etc/error/index.php?condition=12 && kantor=$kantor && nik=$nik && password=$pw");
		}
				else {
					$_SESSION['kirimTugas'] = 1;
					header("Location: Tugas.php");
				}
				
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Upload Tugas</title>
    
    <link rel="stylesheet" href="etc/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../Main Tab/etc/Animate.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
</head>
	
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor ?></h1>

        <a href="Admin1.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>
	<header class="banner-unused"> 
        <h1 class="h1">Officia Administrator</h1>
    </header>
	
<form id="form1" name="form1" method="post" action="">
	<section class="tugas_box wow fadeInDown">
		<center>
			<h1 class="judul wow zoomIn">Kirim Tugas Pegawai</h1>
		</center>

	</section>
	<section class="tugas_box2 wow fadeInDown">
		<div class="form">
			<div class="form__group field">
  				<input type="input" class="form__field" placeholder="Judul" name="judul" id="judul" required autocomplete="off" />
  				<label for="judul" class="form__label">Judul</label>
			</div>
			
			<div class="form__group field">
				<textarea class="form__field" placeholder="Isi" name="isi" id="isi" required></textarea>
  				<label for="isi" class="form__label">Isi Tugas</label>
			</div>
			
			<div class="form__group field">
			<input type="date" class="form__field" name="date" id="date" required min="<?php echo $tgl ?>"/>
  				<label for="date" class="form__label">Dikirimkan Pada:</label>
			</div>
			
			<div class="form__group field">
			<input type="date" class="form__field" name="dead" id="dead" required min="<?php echo $tgl ?>"/>
  				<label for="dead" class="form__label">Deadline:</label>
			</div>
			
			<div class="form__group field">
<?php
		$sql = mysqli_query($konek, "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor' GROUP BY Jabatan ORDER BY Jabatan DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				$list1 = "";
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jabatan = $row['Jabatan'];
			$list1 = $list1.$jabatan."|";
		}
			}
		}
		
		$sql_nama = mysqli_query($konek, "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql_nama) != 0){
			$A = "SELECT Nama, NIK FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				$list2 = "";
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
					$nik_tujuan = $row['NIK'];
			$list2 = $list2."|".$nik_tujuan."|".$nama;
		}
			}
		}
		$pat = 'pattern="Seluruh Karyawan|'.$list1.$list2.'"';
?>
			<input list="list" type="text" class="form__field" name="tujuan" id="tujuan" required autocomplete="off" <?php echo $pat ?> />
  				<label for="tujuan" class="form__label">Tujuan</label>
				
				<datalist name="list" id="list" class="tujuan wow slideInUp">
			<option value="Seluruh Karyawan">Seluruh Karyawan</option>
<?php
	$sql = mysqli_query($konek, "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor' GROUP BY Jabatan ORDER BY Jabatan DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jabatan = $row['Jabatan'];
			echo '
				<option value="'.$jabatan.'">'.$jabatan.'</option>
			';
		}
			}
		}
			
	$sql_nama = mysqli_query($konek, "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql_nama) != 0){
			$A = "SELECT Nama, NIK FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
					$nik_tujuan = $row['NIK'];
			echo '
				<option value="'.$nik_tujuan.'">'.$nama.'</option>
			';
		}
			}
		}
?>
				</datalist>
			</div>
			
			<div class="lanjutan">
				<div class="pretty p-switch p-fill" style="margin-bottom: 10px;">
        			<input type="checkbox" checked name="kolom" value="true"/>
        		<div class="state">
            		<label>Aktifkan Kolom Jawaban</label>
        		</div>
    			</div>
				
				<br>
				
				<div class="pretty p-switch p-fill">
        			<input type="checkbox" name="publik" value="true"/>
        		<div class="state">
            		<label>Jawaban Bersifat Publik</label>
        		</div>
    			</div>
			</div>

		</div>
<button type="submit" class="sumbit" value="Kirim" id="kirim" name="kirim">Kirim</button>
	</section>
</form>
	
<div class="menuFloat wow slideInRight" id="Float">
<table>
	<tr>
		<th><p class="menu"><a href="etc/history/history.php">Histori</a></p></th>
	</tr>	
</table>
</div>
    
    <div class="Banner-handap">
        <div class="o">Officia</div>
        <nav class="navbar">
            <a class="toggler-navbar">
                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div class="sidebar">
                <ul class="inline">
                    <li><a href="Setting-Absen.php" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="+Pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="Banner-handap-used">
        <div class="o">Officia</div>
        <nav class="navbar">
            <a class="toggler-navbar">
                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div class="sidebar">
                <ul class="inline">
                    <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.php" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="etc/script.js"></script>
	<script src="../etc/allert.js"></script>
	<script src="../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
if (isset($_SESSION['kirimTugas'])){
	echo "<script> kirimTugas(); </script>";
	unset($_SESSION['kirimTugas']);
}
?>
	<script>
	document.getElementById("date").onchange = function () {
    	var input = document.getElementById("dead");
    	input.setAttribute("min", this.value);
		input.setAttribute("value", this.value);
	}
	</script>
</body>
</html>
