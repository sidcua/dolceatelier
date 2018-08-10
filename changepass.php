<?php
	$content = "1";
	session_start();
	include 'views/login.php'; 
	include 'views/register.php';
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}
	include 'php/checkemailfornewpass.php';
	if(!isset($_SESSION['accID'])){
		$_SESSION['accID'] = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Dolce Atelier</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/mdb.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/glyphicon.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/loading.css" />
	<link rel="stylesheet" type="text/css" href="css/loading-btn.css" />
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/mdb.js"></script>
	<script type="text/javascript" src="js/dolce.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59ecd8c24854b82732ff703e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</head>
<body>
	<script>load()</script>
	<div id="navbar"></div>
	<div class="divspace"><br><br><br><br></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			
			<div class="col-lg-8" id="divchangepass">
				<div><?php echo $_SESSION['emailfornewpass']; ?>
				    <p class="h1-responsive text-center mb-4 blue-text"><i class="fa fa-eraser" aria-hidden="true"></i> Change Password</p>
				    <p class="error" id="errormsgnewpass"></p>
				    <div class="md-form">
				        <i class="fa fa-envelope prefix grey-text"></i>
				        <input type="password" id="changepass1" class="form-control">
				        <label for="changepass1">New Password</label>
				    </div>

				    <div class="md-form">
				        <i class="fa fa-lock prefix grey-text"></i>
				        <input type="password" id="changepass2" class="form-control">
				        <label for="changepass2">Confirm New Password</label>
				    </div>

				    <div class="text-center">
				        <button id="btnconfirmnewpass" onclick="newpassword()" class="btn btn-primary ld-over-inverse">
				        	<div class="ld ld-ring ld-spin"></div>
				        	Save
				    	</button>
				    </div>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>
	<div class="divspace"><br><br><br><br></div>
	<div id="footer"></div>
</body>
</html>