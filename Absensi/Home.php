<?php
require_once("../config.php");

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

if(isset($_POST['ABSEN'])){
	$nik = $_GET['nik'];
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: Absen.php?nik=$nik");
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
    <title>Dashboard</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
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
                    <li><a href=""><u style="color:rgb(190, 190, 190); text-shadow: 0px 0px 20px white;">DASHBOARD</u></a></li> 
					
                    <li><button style="background-color: transparent;border: none;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></li>
						
                    <li><a style="cursor: pointer;" onclick="Allert()">CUTI</a></li>
					
                    <li><button style="background-color: transparent;border: none;" type="submit" name="DATAABSEN" id="DATAABSEN" value="absen"><a>DATA ABSEN</a></button></li>
					
                    <li><button style="background-color: transparent;border: none;" type="submit" name="PROFIL" id="PROFIL" value="profil"><a>PROFILE</a></button></li>
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

    <section id="isi">
        <p class="prg"><br>Selamat datang di Absensi Online Officia <br><br> Apakah anda sudah absen hari ini?</p>

        <div class="container">
            <div class="box">
                <a class="link" href="Absen.php">
                    <div class="abs">
                        <i class="log fas fa-calendar-check"></i>
                        <h1>ABSENSI</h1>
                        <p>Jangan Lupa Absen!</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" style="cursor: pointer;" onclick="Allert()">
                    <div class="bct">
                        <i class="log fas fa-calendar-minus"></i>
                        <h1>IZIN CUTI</h1>
                        <p>Izin Cuti Sebelum Hari H</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" href="DataAbsen.php">
                    <div class="dta">
                        <i class="log fas fa-tasks"></i>
                        <h1>DATA ABSENSI</h1>
                        <p>Datalist Absensi Per-minggu</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" href="../Main Tab/etc/Main.html">
                    <div class="pfl">
                        <i class="log fas fa-id-card"></i>
                        <h1>PROFILE</h1>
                        <p>Halaman Utama/Profile</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
