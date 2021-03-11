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
<html>
    <head>
        <link rel="stylesheet" href="++pengumuman.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <title>+Pengumuman</title>
    </head>
    <body>
    <div class="header">
        <h1>Officia Administrator</h1>
    </div>
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
                <td><textarea name="isi" id="isi" cols="35" rows="14" name="isi" id="isi"></textarea></td>
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
        <form id="form2" name="form2" method="post" action="">
            <ul class="inline">
                <li><button style="background-color: transparent;border: none;" type="submit" name="SET_ABSEN" id="SET_ABSEN" value="set_absen"><a class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></button></li>
                <li><a class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="DAFTAR" id="DAFTAR" value="daftar"><a class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></button></li>
                <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="TUGAS" id="TUGAS" value="tugas"><a class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></button></li>
            </ul>
		   </form>
    </div>
    </body>
</html>
