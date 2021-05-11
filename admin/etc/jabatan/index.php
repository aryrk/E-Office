<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../../../config.php");
date_default_timezone_set('Asia/Jakarta');
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN_ADMIN'])){
	header("Location: ../../../Login/Loginadmin.php");
	exit ();
}

$kantor = $_SESSION['kantor_admin'];
$nik = $_SESSION['NIK_admin'];
$pw = $_SESSION['PW_admin'];

$count_nama_kantor = strlen($kantor);
if ($count_nama_kantor <= 7){
	$nama_kantor = $kantor." Administrator";
}
else {
	$nama_kantor = $kantor;
}

if(isset($_POST['kirim'])){
	$jabatan_baru = trim($_POST['name']);
	$count = strlen($jabatan_baru);
	if (isset($jabatan_baru) && $count > 0){
		$sql = mysqli_query($konek, "UPDATE login SET Jabatan='$jabatan_baru' WHERE NIK='".$_GET['nik_kar']."'");
	}
	header("Location: ../../List-Karyawan.php?update='true'");
}
if(isset($_POST['batal'])){
	header("Location: ../../List-Karyawan.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
	  <link rel="stylesheet" href="../../../etc/wmRemover.css">
	  <link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
  	<title>Ubah Jabatan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"><?php echo $nama_kantor; ?></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row mb-5">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-map-marker"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Alamat:</span> <?php echo $_GET['alamat']; ?></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-phone"></span>
			        		</div>
			        		<div class="text">
				            <p><span>No telp:</span> <a href="tel:<?php echo $_GET['telp']; ?>"><?php echo $_GET['telp']; ?></a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-paper-plane"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Email:</span> <a href="mailto:<?php echo $_GET['mail']; ?>"><?php echo $_GET['mail']; ?></a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-globe"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Masa Kerja: </span> <?php echo $_GET['masa']; ?>th</p>
				          </div>
			          </div>
							</div>
						</div>
						<div class="row no-gutters">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4"><?php echo $_GET['nama']; ?></h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
				            Your message was sent, thank you!
				      		</div>
									<form id="form1" name="form1" method="post" action="">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Ubah Jabatan</label>
													<input list="list" type="text" class="form-control" name="name" id="name" placeholder="<?php echo $_GET['jabatan']; ?>" autocomplete="off">
													
													<datalist name="list" id="list">
			<?php
	$sql = mysqli_query($konek, "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT Jabatan FROM login WHERE Nama_Perusahaan='$kantor' GROUP BY Jabatan ORDER BY Jabatan DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$jabatan = $row['Jabatan'];
			echo '
				<option value="'.$jabatan.'">'.$jabatan.'</option>
			';
		}
			}
		}
?>
													</datalist>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" value="Kirim" id="kirim" name="kirim" class="btn btn-primary">Ubah</button>
													<button type="submit" value="batal" id="batal" name="batal" class="btn btn-primary">Kembali</button>
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-5 d-flex align-items-stretch">
	<?php
	$sql = mysqli_query($konek, "SELECT * FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='".$_GET['nik_kar']."'");
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE Nama_Perusahaan='$kantor' AND NIK='".$_GET['nik_kar']."'";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$pp = "'../../../Main Tab/etc/upload/image/".$row['pp_name']."'";
				}
			}
		}
								echo '
								<div class="info-wrap w-100 p-5 img" style="background-image: url('.$pp.');">
								'
		?>
								
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

