<?php
$sukses = 0;//PENTING
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

$A_check = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
$result_check = mysqli_query($konek, $A_check);			

$row_check = mysqli_fetch_assoc($result_check);
$datang_value_check = $row_check['Absen_datang_min'];
$datang_max_value_check = $row_check['Absen_datang_max'];
$pulang_value_check = $row_check['Absen_pulang_min'];
$pulang_max_value_check = $row_check['Absen_pulang_max'];

$datang_value = date('H:i',strtotime($datang_value_check));
$datang_max_value = date('H:i',strtotime($datang_max_value_check));
$pulang_value = date('H:i',strtotime($pulang_value_check));
$pulang_max_value = date('H:i',strtotime($pulang_max_value_check));

if(isset($_POST['ABSEN_DATANG'])){
	$datang_min = trim($_POST['masuk1']);
	$datang_max = trim($_POST['masuk2']);
	
	$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					if (empty($datang_max)){
						$datang_max = date('H:i',strtotime($datang_max_value_check));
					}
					if (empty($datang_min)){
						$datang_min = date('H:i',strtotime($datang_value_check));
					}
					
					$datang_value = $datang_min;
					$datang_max_value = $datang_max;
						
					mysqli_query($konek, "UPDATE data_perusahaan SET Absen_datang_min='$datang_min', Absen_datang_max='$datang_max' WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
					
					$sql_cek = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor' AND Absen_datang_min='$datang_min' AND Absen_datang_max='$datang_max'");
		
					if (mysqli_num_rows($sql_cek) == 0){
						$_SESSION['condition'] = 15;
						header("Location: ../etc/error/index.php");
					}
					else {
						header("Location: ../unused.php?value=gantiabsen");
					}
				}
			}
		}
}

if(isset($_POST['ABSEN_PULANG'])){
	$pulang_min = trim($_POST['pulang']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					if (empty($pulang_min)){
						$pulang_min = date('H:i',strtotime($_GET['pulang_min']));
					}
					
					$pulang_value = $pulang_min;
						
					mysqli_query($konek, "UPDATE data_perusahaan SET Absen_pulang_min='$pulang_min' WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
					
					$sql_cek = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor' AND Absen_pulang_min='$pulang_min' AND Absen_pulang_max='$pulang_max'");
		
					if (mysqli_num_rows($sql_cek) == 0){
						$_SESSION['condition'] = 15;
						header("Location: ../etc/error/index.php");
					}
					else {
						header("Location: ../unused.php?value=gantiabsen");
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
    <title>Setting Absen</title>

    <link rel="stylesheet" href="Setting-Absen.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <h1 class="h1"><?php echo $kantor; ?> Administrator</h1>

        <a href="Admin1.php"><i class="back fas fa-arrow-circle-left"></i></a>
    </header>

    <div class="body"> 
		<form id="form1" name="form1" method="post" action="">
        <section class="fitur-jam-masuk">
            <h1 class="prg-absen">Absen Jam Masuk</h1>
            <h1 class="jam-absen"><?php echo $datang_value." - ".$datang_max_value; ?></h1> <hr>
            <div class="setting-jam-masuk">
                <input class="setting-jam-masuk1" type="time" name="masuk1" id="masuk1">
            	<input class="setting-jam-masuk2" type="time" name="masuk2" id="masuk2">

            	<button class="oke1" type="submit" name="ABSEN_DATANG" id="ABSEN_DATANG" value="absen_datang">OK</button>
            </div>
        </section>

        <section class="fitur-jam-pulang">
            <h1 class="prg-absen">Absen Jam Pulang</h1>
            <h1 class="jam-absen"><?php echo $pulang_value." - ".$pulang_max_value; ?></h1> <hr>
            <div class="setting-jam-masuk">
                <input class="setting-jam-masuk3" type="time" name="pulang" id="pulang">

            	<button class="oke2" type="submit" name="ABSEN_PULANG" id="ABSEN_PULANG" value="absen_pulang">OK</button>
            </div>
        </section>
		</form>
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
                    <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../etc/allert.js"></script>
<?php
	if (isset($_SESSION['ubahabsen'])){
		echo "<script> update_absen(); </script>";
		unset($_SESSION['ubahabsen']);
	}
?>
</body>
</html>
