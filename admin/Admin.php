<?php
require_once("../config.php");
$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];

if(isset($_POST['SET_ABSEN'])){					
	header("Location: Setting-Absen.php?kantor=$kantor && nik=$nik && password=$pw");
}
if(isset($_POST['PENGUMUMAN'])){
	header("Location: +Pengumuman.php?kantor=$kantor && nik=$nik && password=$pw");
}

if(isset($_POST['TUGAS'])){
	header("Location: Tugas.php?kantor=$kantor && nik=$nik && password=$pw");
}
if(isset($_POST['DAFTAR'])){
	header("Location: ../Login/regis.php?kantor=$kantor && nik=$nik && password=$pw");
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
                <li><a class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="PENGUMUMAN" id="PENGUMUMAN" value="pengumuman"><a class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></button></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="DAFTAR" id="DAFTAR" value="daftar"><a class="karyawan">+Karyawan<i class="logo fas fa-id-card"></i></a></button></li>
                <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="TUGAS" id="TUGAS" value="tugas"><a class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></button></li>
            </ul>
		   </form>
        </div>     
    </body>
</html>
