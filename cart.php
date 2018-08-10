<?php
	session_start();
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
	<div class="divspace"><br></div>
	<div class="container-fluid animated fadeIn">
		<div class="card info-color z-depth-3">
			<div class="card-body z-depth-1">
				<a href="cart.php" class="linknostyle">
				<h1 class="white-text mb-0"><i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart</a></h1>
				</a>
			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-1"></div>
			<div class="col-lg-7">
				<p class="error" id="errormsgcartitems"></p>
				<div id="cartitems" class="container animated fadeIn">
					
				</div>
			</div>
			<div id="divpayment" class="col-lg-3 animated fadeIn text-center">
	
			</div>
			<div class="col-lg-1"></div>
		</div>
	</div>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>
</html>
<script>
	$(document).ready(function(){
		function fetchdata(){
			$.ajax({
				url: "php/cart.php",
				method: "POST",
				data: {action: "cartitems"},
				beforeSend: function(){
					$('#cartitems').html(load1());
				},
				success: function(data){
					data = $.parseJSON(data);
					$('#cartitems').html(data);
				}
			});
			$.ajax({
				url: "php/cart.php",
				method: "POST",
				data: {action: "totalpayment"},
				beforeSend: function(){
					$('#divpayment').html(load2());
				},
				success: function(data){
					data = $.parseJSON(data);
					$('#divpayment').html(data);
				}
			});
		}
		fetchdata();
		$('body').tooltip({selector: '[data-toggle="tooltip"]'});
	});
</script>