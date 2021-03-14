<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../Login/login1.php");
	exit ();
}

require_once("../config.php");
//Session akan membuat link terlihat polos dan membuat website lebih teroptimisasi dibanding sebelumnya
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];
$nama = $_SESSION['nama'];

if(isset($_POST['PROFIL'])){
	header("Location: ../Main Tab/etc/Main.php");
}

if(isset($_POST['ABSEN'])){
	header("Location: Absen.php");
}

if(isset($_POST['DATAABSEN'])){
	header("Location: DataAbsen.php");
}
if(isset($_POST['HOME'])){
	header("Location: Home.php");
}
if(isset($_POST['SUBMIT'])){
//Mengambil data cuti
	$jenis = trim($_POST['jenis']);
	$dari = $_POST['dari'];
	$sampai = $_POST['sampai'];
	$ket = trim($_POST['ket']);
	
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");
	
		mysqli_query($konek, "INSERT INTO cuti VALUES ('$nama','$nik','$kantor','$jenis','$dari','$sampai','$ket','$jam','$tgl')");
					
		$sql = mysqli_query($konek, "SELECT * FROM cuti WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Jenis_Cuti='$jenis' AND Dari='$dari' AND Sampai='$sampai' AND Keterangan='$ket' AND Submitted_On_Date='$tgl'");
			if (mysqli_num_rows($sql) == 0){
				$_SESSION['condition'] = 14;
				header("Location: ../etc/error/index.php");
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
    <link rel="stylesheet" href="styleCuti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
</head>
<body onLoad="Allert()">
    <header>
        <div class="container">
            <div id="logo">
                <h1><?php echo $kantor; ?></h1>
            </div>
			<form id="form1" name="form1" method="post" action="">
            <nav>
                <ul>
                    <li><button style="background-color: transparent;border: none;" type="submit" name="HOME" id="HOME" value="home"><a>DASHBOARD</a></li> 
					
                    <li><button style="background-color: transparent;border: none;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></button></li>
						
                    <li><a href="">CUTI</a></li>
					
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

    <section id="Cuti">
        <div class="table">
            <table>
                <form id="form2" name="form2" method="post" action="">
                    <h1 class="jf">Cuti Karyawan</h1>

                    <tr>
                        <td>Jenis Cuti </td>
                        <td> : </td>
                        <td>
                            <select name="jenis" id="jenis">
                                <option value=""></option>
                                <option>Cuti Tahunan</option>
                                <option>Cuti Sakit</option>
                                <option>Cuti Besar</option>
                                <option>Cuti Hamil</option>
                                <option>Cuti Penting</option>
                                <option>Cuti Bersama</option>
                            </select>
                        </td>
                    </tr><br>

                    <tr>
                        <td>Dari Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date" name="dari" id="dari">
                        </td>
                    </tr>

                    <tr>
                        <td>Sampai Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date" name="sampai" id="sampai">
                        </td>
                    </tr>

                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <textarea class="ktr" name="ket" id="ket" cols="30" rows="5"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" align="center"><button class="kirim" type="submit" name="SUBMIT" id="SUBMIT">Kirim</button></td> 
                    </tr>
                </form>
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
