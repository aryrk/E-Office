<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];

$tgl = date("Y-m-d");
$jam = date("H:i:s");

if(isset($_POST['SET_ABSEN'])){
	header("Location: Setting-Absen.php?kantor=$kantor && nik=$nik && password=$pw");
}
if(isset($_POST['TUGAS'])){
	header("Location: Tugas.php?kantor=$kantor && nik=$nik && password=$pw");
}

if(isset($_POST['SUBMIT'])){
	$tanggal = trim($_POST['tanggal']);
	$isi = $_POST["isi"];
	$tujuan = trim($_POST['tujuan']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama_Admin'];
					
					$sql = mysqli_query($konek, "INSERT INTO pengumuman VALUES ('$kantor','$nama','$nik','$tanggal','$isi','$tujuan','$jam','$tgl')");
				}
			}
		}
	}
if(isset($_POST['DAFTAR'])){
	header("Location: ../Login/regis.php?kantor=$kantor && nik=$nik && password=$pw");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+Pengumuman</title>

    <link rel="stylesheet" href="+++pengumuman.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <h1 class="h1">Officia Administrator</h1>
        <a href="Admin.html"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>

    <div class="table">
        <h2>Tambah Pengumuman</h2>
        <table>
            <form id="form1" name="form1" method="post" action="">
        <p>
            <tr>
                <td><label>Tanggal</label></td>
                <td>:</td>
                <td><input type="date" name="tanggal" name="tanggal" id="tanggal"/></td>
            </tr>
        </p>
        <p>
            <tr> 
                <td><label>Isi</label></td>
                <td>:</td>
                <td><textarea name="isi" id="isi" cols="40" rows="7" name="isi" id="isi" class="notes"></textarea></td>
            </tr>
        </p>
        <p>
            <tr>
                <td><label>Tujuan</label></td>
                <td>:</td>
                <td><select name="tujuan" id="tujuan">
                    <option value="Seluruh Karyawan">Seluruh Karyawan</option>
                    <option value="Satpam">Satpam</option>
                    <option value="OB">OB</option>
                    <option value="Sekertaris">Sekertaris</option>
                    <option value="Akutansi">Akutansi</option>
                    <option value="Desain">Desain</option>
                    <option value="IT">IT</option>
                </select></td>
            </tr>
        </p>
        <p>
            <tr>
                <td colspan="4" align="center"> 
                    <button name="SUBMIT" id="SUBMIT" value="Submit">Kirim</button>
                </td>
            </tr>
               
        </p>
        </form>
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
                    <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="+pengumuman.php" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
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
        </nav>
    </div>

    <script src="script.js"></script>
</body>
</html>