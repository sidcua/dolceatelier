<?php
	$content = "1";
	session_start();
	include 'php/checkerroraccess.php';
	include 'views/login.php'; 
	include 'views/register.php';
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}
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
		<br><br>
		<div class="row d-block">
			<div class="">
			    <h1 class="h1-responsive red-text"><i class="fa fa-times-circle" aria-hidden="true"></i> Something Wrong </h1>
			    <p class="lead">We're confused on your request.</p>
			    <hr class="my-2">
			    <p>Try clicking again on the link provided from your email.</p>
			    <p>Try checking the url for a mismatch.</p>
			</div>
		</div>
	</div>
	<div class="divspace"><br><br><br><br><br><br><br></div>
	<div id="footer"></div>
</body>
</html>