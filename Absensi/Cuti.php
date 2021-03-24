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

date_default_timezone_set('Asia/Jakarta');
$besok = date("Y-m-d", strtotime( "+1 days" ));

if(isset($_POST['SUBMIT'])){
//Mengambil data cuti
	$jenis = trim($_POST['cuti']);
	$dari = $_POST['dari'];
	$sampai = $_POST['sampai'];
	$ket = trim($_POST['ket']);
	
	$jam = date("H:i:s");
    $tgl = date("Y-m-d");
	$id = $nama.time();
	
		mysqli_query($konek, "INSERT INTO cuti VALUES ('$id','$nama','$nik','$kantor','$jenis','$dari','$sampai','$ket','unknown','$jam','$tgl')");
					
		$sql = mysqli_query($konek, "SELECT * FROM cuti WHERE NIK='$nik' AND Nama='$nama' AND Nama_Perusahaan='$kantor' AND Jenis_Cuti='$jenis' AND Dari='$dari' AND Sampai='$sampai' AND Keterangan='$ket' AND Submitted_On_Date='$tgl'");
			if (mysqli_num_rows($sql) == 0){
				$_SESSION['condition'] = 14;
				header("Location: ../etc/error/index.php");
			}
			else if (mysqli_num_rows($sql) != 0){
				header("Location: ../unused.php?value=cuti");
			}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleCuti.css">
	<link rel="stylesheet" href="../etc/wmRemover.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../Main Tab/etc/Animate.css">
</head>
	
<?php
if(isset($_SESSION['first_cuti'])){
	echo '<body onLoad="Allert()">';
	unset($_SESSION['first_cuti']);
}
else if(!isset($_SESSION['first_cuti'])){
	echo '<body>';
}
	
?>
    <header>
        <div class="container">
            <div id="logo">
                <h1><?php echo $kantor; ?></h1>
            </div> 
                <nav>
                    <ul>
                        <li><a href="Home.php">DASHBOARD</a></li> 
                        
                        <li><a href="Absen.php">ABSEN</a></li>
                                
                        <li><a href=""><u style="color: srgb(190, 190, 190); text-shadow: 0px 0px 20px white;">CUTI</u></a></li>
                            
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
                            <select name="cuti" id="cuti">
                                <option value="Tidak Tertera"></option>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Sakit">Cuti Sakit</option>
                                <option value="Cuti Besar">Cuti Besar</option>
                                <option value="Cuti Hamil">Cuti Hamil</option>
                                <option value="Cuti Penting">Cuti Penting</option>
                                <option value="Cuti Bersama">Cuti Bersama</option>
                            </select>
                        </td>
                    </tr><br>

                    <tr>
                        <td>Dari Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date" name="dari" id="dari" min="<?php echo $besok; ?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Sampai Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date" name="sampai" id="sampai" min="<?php echo $besok; ?>" required>
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
                        <td colspan="4" align="center"><button onClick="confirm('Apakah Anda Yakin Ingin Cuti?...')" class="kirim" type="submit" name="SUBMIT" id="SUBMIT">Kirim</button></td> 
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
					<th>Status</th>
					<th>Diunggah Pada</th>
					<th>Aksi</th>
                </tr>
                </thead>
                <tbody>
<?php
$sql = mysqli_query($konek, "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND NIK='$nik' AND Nama='$nama'");
	if (mysqli_num_rows($sql) != 0){
		$A = "SELECT * FROM cuti WHERE Nama_Perusahaan='$kantor' AND NIK='$nik' AND Nama='$nama' ORDER BY Submitted_On_Date DESC;";
		$result = mysqli_query($konek, $A);
		$check = mysqli_num_rows($result);
				
		if ($check > 0){
			while ($row = mysqli_fetch_assoc($result)){
				$id = $row['id'];
				$jenis = $row['Jenis_Cuti'];
				$dari = $row['Dari'];
				$sampai = $row['Sampai'];
				$ket = $row['Keterangan'];
				$stat = $row['Status'];
				$upload = $row['Submitted_On_Date'];
				$color = "red";
				$aksi = '<button class="hapus" style="border: none; color: white; background-color: firebrick; width: 100%;" onclick="window.location.href='."'../unused.php?value=hapusCuti&&idCuti=".$id."'".';">Hapus</button>';
				$aksi_style= 'style="padding: 0; background-color: firebrick;"';
				
				if ($stat == "unknown"){
					$color = "yellow";
				}
				else if ($stat == "Diterima"){
					$color = "limegreen";
					$aksi = "";
					$aksi_style = "";
				}
				else if ($stat == "Ditolak"){
					$color = "red";
					$aksi = "";
					$aksi_style = "";
				}
				$style = 'Style="background-color:'.$color.';"';
				
				echo '
				<tr>
                    <td>'.$jenis.'</td>
                    <td>'.$dari.'</td>
                    <td>'.$sampai.'</td>
                    <td>'.$ket.'</td>
					<td '.$style.'>'.$stat.'</td>
					<td>'.$upload.'</td>
					<td '.$aksi_style.' >'.$aksi.'</td>
                </tr>
				';
			}
		}
	}
?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
	<script src="../etc/allert.js"></script>
	
	<?php
		if (isset($_SESSION['cuti'])){
			echo "<script> cuti(); </script>";
			unset($_SESSION['cuti']);
		}
		if (isset($_SESSION['hapusCuti'])){
			echo "<script> hapusCuti(); </script>";
			unset($_SESSION['hapusCuti']);
		}
?>
</body>
</html>
