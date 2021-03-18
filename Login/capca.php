<?php
$captcha = $_POST["capca"];
$angka1 = $_POST["pertama"];
$angka2 = $_POST["kedua"];

$cek = $angka1 + $angka2;
if ($captcha != $cek) {
	header("Location: Forgotpassdesign.php");
}
	else {
		header("Location: newpassform.html");
	}
?>