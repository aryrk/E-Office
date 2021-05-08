<?php
session_start();
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../Login/login1.php");
	exit ();
}

require_once("../config.php");
date_default_timezone_set('Asia/Jakarta');
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];
$nama = $_SESSION['nama'];

$tgl = date("Y-m-d");

//Mendapatkan data jam masuk dan pulang
$A_cek = "SELECT * FROM data_perusahaan WHERE Nama_Perusahaan='$kantor';";
$result_cek = mysqli_query($konek, $A_cek);
$row_cek = mysqli_fetch_assoc($result_cek);

$Masuk_awal = $row_cek['Absen_datang_min'];
$Masuk_akhir = $row_cek['Absen_datang_max'];
$Keluar_awal = $row_cek['Absen_pulang_min'];
$Keluar_akhir = $row_cek['Absen_pulang_max'];


//Mengecek status absen, apakah sudah absen untuk hari ini?

//Status 1 = Belum melakukan absen sama sekali
//Status 2 = Belum absen pulang
//Status 3 = Belum absen datang
//Ststus 4 = Sudah absen
//Status 5 = Absen terkirim (note sementara)
//Status 6 = Melakukan absen masuk 2x
//Status 7 = Melakukan absen pulang 2x
//Status 8 = Melakukan aben pulang terlalu cepat

$cek_sudah = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl'");
//Jika tidak terdapat absen di database untuk hari ini, maka
	if (mysqli_num_rows($cek_sudah) == 0){
		$status_absen = 1;
	}
//Jika terdapat
	else if (mysqli_num_rows($cek_sudah) != 0){
		$cek_pass1 = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_1='S' AND stat_2='S'");
//Jika belum melakukan absen datang/pulang
			if (mysqli_num_rows($cek_pass1) == 0){
				$cek_pass2 = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_1='S'");
				
					if (mysqli_num_rows($cek_pass2) != 0){
						$status_absen = 2;
					}
					else if (mysqli_num_rows($cek_pass2) == 0){
						$status_absen = 3;
					}
			}
//Jika sudah melakukan absen masuk dan pulang
			if (mysqli_num_rows($cek_pass1) != 0){
				$status_absen = 4;
			}
	}

	$alasan = 0;


if(isset($_POST['SUBMIT'])){
	$radioVal = $_POST["absen"];
	
	$jam = date("H:i:s");
	$jam_masuk_akhir = date("H:i:s",strtotime($Masuk_akhir));
	$jam_pulang_awal = date("H:i:s",strtotime($Keluar_awal));

		if($radioVal == "JamMasuk"){
			$kalkulasi = "00:00:00";
			$status = "unkown";

			if (strtotime($jam) <= strtotime($Masuk_akhir) && strtotime($jam) >= strtotime($Masuk_awal)){
				$status = "Sudah Absen Masuk";
			}
			else if (strtotime($jam) > strtotime($Masuk_akhir)){
				$status = "Terlambat Absen";
				
				$date_expire = $tgl.' '.$jam_masuk_akhir;
				$date_absen = $tgl.' '.$jam;   
				
				$date = new DateTime($date_expire);
				$now = new DateTime($date_absen);
				
				$kalkulasi = $date->diff($now)->format("%H:%i:%s");
			}
			else if (strtotime($jam) < strtotime($Masuk_akhir)){
				$status = "Absen Terlalu Pagi";
			}
//Melakukan cek database agar user hanya dapat absen 1x dalam sehari
		$cek_awal = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_1='S'");
			if (mysqli_num_rows($cek_awal) == 0){
				mysqli_query($konek, "INSERT INTO absen VALUES ('$nik','$nama','$kantor','$tgl','$jam','S','00:00:00','B','$kalkulasi','$status', '-')");
//Melakukan cek apakah absen sukses dikrim
		$cek_masuk = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_1='S'");
			if (mysqli_num_rows($cek_masuk) == 0){
				$_SESSION['condition'] = 9;
				header("Location: ../etc/error/index.php?condition=9");
			}
//Memberikan note absen terkirim
			else {
				$status_absen = 5;
			}
		}
//Jika user melakukan absen masuk 2x
		else {
			$status_absen = 6;
		}
}
	
		else if ($radioVal == "JamPulang"){
			
			$sql = mysqli_query($konek, "SELECT * FROM absen WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
						$Jam_masuk = $row['Jam_masuk'];
						$terlambat = $row['Terlambat'];
						$Status = $row['Status'];
						if ($alasan == 2){
							$alasan2 = trim($_POST["alasan"]);
							$alasan = 0;
							mysqli_query($konek, "UPDATE absen SET Jam_pulang='$jam', stat_2='S', Status='$Status', Alasan = '$alasan2' WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor'");
							echo 'aaaa';
							exit();
						}
						if ($Status == "Sudah Absen Masuk"){
							$Status = "Sudah Absen";
						}
//Melakukan cek apakah user sudah melakukan absen datang
					$cek_pulang_awal = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_2='S'");
						if (mysqli_num_rows($cek_pulang_awal) == 0){
//Update absen agar tidak terjadi duplikasi
					if (strtotime($jam) >= strtotime($jam_pulang_awal)){
						mysqli_query($konek, "UPDATE absen SET Jam_pulang='$jam', stat_2='S', Status='$Status' WHERE Tanggal='$tgl' AND NIK='$nik' AND Nama_Perusahaan='$kantor'");
						
						//Melakukan cek apakah absen terkirim
					$cek_pulang = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_2='S'");
						if (mysqli_num_rows($cek_pulang) == 0){
							$_SESSION['condition'] = 9;
							header("Location: ../etc/error/index.php");
						}
//Memberikan note absen terkirim
						else {
							$status_absen = 5;
						}
					}
					else {
							$status_absen = 8;
							$alasan = 1;
						}
						}
//Jika user melakukan absen pulang 2x
						else {
							$status_absen = 7;
						}
				}
			}
		}
//Jika user belum mekakukan absen datang
		else if (mysqli_num_rows($sql) == 0){
			$cek_pulang_awal = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_2='S'");
				if (mysqli_num_rows($cek_pulang_awal) == 0){
					if (strtotime($jam) >= strtotime($jam_pulang_awal)){
			mysqli_query($konek, "INSERT INTO absen VALUES ('$nik','$nama','$kantor','$tgl', '00:00:00','B','$jam','S','00:00:00','Tidak Absen Masuk')");
						
						//Cek apakah absen terkirim
			$cek_pulang = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Tanggal='$tgl' AND stat_2='S'");
				if (mysqli_num_rows($cek_pulang) == 0){
					$_SESSION['condition'] = 9;
					header("Location: ../etc/error/index.php");
				}
//Memberikan note absen terkirim
				else {
					$status_absen = 5;
				}
					}
					else {
							$status_absen = 8;
							$alasan = 1;
						}
			}
//Jika user melakukan absen pulang 2x
			else {
				$status_absen = 7;
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
                <h1><?php echo $kantor; ?></h1>
            </div> 
            <nav>
                <ul>
                    <li><a href="Home.php">DASHBOARD</a></li>
                    <li><a href=""><u style="color: srgb(190, 190, 190); text-shadow: 0px 0px 20px white;">ABSEN</u></a></li>
                    <li><a href="Cuti.php">CUTI</a></li>
                    <li><a href="DataAbsen.php">DATA ABSEN</a></li>
                    <li><a href="../Main Tab/etc/Main.php">PROFILE</a></li>
                </ul>
            
                <div class="menu-toggle">
                    <input type="checkbox">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <section id="absen">
        <div class="dsr">
            <div class="jam"><p id="jam"></p></div>
            <center><span id="tanggalwaktu"></span></center>
            <i class="lj far fa-clock"></i>
            <div class="jmk">
                <p>Masuk = <?php echo date('H:i',strtotime($Masuk_awal)),' - ',date('H:i',strtotime($Masuk_akhir))?></p>
                <p>Pulang = <?php echo date('H:i',strtotime($Keluar_awal)),' - ',date('H:i',strtotime($Keluar_akhir))?></p>
            </div>
        </div>

        <div class="bga">
            <form id="form2" name="form2" method="post" action="">
                <div class="radio">
                    <input type="radio" name="absen" value="JamMasuk" required/><label for="Masuk">Masuk</label>
                    <input type="radio" name="absen" value="JamPulang"/><label for="Pulang">Pulang</label>
                </div>

				<?php 
					if ($alasan == 1){
						$alasan = 2;
						echo '<textarea name="alasan" id="alasan" class="alasan" placeholder="Ketik Alasan Disini..."></textarea>
						<button type="submit" class="button-absen" name="SUBMIT" id="SUBMIT">Kirim Alasan</button>';
						
					} else{
						echo '<button type="submit" class="button-absen" name="SUBMIT" id="SUBMIT">Absen Disini</button>';
					}
				?>
                
            </form> <br>
            
            <div class="pil">
                <p><i class="note fas fa-envelope-open-text"></i><b> &nbsp; *Note</b></p>

<?php
//Mengubah note
	if ($status_absen == 1){
		echo '<p>Anda Belum Absen</p>';
	}
	else if ($status_absen == 2){
		echo '<p>Anda Belum Melakukan Absen Pulang</p>';
	}
	else if ($status_absen == 3){
		echo '<p>Anda Belum Melakukan Absen Datang</p>';
	}
	else if ($status_absen == 4){
		echo '<p>Anda Sudah Melakukan Absen Harian</p>';
	}
	else if ($status_absen == 5){
		echo '<p>Absen Terkirim</p>';
	}
	else if ($status_absen == 6){
		echo '<p style="font-size: 13px">Absen Tidak Terkirim!<br>Anda Sudah Melakukan Absen Masuk Sebelumnya</p>';
	}
	else if ($status_absen == 7){
		echo '<p style="font-size: 13px">Absen Tidak Terkirim!<br>Anda Sudah Melakukan Absen Pulang Sebelumnya</p>';
	}
	else if ($status_absen == 8){
		echo '<p style="font-size: 13px">Anda Melakukan Absen Diluar Waktu Yang Ditentukan <br> Harap Isi Alasan Anda</p>';
	}
?>
            </div>
            <h2><center>Jangan Lupa Absen!</center></h2>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="scriptAbsen.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
