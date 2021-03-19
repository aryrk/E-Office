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

if(isset($_POST['PROFIL'])){
	header("Location: ../Main Tab/etc/Main.php");
}

if(isset($_POST['ABSEN'])){
	header("Location: Absen.php");
}

if(isset($_POST['DATAABSEN'])){
	header("Location: DataAbsen.php");
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
    <title>Dashboard</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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
                    <li><a href=""><u style="color:rgb(190, 190, 190); text-shadow: 0px 0px 20px white;">DASHBOARD</u></a></li> 
					
                    <li><button style="background-color: transparent;border: none;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></button></li>
						
                    <li><button style="background-color: transparent;border: none;" type="submit" name="CUTI" id="CUTI" value="cuti"><a>CUTI</a></button></li>
					
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

    <section id="isi">
        <p class="prg"><br>Selamat datang di Absensi Online Officia <br><br> Apakah anda sudah absen hari ini?</p>

        <div class="container">
            <div class="box">
                <a class="link" href="Absen.php">
                    <div class="abs">
                        <i class="log fas fa-calendar-check"></i>
                        <h1>ABSENSI</h1>
                        <p>Jangan Lupa Absen!</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" href="Cuti.php">
                    <div class="bct">
                        <i class="log fas fa-calendar-minus"></i>
                        <h1>IZIN CUTI</h1>
                        <p>Izin Cuti Sebelum Hari H</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" href="DataAbsen.php">
                    <div class="dta">
                        <i class="log fas fa-tasks"></i>
                        <h1>DATA ABSENSI</h1>
                        <p>Datalist Absensi Per-minggu</p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a class="link" href="../Main Tab/etc/Main.html">
                    <div class="pfl">
                        <i class="log fas fa-id-card"></i>
                        <h1>PROFILE</h1>
                        <p>Halaman Utama/Profile</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
