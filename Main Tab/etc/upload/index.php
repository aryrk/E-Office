<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../../../Login/login1.php");
	exit ();
}
?>
<html>  
    <head>  
        <title>Upload Image</title>  
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel = "icon" href ="../../../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
		<script src="jquery.min.js"></script>  
		<script src="bootstrap.min.js"></script>
		<script src="croppie.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<link rel="stylesheet" href="croppie.css" />
		
		<style>
		img[alt*="000webhost"],
		img[alt*="000webhost"][style],
		img[src*="000webhost"],
		img[src*="000webhost"][style],
		body > div:nth-last-of-type(1)[style]{
			opacity: 0 !important;
			pointer-events:none !important;
			width: 0px !important;
			height: 0px !important;
			visibility:hidden !important;
			display:none !important;
		}
		</style>
    </head>  
    <body>  
        <div class="container">
          <br />
      <h3 align="center">Pilih dan Crop Foto</h3>
      <br />
      <br />
			<div class="panel panel-default">
  				<div class="panel-heading">Select Profile Image. <a href="../Main.php">Back</a></div>
  				<div class="panel-body" align="center">
  					<input type="file" name="upload_image" id="upload_image" />
  					<br/>
  					<div id="uploaded_image"></div>
  				</div>
  			</div>
  		</div>
    </body>  
</html>

<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body" style="height: 450px;">
        		<div class="row">
  					<div class="col-md-8 text-center">
						<button class="btn btn-success crop_image">Crop & Upload Image</button>
						  <div id="image_demo" style="width:100%; margin-top:30px;"></div>
  					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>

<script>  
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:100+"%",
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
        }
      });
    })
  });

});  
</script>
