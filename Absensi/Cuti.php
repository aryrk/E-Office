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
            <form id="form1" name="form1" method="post" action=""></form>
                <nav>
                    <ul>
                        <li><button style="background-color: transparent; border: none; cursor: pointer;" type="submit" name="HOME" id="HOME" value="home"><a>DASHBOARD</a></li> 
                        
                        <li><button style="background-color: transparent; border: none; cursor: pointer;" type="submit" name="ABSEN" id="ABSEN" value="absen"><a>ABSEN</a></button></li>
                                
                        <li><a href="">CUTI</a></li>
                            
                        <li><button style="background-color: transparent; border: none; cursor: pointer;" type="submit" name="DATAABSEN" id="DATAABSEN" value="absen"><a>DATA ABSEN</a></button></li>
                            
                        <li><button style="background-color: transparent; border: none; cursor: pointer;" type="submit" name="PROFIL" id="PROFIL" value="profil"><a>PROFILE</a></button></li>
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
                    <hr>
                    <tr>
                        <td>Jenis Cuti </td>
                        <td> : </td>
                        <td>
                            <select name="cuti">
                                <option value=""></option>
                                <option value="ct">Cuti Tahunan</option>
                                <option value="cs">Cuti Sakit</option>
                                <option value="cb">Cuti Besar</option>
                                <option value="ch">Cuti Hamil</option>
                                <option value="cp">Cuti Penting</option>
                                <option value="cbr">Cuti Bersama</option>
                            </select>
                        </td>
                    </tr><br>

                    <tr>
                        <td>Dari Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>

                    <tr>
                        <td>Sampai Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>

                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <textarea class="ktr" name="keterangan" cols="30" rows="5"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" align="center"><button onClick="confirm('Apakah Anda Yakin Ingin Cuti?...')" class="kirim" type="submit" name="kirim">Kirim</button></td> 
                    </tr>
                </form>
            </table>
        </div>

        <h2 class="history">History Izin Cuti</h2>
        <div class="table-wrapper">
            <table class="fl-table" border="2" rules="cols">
                <thead>
                <tr>
                    <th>Jenis Cuti</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td>Content 1</td>
                </tr>
                <tr>
                    <td>Content 2</td>
                    <td>Content 2</td>
                    <td>Content 2</td>
                    <td>Content 2</td>
                </tr>
                <tr>
                    <td>Content 3</td>
                    <td>Content 3</td>
                    <td>Content 3</td>
                    <td>Content 3</td>
                </tr>
                <tr>
                    <td>Content 4</td>
                    <td>Content 4</td>
                    <td>Content 4</td>
                    <td>Content 4</td>
                </tr>
                <tr>
                    <td>Content 5</td>
                    <td>Content 5</td>
                    <td>Content 5</td>
                    <td>Content 5</td>
                </tr>
                <tr>
                    <td>Content 6</td>
                    <td>Content 6</td>
                    <td>Content 6</td>
                    <td>Content 6</td>
                </tr>
                <tr>
                    <td>Content 7</td>
                    <td>Content 7</td>
                    <td>Content 7</td>
                    <td>Content 7</td>
                </tr>
                <tr>
                    <td>Content 8</td>
                    <td>Content 8</td>
                    <td>Content 8</td>
                    <td>Content 8</td>
                </tr>
                <tr>
                    <td>Content 9</td>
                    <td>Content 9</td>
                    <td>Content 9</td>
                    <td>Content 9</td>
                </tr>
                <tr>
                    <td>Content 10</td>
                    <td>Content 10</td>
                    <td>Content 10</td>
                    <td>Content 10</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="footer">
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <footer class="footer-used">
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>