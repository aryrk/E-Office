<?php
require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
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

$tgl = date("Y-m-d");
$jam = date("H:i:s");

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
					
					mysqli_query($konek, "INSERT INTO pengumuman VALUES ('$kantor','$nama','$nik','$tanggal','$isi','$tujuan','$jam','$tgl')");
					
					$sql_cek = mysqli_query($konek, "SELECT * FROM pengumuman WHERE NIK_Admin='$nik' AND Nama_Admin='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tanggal' AND Tujuan='$tujuan' AND Isi_Pengumuman='$isi'");
		
					if (mysqli_num_rows($sql_cek) == 0){
						$_SESSION['condition'] = 16;
						header("Location: ../etc/error/index.php");
					}
					else {
						header("Location: ../unused.php?value=pengumuman");
					}
				}
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <title>+Pengumuman</title>

    <link rel="stylesheet" href="+++pengumuman.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <h1 class="h1"><?php echo $nama_kantor; ?></h1>
        <a href="Admin.html"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>

    <div><a href="../Pengumuman/hp.php"><button class="H">History</button></a></div>
    <div class="table">
        <h2>Tambah Pengumuman</h2>
        <table>
            <form id="form1" name="form1" method="post" action="">
        <p>
        <p>
            <tr>
                <td><label>Judul</label></td>
                <td>:</td>
                <td><input class="jdl" type="text"></td>
            </tr>
        </p>
            <tr>
                <td><label>Tanggal</label></td>
                <td>:</td>
                <td><input type="date" name="tanggal" name="tanggal" min="<?php echo $tgl ?>" value="<?php echo $tgl ?>" id="tanggal"/></td>
            </tr>
        </p>
        <p>
            <tr> 
                <td><label>Isi</label></td>
                <td>:</td>
                <td><textarea name="isi" id="isi" cols="40" rows="7" name="isi" id="isi" class="notes"></textarea></td>
            </tr>
        </p>
        <p>
            <tr>
                <td><label>Tujuan</label></td>
                <td>:</td>
                <td><select name="tujuan" id="tujuan">
                    <option value="Seluruh Karyawan">Seluruh Karyawan</option>
<?php
	$sql = mysqli_query($konek, "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Jabatan DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jabatan = $row['Jabatan'];
			echo '
				<option value="'.$jabatan.'">'.$jabatan.'</option>
			';
		}
			}
		}
			
	$sql_nama = mysqli_query($konek, "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql_nama) != 0){
			$A = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' ORDER BY Nama DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
			echo '
				<option value="'.$nama.'">'.$nama.'</option>
			';
		}
			}
		}
?>
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
                    <li><a href="Tugas.php" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
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
        </nav>
    </div>

    <script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../etc/allert.js"></script>
<?php
if (isset($_SESSION['Pengumuman'])){
	echo "<script> Pengumuman(); </script>";
	unset($_SESSION['Pengumuman']);
}
?>
</body>
</html>
