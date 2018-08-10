<?php  
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}
	include 'php/connect.php';
	// include 'php/checkguestcart.php';
	include 'views/login.php';
	if($_SESSION['accID'] != ""){
		$accid = $_SESSION['accID'];
		$sql = mysql_query("SELECT * FROM cart WHERE accID = '$accid'");
		if(mysql_num_rows($sql) == 0){
			header("location: index.php");
		}
	}
	if($_SESSION['checkoutstep'] == "ordercomplete"){
		header("location: products.php");
	}
	if(!isset($_SESSION['checkoutstep'])){
		$_SESSION['checkoutstep'] = "delivery";
	}
	if(!isset($_SESSION['checkout_deliver'])){
		$_SESSION['checkout_deliver'] = "pickup";
	}
	if(!isset($_SESSION['checkout_address'])){
		$_SESSION['checkout_address'] = 0;
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
	<div class="divspace" disabled><br><br><br></div>
		<div class="container">
			<div class="row">
				<p class="h1-responsive text-center">Checkout</p>
			</div>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<div class="container">
						<div id="divcircles" class="row d-flex justify-content-center text-center">
	
						</div>
					</div>
				</div>
				<div class="col-lg-1"></div>
			</div>
			<div class="row" id="divcheckout">
				
			</div>
			
		</div>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>

</html>
<script>
	$(document).ready(function(){
		$("body").on('click', '#pickup', function(){
			$("#pickup").addClass("white-text active");
			$("#deliver").removeClass("white-text active");
			pickup();
		})
		$("body").on('click', '#deliver', function(){
			$("#deliver").addClass("white-text active");
			$("#pickup").removeClass("white-text active");
			deliver();
		})
		loadcircles();
		loadcheckout();
	})
	function activetoggleaddress(addid){
		$(".list-group>a.active").removeClass("active white-text");
		$("#address" + addid).addClass("active white-text");
		address(addid);
	}
	function loadcheckout(){
		$.ajax({
			url: "php/checkout.php",
			method: "POST",	
			data: {action: "loadcheckout"},
			success: function(data){
				data = $.parseJSON(data);
				$("#divcheckout").html(data);
			}
		});
	}
	function loadcircles(){
		$.ajax({
			url: "php/checkout.php",
			method: "POST",
			data: {action: "loadcircles"},
			success: function(data){
				data = $.parseJSON(data);
				$("#divcircles").html(data);
			}
		});
	} 
</script>