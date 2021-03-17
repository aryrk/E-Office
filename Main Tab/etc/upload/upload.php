<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../../../Login/login1.php");
	exit ();
}


require_once("../../../config.php");
//Session akan membuat link terlihat polos dan membuat website lebih teroptimisasi dibanding sebelumnya
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];

if(isset($_POST["image"]))
{
	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);

	$imageName = $nik . $kantor . time() . '.png';

	$sql = mysqli_query($konek, "SELECT pp_name FROM login WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Password='$pass'");
		if (mysqli_num_rows($sql) != 0){
			$row = mysqli_fetch_assoc($sql);
			$pp_name = $row['pp_name'];
//Jika user memiliki gambar profile sebelumnya, maka gambar tersebut akan dihapus dari database
			if ($pp_name != "default.png"){
				unlink('image/'.$pp_name);
				file_put_contents('image/'.$imageName, $data);
			}
			else {
				file_put_contents('image/'.$imageName, $data);
			}
			mysqli_query($konek, "UPDATE login SET pp_name='$imageName' WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' AND Password='$pass'");
		}

	echo '<img src="image/'.$imageName.'" class="img-thumbnail"/>';

}

?>
