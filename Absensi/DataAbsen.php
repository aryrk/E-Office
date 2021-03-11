<?php
require_once("../config.php");
$nik = $_GET['nik'];
$kantor = $_GET['kantor'];
$pass = $_GET['password'];

$tgl_now = date("Y-m-d");
$tgl_before1 = date("Y-m-d", strtotime(' -1 day'));
$tgl_before2 = date("Y-m-d", strtotime(' -2 day'));
$tgl_before3 = date("Y-m-d", strtotime(' -3 day'));

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
    <title>Data Absen</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleDataAbsen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
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
                    <li><button style="background-color: transparent;border: none;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></li>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="CUTI" id="CUTI" value="cuti"><a>CUTI</a></button></li>
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
                        <td><?php echo $nik ?></td>
                        <td><?php echo $_GET['nama']; ?></td>
                        <td><?php echo $tgl_now ?></td>
                        <td><?php echo $_GET['masuk']; ?></td>
                        <td><?php echo $_GET['pulang']; ?></td>
                        <td><?php echo date('H:i',strtotime($_GET['telat'])); ?></td>
                        <td class="sa"><?php echo $_GET['status'] ?></td>
                    </tr>

                    <tr>
                        <td><?php echo $nik ?></td>
                        <td><?php echo $_GET['nama']; ?></td>
                        <td><?php echo $tgl_before1 ?></td>
                        <td><?php echo $_GET['masuk1']; ?></td>
                        <td><?php echo $_GET['pulang1']; ?></td>
                        <td><?php echo date('H:i',strtotime($_GET['telat1'])); ?></td>
                        <td class="sa"><?php echo $_GET['status1'] ?></td>
                    </tr>

                    <tr>
                        <td><?php echo $nik ?></td>
                        <td><?php echo $_GET['nama']; ?></td>
                        <td><?php echo $tgl_before2 ?></td>
                        <td><?php echo $_GET['masuk2']; ?></td>
                        <td><?php echo $_GET['pulang2']; ?></td>
                        <td><?php echo date('H:i',strtotime($_GET['telat2'])); ?></td>
                        <td class="ta"><?php echo $_GET['status2'] ?></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $nik ?></td>
                        <td><?php echo $_GET['nama']; ?></td>
                        <td><?php echo $tgl_before3 ?></td>
                        <td><?php echo $_GET['masuk3']; ?></td>
                        <td><?php echo $_GET['pulang3']; ?></td>
                        <td><?php echo date('H:i',strtotime($_GET['telat3'])); ?></td>
                        <td class="ba"><?php echo $_GET['status3'] ?></td>
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
