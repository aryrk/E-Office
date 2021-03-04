<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officia Main</title>
	<link rel = "icon" href ="../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
	
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&family=Roboto+Slab&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="Animate.css">
	
<style>
/*Dark mode*/
	.darkmode{
		background-image: url("../media/Dark.jpg");
		transition: all 1s;
	}
	.darkmode nav{
    	background-color: #474e5d;
		transition: all 1s;
	}
	.darkmode .center{
  		color: white;
		transition: all 1s;
	}
	.darkmode a{
		color:white;
		transition: all 1s;
	}
	.darkmode a:hover{
		color: cornflowerblue;
		text-decoration: underline;
		transition: all 1s;
	}
	.darkmode .center2{
		color:white;
		transition: all 1s;
	}
	.darkmode .center2 a:hover{
		color:cornflowerblue;
		text-decoration: none;
		transition: all 1s;
	}
	.darkmode .progres{
		color:white;
		transition: all 1s;
	}
	.darkmode nav ul li a:hover{
    	color: black;
		background: white;
		transition: all 1s;
	}
	.darkmode nav ul{
		background-color: #474e5d;
		transition: all 1s;
	}
	/*Dark mode kotak tanggal*/
	.darkmode .box{
  		background-color:rgba(27,80,176,0.5);
		border-color: #1B50B0;
	}
	.darkmode .TwoNdBox{
  		background-color:rgba(27,80,176,0.5);
		border-color: #1B50B0;
	}
	.darkmode .ExtendBox{
  		background-color:rgba(27,80,176,0.5);
		border-color: #1B50B0;
	}
	.darkmode .MaxBox{
  		background-color:rgba(27,80,176,0.5);
		border-color: #1B50B0;
	}
	.darkmode .Activated{
  		background-color:rgba(27,80,176,0.5);
		border-color: #1B50B0;
	}
	
	/*Mode gelap komen box*/
	.darkmode .box2{
  		background-color:rgba(27,80,176,0.5);
	}
	.darkmode .TwoNdBox2{
  		background-color:rgba(27,80,176,0.5);
	}
	.darkmode .ExtendBox2{
  		background-color:rgba(27,80,176,0.5);
	}
	.darkmode .MaxBox2{
  		background-color:rgba(27,80,176,0.5);
	}
	/*Tombol Tugas*/
	.AcTugas .box{
		border: 5px solid cadetblue ;
		padding: 1%;
		margin: 20px;
		font-size: 200%;
		opacity: 1;
	}
	.AcTugas .BorderOne{
		width:98%;
		opacity: 1;
	}
	.AcTugas .box2{
		border: 5px solid cadetblue ;
		padding: 12.2%;
		margin: 20px;
		font-size: 200%;
		opacity: 1;
	}
	.AcTugas .Activated{
		border: 5px solid cadetblue ;
		padding: 0%;
		margin: 0px;
		font-size: 0%;
		opacity: 0;
	}
	/*Tugas 1*/
		/*Tugas pembatas*/
	.tugas .BorderOne{
		width: 0%;
		opacity: 0%;
		transition: all 1s;
		transition-delay: 0.5s;
	}
		/*Tugas komentar*/
	.tugas .box2{
  		padding: 0%;
  		font-size: 0%;
		opacity: 0;
		transition: all 1s;
	}
		/*Transisi kotak tugas*/
	.tugas .box{
		padding: 30px;
		margin-top: 3.5%;
		animation: none;
	}
	.tugas .TwoNdBox{
		padding: 30px;
		opacity: 1;
		margin: 20px;
		border: 5px solid cadetblue;
		transform: translateX(0%);
		transform: translateY(-50%);
		font-size: 200%;
	}
	.tugas .ExtendBox{
		padding: 30px;
		opacity: 1;
		margin: 20px;
		border: 5px solid cadetblue;
		transform: translateX(0%);
		transform: translateY(-70%);
		font-size: 200%;
	}
	.tugas .MaxBox{
		padding: 30px;
		opacity: 1;
		margin: 20px;
		border: 5px solid cadetblue;
		transform: translateX(0%);
		transform: translateY(-90%);
		font-size: 200%;
	}
	
	/*Tugas 2*/
		/*Transisi kotak tugas*/
	.TwoNdTugas .box{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.TwoNdTugas .TwoNdBox{
		transform: translateY(-30%);
	}
	.TwoNdTugas .ExtendBox{
		transform: translateX(-500%);
		font-size: 0%;
		border: 0px solid cadetblue ;
		padding: 0px;
		margin: 0%;
	}
	.TwoNdTugas .MaxBox{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateX(-500%);
		font-size: 0%;
	}
		/*Transisi komentar*/
	.TwoNdTugas .TwoNdBox2{
  		border: 5px solid cadetblue ;
  		padding: 10.8%;
  		margin: 20px;
		opacity: 1;
		font-size: 200%;
		transform: translateY(-38px);
	}
		/*Transisi pembatas*/
	.TwoNdTugas .BorderTwo{
		width: 98%;
		opacity: 1;
		transform: translateY(-38px);
		transition: all 1s;
		transition-delay: 0.5s;
	}
	/*Tugas 3*/
		/*Transisi kotak tugas*/
	.ExtendTugas .box{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.ExtendTugas .TwoNdBox{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.ExtendTugas .ExtendBox{
		transform: translateY(-50%);
	}
	.ExtendTugas .MaxBox{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateX(-500%);
		font-size: 0%;
	}
		/*Transisi kotak komentar*/
	.ExtendTugas .ExtendBox2{
  		border: 5px solid cadetblue ;
  		padding: 10.8%;
  		margin: 20px;
		opacity: 1;
		font-size: 200%;
		transform: translateY(-60px);
	}
		/*Transisi pembatas*/
	.ExtendTugas .BorderExtend{
		width: 98%;
		opacity: 1;
		transform: translateY(-60px);
		transition: all 1s;
		transition-delay: 0.5s;
	}	
	/*Tugas 4*/
		/*Transisi kotak tugas*/
	.MaxTugas .box{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.MaxTugas .TwoNdBox{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.MaxTugas .ExtendBox{
		padding: 0px;
		border: 0px solid cadetblue ;
  		margin: 0px;
		opacity: 0;
		transform: translateY(-50%);
		transform: translateX(-500%);
		font-size: 0%;
	}
	.MaxTugas .MaxBox{
		transform: translateY(-50%);
	}
		/*Transisi komentar*/
	.MaxTugas .MaxBox2{
  		border: 5px solid cadetblue ;
  		padding: 10.5%;
  		margin: 20px;
		opacity: 1;
		font-size: 200%;
		transform: translateY(-70px);
	}
		/*Transisi pembatas*/
	.MaxTugas .BorderMax{
		width: 98%;
		opacity: 1;
		transform: translateY(-65px);
		transition: all 1s;
		transition-delay: 0.5s;
	}
/*Hamburger*/
	.ham .center{
		transition: all 1s;
		z-index: -5;
		opacity: 0.7;
	}
	.ham .progres {
		transform: translateX(-1000%);
		transition: all 1s;
    	opacity: 0;
	}
	.ham .center2{
		transform: translateX(-1000%);
		transition: all 1s;
		opacity: 0;
		margin-bottom: 2%;
	}
	.ham .ov{
		transform: translateX(-1000%);
		transition: all 1s;
		opacity: 0;
		margin-bottom: 2%;
	}
	.ham nav{
		transition: all 1s;
		opacity: 0.8;
	}
	/*Hamburger kotak tanggal*/
	.ham .Activated{
		bottom: auto;
		top: 0;
                right: 0;
		opacity: 0;
		animation-play-state: paused;
	}
	.ham .box{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .TwoNdBox{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .ExtendBox{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .MaxBox{
		transform: translateX(-200%);
		opacity: 0;
	}
	
	/*Hamburger kotak komentar*/
	.ham .box2{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .TwoNdBox2{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .ExtendBox2{
		transform: translateX(-200%);
		opacity: 0;
	}
	.ham .MaxBox2{
		transform: translateX(-200%);
		opacity: 0;
	}
	
	/*Hamburger border line*/
	.ham .BorderOne{
		width: 0%;
		opacity: 0;
	}
	.ham .BorderTwo{
		width: 0%;
		opacity: 0;
	}
	.ham .BorderExtend{
		width: 0%;
		opacity: 0;
	}
	.ham .BorderMax{
		width: 0%;
		opacity: 0;
	}
/*Overview Button*/
	.overview .center2{
		transform: translateY(0);
		font-size: 32px;
		transition: all 1s;
	}
	.overview .progres label{
		font-size: 300%;
		transform: translateX(0);
		opacity: 0.8;
		transition: all 3s;
		animation-delay: 1.4s;
	}
	.overview .progres progress{
		margin-left: 2.7%;
		margin-right: auto;
		width: 95%;
		font-size: 300%;
		transform: translateX(0);
		opacity: 0.4;
		transition: all 3.3s;
		animation-delay: 1.4s;
	}
	.overview .ov hr{
		opacity: 1;
		width:95%;
		margin-left:auto;
		margin-right: auto;
		transition: all 3.5s;
		animation-delay: 3s;
	}
/*Loading Page*/
	#loader {
  		position: absolute;
  		left: 50%;
  		top: 50%;
  		z-index: 1;
  		width: 120px;
  		height: 120px;
  		margin: -76px 0 0 -76px;
  		border: 16px solid #f3f3f3;
  		border-radius: 50%;
  		border-top: 16px solid #3498db;
  		-webkit-animation: spin 2s linear infinite;
  		animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
  		0% { transform: rotate(0deg); }
  		100% { transform: rotate(360deg); }
	}
	#myDiv {
  		display: none;
	}
</style>
</head>
<body onload="Loading()">
	<div style="display:none;" id="myDiv">
		
		<audio id="wosh">
  			<source src="../media/Wosh.wav" type="audio/wav">
		</audio>
		
	<div id="loader"></div>
	<div class="wow slideInDown">
		
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
		<h3>Officia</h3>
	</div>
	</div>

        <ul>
            <div class="wow fadeInLeft"><li><a><u>Profile</u></a></li></div>
            <div class="wow fadeInLeft"><li><a href="../../Absensi/Home.html">Absen</a></li></div>
			<div class="wow fadeInLeft"><li><a href="../../Pengumuman/pengumuman.html">Pengumuman</a></li></div>
            <div class="wow fadeInLeft"><li><a onclick="Allert()">Log-out</a></li></div>
			<div class="wow fadeInLeft"><li><button onclick="DarkMode()" class="dark"><img src="https://static.thenounproject.com/png/1664849-200.png" alt="" height="23px"></button></li></div>
        </ul>
</nav>
	</div>
	<div class="bio">
		<table class="center">	
	  		<tr>
    			<td rowspan="8"><img src="data:image/png;base64,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" alt="" draggable="false" style="overflow: hidden"></td>
  			</tr>
			
  			<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
    			<td height="10%">Nama</td>
				<td height="10%" style="opacity: 0">1</td>
    			<td height="10%">:</td>
				<td height="10%"><?php echo $_GET['nama']; ?></td>
  			</tr>
  			<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
    			<td height="10%">Umur</td>
				<td height="10%" style="opacity: 0">1</td>
    			<td height="10%">:</td>
				<td height="10%"><?php echo $_GET['umur']; ?></td>
  			</tr>
			<tr>
			<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">Jabatan</td>
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">:</td>
				<td height="10%"><?php echo $_GET['jabatan']; ?></td>
			</tr>
			</tr>
			<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">NIK</td>
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">:</td>
				<td height="10%"><?php echo $_GET['nik']; ?></td>
			</tr>
				<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">No.Telp</td>
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">:</td>
				<td height="10%"><a href="tel:<?php echo $_GET['tel']; ?>"><?php echo $_GET['tel']; ?></a></td>
			</tr>
			<tr style="opacity: 0.8">
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">Email</td>
				<td height="10%" style="opacity: 0">1</td>
				<td height="10%">:</td>
				<td height="10%"><a href="mailto: <?php echo $_GET['email']; ?>"><?php echo $_GET['email']; ?></a></td>
			</tr>
			<tr style="width: 0%;"> 
				<td style="opacity: 0"> 1 </td>
			</tr>
		</table>
	</div>
	<div class="ov">
		<hr>
	<div class="wow zoomIn"><h1 class="center2"><a onClick="overview()">Overview</a></h1></div><hr>
	</div>
		
	<div class="progres">
	<div class="wow slideInLeft">
		<label>Skills:</label><br>
			<progress value="90" max="100"> 90% </progress><br>
		<label>Progres pekerjaan:</label><br>
			<progress value="70" max="100"> 70% </progress>
	</div>
</div>
		<div class="wow fadeIn">
		<p class="Activated"><a onclick="ActivatedTugas();setTimeout(avg, 800)">Tugas minggu ini</a></p></div>
		<!--Tugas 1-->
	<div class="wow fadeInDown">
			<p class="box"><a onclick="task();setTimeout(avg, 800)">12 Agustus</a></p>
	</div>
	<div class="wow fadeIn">
				<hr class="BorderOne">
	</div>
	<div class="wow fadeInUp">
			<p class="box2">Menjaga keamanan<br><br>Patroli setiap hari dari jam <b>9:00</b> sampai <b>21:00</b><br></p>
	</div>
<!--Tugas 2-->
			<p class="TwoNdBox"><a onclick="TwoNdTask()">9 Agustus</a></p>
				<hr class="BorderTwo">
			<p class="TwoNdBox2">Memperketat keamanan<br><br>Memastikan setiap pendatang tidak membawa alat tajam dan melarang siapapun untuk masuk/keluar dari rentan waktu pukul <b>12:00</b> sampai <b>14:00</b></p>
<!--Tugas 3-->
			<p class="ExtendBox"><a onclick="ExtendTask()">8 Agustus</a></p>
				<hr class="BorderExtend">
			<p class="ExtendBox2">[Libur]</p>
<!--Tugas 4-->
			<p class="MaxBox"><a onclick="MaxTask()">7 Agustus</a></p>
				<hr class="BorderMax">
			<p class="MaxBox2">Menjaga keamanan<br><br>Patroli setiap hari dari jam <b>9:00</b> sampai <b>21:00</b></p>
		<h5 class="copyr">Officia, Copyright &copy; 2021. All Right Reserved</h5>
	</div>

<script src="script.js"></script>
<script src="wow.min.js"></script>
	<script>
         new WOW().init();
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>