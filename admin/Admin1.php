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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator The Officia</title>
    
    <link rel="stylesheet" href="styleadmin.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner"> 
        <h1 class="h1"><?php echo $kantor ?> Administrator</h1>

        <a href="../unused.php?value=logoutad"><i class="back fas fa-sign-out-alt"></i></a>
    </header>
    <header class="banner-used"> 
        <h1 class="h1"><?php echo $kantor ?> Administrator</h1>

        <a href="../unused.php?value=logoutad"><i class="back fas fa-sign-out-alt"></i></a>
    </header>

    <section class="tampilan">
        <h1 class="ket">Rank Absen</h1>
        <div class="notif">
            <img class="Photo" src="Photo.png" alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Asep Dapur</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Bandung, 17-08-1985</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Direksi</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 20-08-2021</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 30 Tahun</td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; IT</td>
                    </tr>
                    
                    <hr>
                    <h1 class="rank">#1</h1>
                </table>
            </div>
        </div>

        <div class="notif">
            <img class="Photo" src="Photo.png" alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Dadang Katel</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Kuningan, 28-06-1980</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Direktur Utama</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 25-03-2020</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 15 Tahun</td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Designer</td>
                    </tr>
                    <hr>
                    <h1 class="rank">#2</h1>
                </table>
            </div>
        </div>
                
        <div class="notif">
            <img class="Photo" src="Photo.png" alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Ujang Kenteng</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Bogor, 08-12-1990</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Manager</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 08-10-2021</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; 10 Tahun</td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td> &nbsp; =</td>
                        <td> &nbsp; Akuntansi</td>
                    </tr>
                    <hr>
                    <h1 class="rank">#3</h1>
                </table>
            </div>
        </div>
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
                    <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
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
                    <li><a href="Setting-Absen.html" class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></li>
                    <li><a href="Izin-Cuti.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                    <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                    <li><a href="../Login/regis.php" class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></li>
                    <li><a href="List-Karyawan.php" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                    <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
                </ul>
            </div>
        </nav>
    </div>

    <script src="script.js"></script>
</body>
</html>
