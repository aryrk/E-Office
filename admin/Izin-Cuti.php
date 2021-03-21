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

if(isset($_POST['search'])){
	$nama = trim($_POST['nama']);
	header("Location: Izin-Cuti.php?l=$nama");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>Izin Cuti</title>
    
    <link rel="stylesheet" href="Izin-Cuti.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../Main Tab/etc/Animate.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
</head>
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $kantor; ?> Administrator</h1>

        <a href="Admin1.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>

    <section class="tampilan">
        <h1 class="ket">Notification Izin Cuti</h1>
<form id="form1" name="form1" method="post" action="">
        <div class="wrap">
            <div class="search">
               <input type="text" name="nama" id="nama" class="searchTerm" placeholder="Cari Nama Lengkap/NIK..." autocomplete="off">
        <button type="submit" name="search" id="search" class="searchButton">
                 <i class="fa fa-search"></i>
              </button>
            </div>
         </div>
</form>
<?php
$sql = mysqli_query($konek, "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Status='unknown'");
		
if (!isset($_GET['l']) || $_GET['l'] == NULL){
	if (mysqli_num_rows($sql) != 0){
		$A = "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Status='unknown' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$id = $row['id'];
					$nama_kar = $row['Nama'];
					$jenis = $row['Jenis_Cuti'];
					$dari = $row['Dari'];
					$dari = date('d-m-Y',strtotime($dari));
					$sampai = $row['Sampai'];
					$sampai = date('d-m-Y',strtotime($sampai));
					$ket = $row['Keterangan'];
					$nik_kar = $row['NIK'];
					
					$A_pp = "SELECT pp_name, No_Telp FROM login WHERE NIK='$nik_kar' AND Nama='$nama_kar' AND Nama_Perusahaan='$kantor'";
					$result_pp = mysqli_query($konek, $A_pp);
					$row_pp = mysqli_fetch_assoc($result_pp);
					
					$pp = 'src="'.'../Main Tab/etc/upload/image/'.$row_pp['pp_name'].'"';
					$telp = $row_pp['No_Telp'];
					
		echo '
		<div class="notif">
            <img class="Photo" '.$pp.' alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$nama_kar.'</td>
                    </tr>
                    <tr>
                        <td>Jenis Cuti</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$jenis.'</td>
                    </tr>
                    <tr>
                        <td>Dari Tanggal</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$dari.'</td>
                    </tr>
                    <tr>
                        <td>Sampai Tanggal</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$sampai.'</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$ket.' </td>
                    </tr>

                    <button type="submit" class="button-terima" onclick="window.location.href='."'../unused.php?value=terimaCuti&&idCuti=".$id."'".';">Terima</button>
                    <button type="submit" class="button-tidak" onclick="window.location.href='."'../unused.php?value=tolakCuti&&idCuti=".$id."'".';">Tidak</button>
                    <button type="submit" class="button-telepon" onclick="window.location.href='."'tel:".$telp."'".';"><i class="telepon fas fa-phone"></i></button>
                </table>
            </div>
        </div>
		';
				}
			}
	}
}
		
else if (isset($_GET['l'])){
	$l = $_GET['l'];
		if (mysqli_num_rows($sql) != 0){
		$A = "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND Nama='$l' AND Status='unknown' OR Nama_Perusahaan='$kantor' AND NIK='$l' AND Status='unknown' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$id = $row['id'];
					$nama_kar = $row['Nama'];
					$jenis = $row['Jenis_Cuti'];
					$dari = $row['Dari'];
					$dari = date('d-m-Y',strtotime($dari));
					$sampai = $row['Sampai'];
					$sampai = date('d-m-Y',strtotime($sampai));
					$ket = $row['Keterangan'];
					$nik_kar = $row['NIK'];
					
					$A_pp = "SELECT pp_name, No_Telp FROM login WHERE NIK='$nik_kar' AND Nama='$nama_kar' AND Nama_Perusahaan='$kantor'";
					$result_pp = mysqli_query($konek, $A_pp);
					$row_pp = mysqli_fetch_assoc($result_pp);
					
					$pp = 'src="'.'../Main Tab/etc/upload/image/'.$row_pp['pp_name'].'"';
					$telp = $row_pp['No_Telp'];
					
		echo '
		<div class="notif">
            <img class="Photo" '.$pp.' alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Roti '.$nama_kar.'</td>
                    </tr>
                    <tr>
                        <td>Jenis Cuti</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$jenis.'</td>
                    </tr>
                    <tr>
                        <td>Dari Tanggal</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$dari.'</td>
                    </tr>
                    <tr>
                        <td>Sampai Tanggal</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$sampai.'</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$ket.' </td>
                    </tr>

                    <button type="submit" class="button-terima" onclick="window.location.href='."'../unused.php?value=terimaCuti&&idCuti=".$id."'".';">Terima</button>
                    <button type="submit" class="button-tidak" onclick="window.location.href='."'../unused.php?value=tolakCuti&&idCuti=".$id."'".';">Tidak</button>
                    <button type="submit" class="button-telepon" onclick="window.location.href='."'tel:".$telp."'".';"><i class="telepon fas fa-phone"></i></button>
                </table>
            </div>
        </div>
		';
				}
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
                    <li><a href="../Login/regis.php" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
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
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="../etc/allert.js"></script>
	
	<?php
		if (isset($_SESSION['terimaCuti'])){
			echo "<script> terimaCuti(); </script>";
			unset($_SESSION['terimaCuti']);
		}
		if (isset($_SESSION['tolakCuti'])){
			echo "<script> tolakCuti(); </script>";
			unset($_SESSION['tolakCuti']);
		}
?>
</body>
</html>
