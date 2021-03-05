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
					
					header("Location: Absen.php?nama=$nama && umur=$age && jabatan=$jabatan && nik=$nik && tel=$tel && email=$email");
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
					
					header("Location: Home.php?nama=$nama && umur=$age && jabatan=$jabatan && nik=$nik && tel=$tel && email=$email");
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
    <title>Data Absen</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleDataAbsen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
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
                    <li><button style="background-color: transparent;border: none;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></li>
                    <li><a style="cursor: pointer;" onclick="Allert()">CUTI</a></li>
                    <li><a href=""><u style="color: rgb(190, 190, 190); text-shadow: 0px 0px 20px white;">DATA ABSEN</u></a></li>
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

    <section>
        <div class="table-responsive">
            <table class="table-da" border="1" cellpadding="15">
                <thead class="thead-bg">
                    <tr>
                        <th>NIK / ID</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Absen Masuk</th>
                        <th>Jam Absen Pulang</th>
                        <th>Terlambat Absen</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1905924783</td>
                        <td>Ilham Kurniawan</td>
                        <td>17-08-2020</td>
                        <td>(08.30)</td>
                        <td>(16.00)</td>
                        <td>-</td>
                        <td class="sa">Sudah Absen</td>
                    </tr>

                    <tr>
                        <td>1905924783</td>
                        <td>Ilham Kurniawan</td>
                        <td>18-08-2020</td>
                        <td>(08.00)</td>
                        <td>(16.30)</td>
                        <td>-</td>
                        <td class="sa">Sudah Absen</td>
                    </tr>

                    <tr>
                        <td>1905924783</td>
                        <td>Ilham Kurniawan</td>
                        <td>19-08-2020</td>
                        <td>(09.00)</td>
                        <td>(17.00)</td>
                        <td>30 Menit</td>
                        <td class="ta">Terlambat Absen</td>
                    </tr>
                    
                    <tr>
                        <td>1905924783</td>
                        <td>Ilham Kurniawan</td>
                        <td>20-08-2020</td>
                        <td>Belum Absen</td>
                        <td>(15.00)</td>
                        <td>-</td>
                        <td class="ba">Bolos</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
