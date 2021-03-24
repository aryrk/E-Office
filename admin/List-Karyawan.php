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

if(isset($_POST['search'])){
	$nama = trim($_POST['nama']);
	header("Location: List-Karyawan.php?l=$nama");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>List Karyawan</title>
    
    <link rel="stylesheet" href="List-Karyawan.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="../Main Tab/etc/Animate.css">
</head>
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>

        <a href="Admin1.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>

    <section class="tampilan">
        <h1 class="ket">List Karyawan</h1>
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
        <a href="Data-Absen-Karyawan.php" class="horizontal"><span class="text">Data Absen</span></a>

		<?php
	$sql = mysqli_query($konek, "SELECT * FROM login WHERE Nama_Perusahaan='$kantor'");
			
if (!isset($_GET['l']) || $_GET['l'] == NULL){
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$NIK_kar = $row['NIK'];
					$Nama_kar = $row['Nama'];
					$tgl_lah = $row['Tanggal_Lahir'];
					$bln_lah = $row['Bulan_Lahir'];
					$thn_lah = $row['Tahun_Lahir'];
					$masuk = $row['Submitted_On_Date'];
					$masuk_tgl = date("d", strtotime($masuk));
					$masuk_bln = date("m", strtotime($masuk));
					$masuk_thn = date("Y", strtotime($masuk));
					$bagian = $row['Jabatan'];
					$pp = 'src="../Main Tab/etc/upload/image/'.$row['pp_name'].'"';
					
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
                        <td>Tanggal Lahir</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$tgl_lah."-".$bln_lah."-".$thn_lah.'</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$masuk.'</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$age.' Tahun</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$bagian.'</td>
                    </tr> <hr class="hr">
                    <button type="submit" name="HAPUS" id="HAPUS" class="button-hapus" onclick="window.location.href='."'../unused.php?value=hapuskar && kar=".$Nama_kar.' && nik_kar='.$NIK_kar."'".'">Hapus</button>
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
			$A = "SELECT * FROM login WHERE Nama_Perusahaan='$kantor' AND Nama='$l' OR Nama_Perusahaan='$kantor' AND NIK='$l';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$NIK_kar = $row['NIK'];
					$Nama_kar = $row['Nama'];
					$tgl_lah = $row['Tanggal_Lahir'];
					$bln_lah = $row['Bulan_Lahir'];
					$thn_lah = $row['Tahun_Lahir'];
					$masuk = $row['Submitted_On_Date'];
					$masuk_tgl = date("d", strtotime($masuk));
					$masuk_bln = date("m", strtotime($masuk));
					$masuk_thn = date("Y", strtotime($masuk));
					$bagian = $row['Jabatan'];
					$pp = 'src="../Main Tab/etc/upload/image/'.$row['pp_name'].'"';
					
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
                        <td>Tanggal Lahir</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$tgl_lah."-".$bln_lah."-".$thn_lah.'</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$masuk.'</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$age.' Tahun</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; '.$bagian.'</td>
                    </tr> <hr class="hr">
                    <button type="submit" name="HAPUS" id="HAPUS" class="button-hapus" onclick="window.location.href='."'../unused.php?value=hapuskar && kar=".$Nama_kar.' && nik_kar='.$NIK_kar."'".'">Hapus</button>
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
                    <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
    <script src="script.js"></script>
	<script src="../etc/allert.js"></script>
	
	<?php
		if (isset($_SESSION['hapusKaryawan'])){
			echo "<script> delete_karyawan(); </script>";
			unset($_SESSION['hapusKaryawan']);
		}
?>
</body>
</html>
