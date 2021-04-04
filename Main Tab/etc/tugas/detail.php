<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN']) || !isset($_SESSION['id_tugas'])){
	header("Location: ../../../Login/login1.php");
	exit ();
}
require_once("../../../config.php");
date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");
$jam = date("H:i:s");

$id = $_SESSION['id_tugas'];

$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];

$A = "SELECT * FROM tugas WHERE id_tugas='$id' AND Nama_Perusahaan='$kantor';";
$result = mysqli_query($konek, $A);
$row = mysqli_fetch_assoc($result);

$judul_tugas = $row['Judul'];
$isi_tugas = $row['Isi_Tugas'];

$tanggal_tujuan = date("D - d/m/Y", strtotime($row['Tanggal']));
$deadline = date("D - d/m/Y", strtotime($row['Deadline']));

$pengirim = $row['Nama_Admin'];
$tujuan = $row['Tujuan'];
if(is_numeric($tujuan)){
	$A_nama = "SELECT Nama FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='$tujuan';";
	$result_nama = mysqli_query($konek, $A_nama);
	$row_nama = mysqli_fetch_assoc($result_nama);
					
	$tujuan = $row_nama['Nama'];
}

$comment_allowed = $row['colom_active'];
$is_public = $row['is_pub'];

$A = "SELECT * FROM kirim_tugas WHERE NIK='$nik' AND id_tugas='$id' AND Nama_Perusahaan='$kantor';";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
if ($check > 0){
	while ($row = mysqli_fetch_assoc($result)){
		$sisa = $row['Edit_left'];
	}
}
else {
	$sisa = 3;
}

if(isset($_POST['kirim'])){
	$isi = trim($_POST['isi']);
	$id_laporan = $nik.$kantor.time();
	
if (!empty($_FILES['file']['name'])) {
	$nama = $_SESSION['nama'];
	if (is_dir("uploads/".$nik.$id) == false){
		mkdir("uploads/".$nik.$id);
	}
	$namaFile = $_FILES['file']['name'];
	$namaSementara = $_FILES['file']['tmp_name'];
	
	$dirUpload = "uploads/".$nik.$id."/";

	// pindahkan file
	$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
	
	$loc = $dirUpload.$namaFile;

	
	$A = "SELECT * FROM kirim_tugas WHERE NIK='$nik' AND id_tugas='$id' AND Nama_Perusahaan='$kantor';";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check == 0){
		
		$sql = mysqli_query($konek, "INSERT INTO kirim_tugas VALUES ('$id_laporan','$id','$kantor','$nik','$nama','$isi',true,'$namaFile','$loc','2','$jam','$tgl');");
		$sisa = 2;
	}
	else if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$count_saver = $row['Edit_left'];
			$old_file = $row['dir_to_file'];
			if ($old_file != "none"){
				unlink($old_file);
			}
			$count = $count_saver-1;
			
			if ($count_saver != "0"){
				$sql = mysqli_query($konek, "UPDATE kirim_tugas SET Laporan='$isi', file_name='$namaFile', dir_to_file='$loc', edit_left='$count' WHERE id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama';");
				
				$sisa = $count;
			}
		}
	}
}

else if (empty($_FILES['file']['name'])) {
		$nama = $_SESSION['nama'];
	$A = "SELECT * FROM kirim_tugas WHERE NIK='$nik' AND id_tugas='$id' AND Nama_Perusahaan='$kantor';";
	$result = mysqli_query($konek, $A);
	$check = mysqli_num_rows($result);
				
	if ($check == 0){
		$sql = mysqli_query($konek, "INSERT INTO kirim_tugas VALUES ('$id_laporan','$id','$kantor','$nik','$nama','$isi',false,'none','none','2','$jam','$tgl');");
		$sisa = 2;
	}
	else if ($check > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$count_saver = $row['Edit_left'];
			$old_file = $row['dir_to_file'];
			$count = $count_saver-1;
			
			
			if ($count_saver != "0"){
					$sql = mysqli_query($konek, "UPDATE kirim_tugas SET Laporan='$isi', edit_left='$count' WHERE id_tugas='$id' AND NIK='$nik' AND Pengirim='$nama';");
				
				$sisa = $count;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Tugas</title>
<link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="detail.css">
<link rel="stylesheet" href="../Animate.css">
<link rel="stylesheet" href="../../../etc/wmRemover.css">
</head>

<body>
	
<nav id="navigation1" class="nav1">
</nav>
<nav id="navigation">
		<div class="menu-toggle">
		<input type="checkbox" onClick="Hamburger()">
            <span></span>
            <span></span>
            <span></span>
	</div>
	<div class="logo">
	<div class="wow logo">
		<h3><?php echo $kantor; ?></h3>
	</div>
	</div>

        <ul>
            <div class="wow fadeInLeft"><li><a href="../Main.php">Profile</a></li></div>
            <div class="wow fadeInLeft"><li><a href="../../../Absensi/Absen.php">Absen</a></li></div>
			<div class="wow fadeInLeft"><li><a href="../../../Pengumuman/pengumuman.php">Pengumuman</a></li></div>
        </ul>
</nav>
	
<!--Card-->
	<div class="row">
  		<div class="column">
    		<div class="card">
				
        			<center><h2 class="judul"><?php echo $judul_tugas; ?></h2></center>
				<div class="container">
		  			<div class="textB">
        			<p><?php echo $kantor; ?> Company</p>
			  		</div>
					
					<div class="box_shadow">
  						<div class="box_container">
							<?php echo $isi_tugas ?>
  						</div>
					</div>
					<p><?php echo $pengirim ?> - <?php echo $tujuan ?><br>(<?php echo $tanggal_tujuan ?>) - (<?php echo $deadline ?>)</p>
					
        			<p><a href="../../../unused.php?value=tugas_kembali"><button class="button" id="button1">Kembali</button></a></p>
      			</div>
    		</div>
  		</div>
	</div>
<?php
if ($comment_allowed == true && $sisa != 0){
	echo '
<!--Form kirim tugas-->
	<div class="row">
  		<div class="column">
    		<div class="card">
				<div class="container">
		  			<div class="textB">
        			<p style="padding-top: 20px;">Tulis laporan</p>
			  		</div>
					<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  						<textarea class="box_container" placeholder="Laporan Tugas" name="isi" id="isi" required></textarea>
					<input type="file" name="file" id="file">
					<p>Sisa pengiriman: '.$sisa.'x</p>
					
        			<p><a href="../../../unused.php?value=tugas_kembali"><button class="button" type="submit" value="Kirim" id="kirim" name="kirim">Kirim</button></a></p>
					</form>
      			</div>
    		</div>
  		</div>
	</div>
	';
}
?>
<!--Jawaban sendiri-->
<?php
$A = "SELECT * FROM kirim_tugas WHERE NIK='$nik' AND id_tugas='$id' AND Nama_Perusahaan='$kantor';";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
if ($check > 0){
	while ($row = mysqli_fetch_assoc($result)){
		$sql_cek = mysqli_query($konek, "SELECT pp_name FROM login WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		$row_pp = mysqli_fetch_assoc($sql_cek);
		$pp_name = $row_pp['pp_name'];
		$pp = 'src="../upload/image/'.$pp_name.'"';
		
		$isi_laporan_mandiri = $row['Laporan'];
		$nama_file_mandiri = $row['file_name'];
		$dir_to_file_mandiri = $row['dir_to_file'];
		$diupload_pada_mandiri = date("D - d/m/Y", strtotime($row['Submitted_On_Date']));
		
		$file_mandiri = '<a href="'.$dir_to_file_mandiri.'"><p>'.$nama_file_mandiri.'</p></a>';
		
		echo '
<hr style="margin-top: 20px;">
	<div class="row">
  		<div class="column">
    		<div class="card">
				<div class="container">
					<table>
			<tr>
				<td rowspan="2">
					<div class="textB">
        			<p>Your Assignment</p>
			  		</div>
				</td>
			</tr>
	  		<tr style="padding: 0px; margin: 0px;">
    			<td rowspan="2"><img '.$pp.' alt="" draggable="false" style="overflow: hidden" width="100px;"></td>
  			</tr>
			<tr>
				<td class="laporan">
					
  						<div class="box_shadow">
  						<div class="box_container">
							'.$isi_laporan_mandiri.'
  						</div>
					</div>
					'.$file_mandiri.'
					</td>
			</tr>
			<tr>
				<td>
					<p>'.$diupload_pada_mandiri.'</p>
				</td>
			</tr>
					</table>
      			</div>
    		</div>
  		</div>
	</div>
		';
	}
}
?>
	
	
<!--Jawaban publik-->
<?php
$A = "SELECT * FROM kirim_tugas WHERE id_tugas='$id' AND Nama_Perusahaan='$kantor' AND NIK!='$nik' ORDER BY Submitted_On_Date DESC;";
$result = mysqli_query($konek, $A);
$check = mysqli_num_rows($result);
				
if ($check > 0 && $is_public == true){
echo '
<hr style="margin-top: 20px;">
';
	while ($row = mysqli_fetch_assoc($result)){
		$nik_public = $row['NIK'];
		$sql_cek = mysqli_query($konek, "SELECT pp_name, Nama FROM login WHERE NIK='$nik_public' AND Nama_Perusahaan='$kantor'");
		$row_pp = mysqli_fetch_assoc($sql_cek);
		$pp_name = $row_pp['pp_name'];
		$pp = 'src="../upload/image/'.$pp_name.'"';
		
		$nama_public = $row_pp['Nama'];
		
		$isi_laporan = $row['Laporan'];
		$nama_file = $row['file_name'];
		$dir_to_file = $row['dir_to_file'];
		$diupload_pada = date("D - d/m/Y", strtotime($row['Submitted_On_Date']));
		
		$file_dir = '<a href="'.$dir_to_file.'"><p>'.$nama_file.'</p></a>';
		
		echo '
	<div class="row">
  		<div class="column">
    		<div class="card">
				<div class="container">
					<table>
			<tr>
				<td rowspan="2">
					<div class="textB">
        			<p>'.$nama_public.'</p>
			  		</div>
				</td>
			</tr>
	  		<tr style="padding: 0px; margin: 0px;">
    			<td rowspan="2"><img '.$pp.' alt="" draggable="false" style="overflow: hidden" width="100px;"></td>
  			</tr>
			<tr>
				<td class="laporan">
					
  						<div class="box_shadow">
  						<div class="box_container">
							'.$isi_laporan.'
  						</div>
					</div>
					'.$file_dir.'
					</td>
			</tr>
			<tr>
				<td>
					<p>'.$diupload_pada.'</p>
				</td>
			</tr>
					</table>
      			</div>
    		</div>
  		</div>
	</div>
		';
	}
}
?>
		<h5 class="copyr">&copy; Officia, Copyright 2021. All Right Reserved</h5>
		<h5 class="copyrUnused">Officia, Copyright &copy; 2021. All Right Reserved</h5>

<script src="../script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../wow.min.js"></script>
<script>
	new WOW().init();
</script>
	
<script>
var textarea = document.querySelector('textarea');

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  setTimeout(function(){
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
	this.value = this.value + "\n";
  },0);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>
