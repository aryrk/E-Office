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

if(isset($_POST['HOME'])){
	header("Location: Home.php");
}

if(isset($_POST['CUTI'])){
	header("Location: Cuti.php");
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
                <h1><?php echo $kantor; ?></h1>
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
<?php
	$sql = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
			echo "<tr><td>" . $nik . "</td><td>" . $nama . "</td><td>" . $row['Tanggal'] . "</td><td>" . $row['Jam_masuk'] . "</td><td>" . $row['Jam_pulang'] . "</td><td>" . $row['Terlambat'] . "</td><td>" . $row['Status'] . "</td></tr>";
		}
			}
		}
?>
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
