<?php
require_once("../config.php");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Administrator The Officia</title>
    
    <link rel="stylesheet" href="styleadmin.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>

        <a href="../unused.php?value=logoutad"><i class="back fas fa-sign-out-alt"></i></a>
    </header>
    <header class="banner-used"> 
        <h1 class="h1"><?php echo $kantor ?> Administrator</h1>

        <a onClick="Logout()"><i class="back fas fa-sign-out-alt"></i></a>
    </header>

    <section class="tampilan">
		<h1 class="ket">Rank Absen</h1>
<?php
	$sql = mysqli_query($konek, "SELECT * FROM absen WHERE Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * ,COUNT(Tanggal), RANK() OVER(ORDER BY COUNT(Tanggal) DESC) AS Rank FROM absen WHERE Nama_Perusahaan='$kantor' AND stat_1='S' AND stat_2='S' GROUP BY Nama ORDER BY COUNT(Tanggal) DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$NIK_kar = $row['NIK'];
					$Nama_kar = $row['Nama'];
					$jumlah_absen = $row['COUNT(Tanggal)'];
					$rank = $row['Rank'];
					$rank_end = "th";
					
					if($rank == 1){
						$rank_end = "st";
					}
					else if($rank == 2){
						$rank_end = "nd";
					}
					else if($rank == 3){
						$rank_end = "rd";
					}
					
					
					$A_login = "SELECT * FROM login WHERE NIK='$NIK_kar' AND Nama='$Nama_kar' AND Nama_Perusahaan='$kantor';";
					$result_login = mysqli_query($konek, $A_login);
					$row_login = mysqli_fetch_assoc($result_login);
					
					$masuk = $row_login['Submitted_On_Date'];
					$masuk_tgl = date("d", strtotime($masuk));
					$masuk_bln = date("m", strtotime($masuk));
					$masuk_thn = date("Y", strtotime($masuk));
					$bagian = $row_login['Jabatan'];
					$pp = 'src="../Main Tab/etc/upload/image/'.$row_login['pp_name'].'"';
					
					//date in mm/dd/yyyy format; or it can be in other formats as well
  					$birthDate = "$masuk_bln/$masuk_tgl/$masuk_thn";
  					//explode the date to get month, day and year
  					$birthDate = explode("/", $birthDate);
  					//get age from date or birthdate
  					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    				? ((date("Y") - $birthDate[2]) - 1)
    				: (date("Y") - $birthDate[2]));
					
					echo '
        <div class="notif">
            <img class="Photo" '.$pp.' alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$Nama_kar.'</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$bagian.'</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$age.' Tahun</td>
                    </tr>
                    <tr>
                        <td>Jumlah absen</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$jumlah_absen.' x</td>
                    </tr>
                    
                    <hr>
                    <h1 class="rank">'.$rank.$rank_end.'</h1>
                </table>
            </div>
        </div>';
					
		}
			}
		}
?>
		
    </section>

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
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
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

    <script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../etc/allert.js"></script>
<?php
if (isset($_SESSION['first_login_admin'])){
	echo "<script> Login(); </script>";
	unset($_SESSION['first_login_admin']);
}
?>
</body>
</html>
