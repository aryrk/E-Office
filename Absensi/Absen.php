<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['SUBMIT'])){
	$nik = trim($_POST['IDS']);
	$radioVal = $_POST["absen"];

		if($radioVal == "JamMasuk"){
			$jam = date("H:i:s");
    		$tgl = date("Y-m-d");
			
			$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jamMin = $row['Absen_datang_min'];
					$jamMax = $row['Absen_datang_max'];
				}
			}
		}
			
			$kalkulasi = strtotime($jam) - strtotime($jamMax);
			
			
			$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama =  $row['Nama'];
				}
			}
		}
			

			if (strtotime($jam) <= strtotime($jamMax) && strtotime($jam) >= strtotime($jamMin)){
				$status = "Sudah Absen";
			}
			else if (strtotime($jam) > strtotime($jamMax)){
				$status = "Terlambat";
			}
			
			$sql = mysqli_query($konek, "INSERT INTO absen (NIK, Nama, Tanggal, Jam_masuk, Terlambat, Status) VALUES ('$nik','$nama','$tgl','$jam','$kalkulasi','$status')");
		}
	
		else if ($radioVal == "JamPulang"){
    		$jam = date("H:i:s");
    		$tgl = date("Y-m-d");

			$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama =  $row['Nama'];
				}
			}
		}
			
			$sql = mysqli_query($konek, "SELECT * FROM absen WHERE Tanggal='$tgl'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$cek = $row['NIK'];
					if ($row['NIK'] != NULL){
						$Jam_masuk = $row['Jam_masuk'];
						$terlambat = $row['Terlambat'];
						$Status = $row['Status'];
						
						$sql = mysqli_query($konek, "DELETE FROM absen WHERE Tanggal='$tgl' AND NIK='$nik'");
						$sql = mysqli_query($konek, "INSERT INTO absen (NIK, Nama, Tanggal, Jam_masuk, Jam_pulang, Terlambat, Status) VALUES ('$nik','$nama','$tgl','$Jam_masuk','$jam','$terlambat','$Status')");
					}
					else if($row['NIK'] === NULL){
						$Jam_masuk = $row['Jam_masuk'];
						$terlambat = $row['Terlambat'];
						$Status = $row['Status'];
						
						$sql = mysqli_query($konek, "INSERT INTO absen (NIK, Nama, Tanggal, Jam_pulang) VALUES ('$nik','$nama','$tgl','$jam')");
					}
					
				}
			}
		}
	}
}
if(isset($_POST['PROFIL'])){
	$nik = $_GET['nik'];
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
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
					
					//date in mm/dd/yyyy format; or it can be in other formats as well
  					$birthDate = "$bln/$tgl/$thn";
  					//explode the date to get month, day and year
  					$birthDate = explode("/", $birthDate);
  					//get age from date or birthdate
  					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    				? ((date("Y") - $birthDate[2]) - 1)
    				: (date("Y") - $birthDate[2]));
					
					header("Location: ../Main Tab/etc/Main.php?nama=$nama && umur=$age && jabatan=$jabatan && nik=$nik && tel=$tel && email=$email");
				}
			}
		}
	}

if(isset($_POST['HOME'])){
	$nik = $_GET['nik'];
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: Home.php?nik=$nik");
				}
			}
		}
	}

if(isset($_POST['DATAABSEN'])){
	$nik = $_GET['nik'];
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: DataAbsen.php?nik=$nik");
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
                <h1>Officia</h1>
            </div> 
			<form id="form1" name="form1" method="post" action="">
            <nav>
                <ul>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="HOME" id="HOME" value="home"><a>DASHBOARD</a></li> 
                    <li><a href=""><u style="color: srgb(190, 190, 190); text-shadow: 0px 0px 20px white;">ABSEN</u></a></li>
                    <li><a style="cursor: pointer;" onclick="Allert()">CUTI</a></li>
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
                <p>Masuk = <?php echo $_GET['masuk1']; ?> - <?php echo $_GET['masuk2']; ?></p>
                <p>Pulang = <?php echo $_GET['keluar1']; ?> - <?php echo $_GET['keluar2']; ?></p>
            </div>
        </div>

        <div class="bga">
            <form method="post" action="">
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
