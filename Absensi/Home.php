<?php
require_once("../config.php");
$nik = $_GET['nik'];
$kantor = $_GET['kantor'];
$pass = $_GET['password'];

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

if(isset($_POST['ABSEN'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$Masuk_awal = $row['Absen_datang_min'];
					$Masuk_akhir = $row['Absen_datang_max'];
					$Keluar_awal = $row['Absen_pulang_min'];
					$Keluar_akhir = $row['Absen_pulang_max'];
					header("Location: Absen.php?nik=$nik && masuk1=$Masuk_awal && masuk2=$Masuk_akhir && keluar1=$Keluar_awal && keluar2=$Keluar_akhir && password=$pass && kantor=$kantor");
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
					
					$nama = $row1['Nama'];
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
                <h1><?php echo $_GET['kantor']; ?></h1>
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
