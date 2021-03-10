<?php
require_once("../../config.php");

$tujuan = $_GET['tujuan'];
$tanggal = $_GET['tanggal'];
$isi = $_GET['isi'];
?>
<!doctype html>
<html>
<head>
<link rel = "icon" href ="../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
<link rel="stylesheet" href="prev.css">
<link rel="stylesheet" href="../../Main Tab/etc/Animate.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Preview</title>
	
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<?php echo $isi ?>
	
<p class="back wow fadeInUpBig">#Note: To go back without losing any data, just simply press 'back' button.</p>
</form>
</body>
<script src="../../Main Tab/etc/wow.min.js"></script>
<script>
	new WOW().init();
</script>
</html>
