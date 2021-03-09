<?php
require_once("../config.php");
$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];

if(isset($_POST['SET_ABSEN'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$datang_min = $row['Absen_datang_min'];
					$datang_max = $row['Absen_datang_max'];
					$pulang_min = $row['Absen_pulang_min'];
					$pulang_max = $row['Absen_pulang_max'];
					
					header("Location: Setting-Absen.php?kantor=$kantor && nik=$nik && password=$pw && datang_min=$datang_min && datang_max=$datang_max && pulang_max=$pulang_max && pulang_min=$pulang_min");
				}
			}
		}
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <title>Administrator Officia The Office</title>
    </head>
    <body>
        <div class="banner">
            <h1><?php echo $_GET['kantor']; ?> Administrator</h1>

        </div>
        <p>Rank In <?php echo $_GET['kantor']; ?></p>
        <div class="Rank-1">
            <img class="Photo" src="Photo.png" alt="Photo">
        <div class="table">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>=</td>
                    <td>Tisna Saepulloh Rahmawadi Putrix</td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td> =</td>
                    <td>Mars,32-13-0001</td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td> =</td>
                    <td>01221211212</td>
                </tr>
                <tr>
                    <td>Lama Kerja</td>
                    <td> =</td>
                    <td>190 Tahun</td>
                </tr>
                <tr>
                    <td>Bagian</td>
                    <td>=</td>
                    <td>Kepala Bagian Keamanan</td>
                </tr>
            </table>
        </div>
            <div class="Ranking">
                #1
            </div>
            </div>
            <div class="Rank-1">
                <img class="Photo" src="Photo.png" alt="Photo">
            <div class="table">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>=</td>
                        <td>Udin Saepulloh</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td> =</td>
                        <td>Jupiter,12-12-0012</td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td> =</td>
                        <td>023456789</td>
                    </tr>
                    <tr>
                        <td>Lama Kerja</td>
                        <td> =</td>
                        <td>160 Tahun</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>=</td>
                        <td>Asisten Kepala Bagian Keamanan</td>
                    </tr>
                </table>
            </div>
                <div class="Ranking">
                    #2
                </div>
                </div>
            <div class="Rank-1">
            <img class="Photo" src="Photo.png" alt="Photo">
        <div class="table">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>=</td>
                    <td>Edi Saepulloh </td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td> =</td>
                    <td>Pluto,28-88-0566</td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td> =</td>
                    <td>0213545456</td>
                </tr>
                <tr>
                    <td>Lama Kerja</td>
                    <td> =</td>
                    <td>219 Tahun</td>
                </tr>
                <tr>
                    <td>Bagian</td>
                    <td>=</td>
                    <td>Seksi Keuangan Bagian Keamanan</td>
                </tr>
            </table>
        </div>
            <div class="Ranking">
                #3
            </div>
            </div>
       <div class="Banner-handap">
            <div class="o">Officia</div>
		   <form id="form1" name="form1" method="post" action="">
            <ul class="inline">
                <li><button style="background-color: transparent;border: none;" type="submit" name="SET_ABSEN" id="SET_ABSEN" value="set_absen"><a class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></button></li>
                <li><a href="+Pengumuman.html" class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><a href="" class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></li>
                <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><a href="" class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></li>
            </ul>
		   </form>
        </div>     
    </body>
</html>
