<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
$nik = $_GET['nik'];
$kantor = $_GET['kantor'];
$pass = $_GET['password'];

$A_nama = "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_perusahaan='$kantor';";
$result_nama = mysqli_query($konek, $A_nama);
				
$row_nama = mysqli_fetch_assoc($result_nama);
$nama = $row_nama['Nama'];

if(isset($_POST['SUBMIT'])){
	$nik = trim($_POST['IDS']);
	$radioVal = $_POST["absen"];
	
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");

		if($radioVal == "JamMasuk"){
		
			$A_check = "SELECT * FROM data_perusahaan WHERE Nama_Perusahaan='$kantor';";
			$result_check = mysqli_query($konek, $A_check);
				
			$row_check = mysqli_fetch_assoc($result_check);
					$jamMin = $row_check['Absen_datang_min'];
					$jamMax = $row_check['Absen_datang_max'];
			
			$kalkulasi = strtotime($jam) - strtotime($jamMax);

			if (strtotime($jam) <= strtotime($jamMax) && strtotime($jam) >= strtotime($jamMin)){
				$status = "Sudah Absen";
			}
			else if (strtotime($jam) > strtotime($jamMax)){
				$status = "Terlambat";
			}
			
			$sql = mysqli_query($konek, "INSERT INTO absen (NIK, Nama, Nama_Perusahaan, Tanggal, Jam_masuk, Terlambat, Status) VALUES ('$nik','$nama','$kantor','$tgl','$jam','$kalkulasi','$status')");
		}
	
		else if ($radioVal == "JamPulang"){
			
			$sql = mysqli_query($konek, "SELECT * FROM absen WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					if (empty($A)){
						$sql = mysqli_query($konek, "INSERT INTO absen (NIK, Nama, Nama_Perusahaan, Tanggal, Jam_pulang, Status) VALUES ('$nik','$nama','$kantor','$tgl','$jam','Tidak Absen Masuk')");
					}
					else{
						$Jam_masuk = $row['Jam_masuk'];
						$terlambat = $row['Terlambat'];
						$Status = $row['Status'];
						
						$sql = mysqli_query($konek, "DELETE FROM absen WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor'");
							
						$sql = mysqli_query($konek, "INSERT INTO absen VALUES ('$nik','$nama','$kantor','$tgl','$Jam_masuk','$jam','$terlambat','$Status')");
					}
				}
			}
		}
	}
}
if(isset($_POST['PROFIL'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor';";
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
					
					//date in mm/dd/yyyy format; or it can be in other formats as well
  					$birthDate = "$bln/$tgl/$thn";
  					//explode the date to get month, day and year
  					$birthDate = explode("/", $birthDate);
  					//get age from date or birthdate
  					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    				? ((date("Y") - $birthDate[2]) - 1)
    				: (date("Y") - $birthDate[2]));
					
					header("Location: ../Main Tab/etc/Main.php?nama=$nama && umur=$age && jabatan=$jabatan && nik=$nik && tel=$tel && email=$email && password=$pass && kantor=$kantor");
				}
			}
		}
	}

if(isset($_POST['HOME'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: Home.php?nik=$nik && password=$pass && kantor=$kantor");
				}
			}
		}
	}

if(isset($_POST['DATAABSEN'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					$tgl_now = date("Y-m-d");
					$tgl_before1 = date("Y-m-d", strtotime(' -1 day'));
					$tgl_before2 = date("Y-m-d", strtotime(' -2 day'));
					$tgl_before3 = date("Y-m-d", strtotime(' -3 day'));
					
			$row1 = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl_now';"));
					
			$row2 = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl_before1';"));
					
			$row3 = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl_before2';"));
					
			$row4 = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl_before3';"));
					
					$nama = $row['Nama'];
					$now_masuk = $row1['Jam_masuk'];
					$now_pulang = $row1['Jam_pulang'];
					$now_terlambat = $row1['Terlambat'];
					$now_stat = $row1['Status'];
					
					$before1_masuk = $row2['Jam_masuk'];
					$before1_pulang = $row2['Jam_pulang'];
					$before1_terlambat = $row2['Terlambat'];
					$before1_stat = $row2['Status'];
					
					$before2_masuk = $row3['Jam_masuk'];
					$before2_pulang = $row3['Jam_pulang'];
					$before2_terlambat = $row3['Terlambat'];
					$before2_stat = $row3['Status'];
					
					$before3_masuk = $row4['Jam_masuk'];
					$before3_pulang = $row4['Jam_pulang'];
					$before3_terlambat = $row4['Terlambat'];
					$before3_stat = $row4['Status'];
					
					header("Location: DataAbsen.php?nik=$nik && password=$pass && kantor=$kantor && nama=$nama && masuk=$now_masuk && pulang=$now_pulang && telat=$now_terlambat && status=$now_stat && masuk1=$before1_masuk && pulang1=$before1_pulang && telat1=$before1_terlambat && status1=$before1_stat && masuk2=$before2_masuk && pulang2=$before2_pulang && telat2=$before2_terlambat && status2=$before2_stat && masuk3=$before3_masuk && pulang3=$before3_pulang && telat3=$before3_terlambat && status3=$before3_stat");
				}
			}
		}
	}

if(isset($_POST['CUTI'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik' AND Password='$pass';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){

					header("Location: Cuti.php?nik=$nik && password=$pass && kantor=$kantor");
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleAbsen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="logo">
                <h1><?php echo $_GET['kantor']; ?></h1>
            </div> 
			<form id="form1" name="form1" method="post" action="">
            <nav>
                <ul>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="HOME" id="HOME" value="home"><a>DASHBOARD</a></li> 
                    <li><a href=""><u style="color: srgb(190, 190, 190); text-shadow: 0px 0px 20px white;">ABSEN</u></a></li>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="CUTI" id="CUTI" value="cuti"><a>CUTI</a></button></li>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="DATAABSEN" id="DATAABSEN" value="absen"><a>DATA ABSEN</a></li>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="PROFIL" id="PROFIL" value="profil"><a>PROFILE</a></li>
                </ul>
            
                <div class="menu-toggle">
                    <input type="checkbox">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
			</form>
        </div>
    </header>

    <section id="absen">
        <div class="dsr">
            <div class="jam"><p id="jam"></p></div>
            <center><span id="tanggalwaktu"></span></center>
            <i class="lj far fa-clock"></i>
            <div class="jmk">
                <p>Masuk = <?php echo date('H:i',strtotime($_GET['masuk1'])); ?> - <?php echo date('H:i',strtotime($_GET['masuk2'])); ?></p>
                <p>Pulang = <?php echo date('H:i',strtotime($_GET['keluar1'])); ?> - <?php echo date('H:i',strtotime($_GET['keluar2'])); ?></p>
            </div>
        </div>

        <div class="bga">
            <form id="form2" name="form2" method="post" action="">
                <div class="radio">
                    <input type="radio" name="absen" value="JamMasuk"/><label for="Masuk">Masuk</label>
                    <input type="radio" name="absen" value="JamPulang"/><label for="Pulang">Pulang</label>
                </div>
                <input type="text" class="nik" name="IDS" id="IDS" placeholder="Email / NIK">
				<input type="submit" name="SUBMIT" id="SUBMIT" value="Submit" style="width: 0%;opacity: 0%;">
            </form>
            
            <div class="pil">
                <p>Pilih Absen Masuk / Pulang</p>
                <p>Email </p> <p>Atau</p> <p>Input NIK / ID</p>
            </div>
            <h2><center>Jangan Lupa Absen!</center></h2>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="scriptAbsen.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
