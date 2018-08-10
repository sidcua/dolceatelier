<?php
	session_start();
	include 'views/login.php'; 
	include 'views/register.php';
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}
	if(!isset($_SESSION['category'])){
		$_SESSION['category'] = "showall";
	}
	if(!isset($_SESSION['accID'])){
		$_SESSION['accID'] = "";
	}
	if(isset($_SESSION['checkoutstep'])){
		if($_SESSION['checkoutstep'] == "ordercomplete"){
			unset($_SESSION['checkoutstep']);
		}
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
	<div class="divspace"></div>
	<main>
		<div class="divspace"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<div class="card indigo text-center z-depth-2 animated fadeInLeft">
						<div class="card-body">
							<h2 class="white-text mb-0">Category</h2>
						</div>
					</div>
					<div class="divspace"></div>
					<div class="list-group animated fadeInLeft">
						<a id="showall" onclick="choicecategory('showall')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-map-pin" aria-hidden="true"></i> All</a>
					    <a id="showcupcake" onclick="choicecategory('showcupcake')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-map-pin" aria-hidden="true"></i> Cupcakes</a>
					    <a id="showmug" onclick="choicecategory('showmug')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-map-pin" aria-hidden="true"></i> Mugs</a>
					    <a id="showmugwithcake" onclick="choicecategory('showmugwithcake')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-map-pin" aria-hidden="true"></i> Mugs with Cake</a>
					</div>
					<br>
				</div>
				<div class="col-md-9">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<div class="container">
									<div class="row animated fadeInRight">
										<div class="col-md-11	">
											<div class="md-form">
								                <i class="fa fa-search prefix" aria-hidden="true"></i>
								                <input type="text" id="searchproduct" class="form-control">
								                <label for="searchproduct">Search</label> 
							            	</div> 
										</div>
										<div class="col-md-1"></div>
									</div>
								</div> 
							</div>
						</div>
						<div id="menu" class="animated fadeIn"></div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>
</html>

<script>
	$(document).ready(function(){
		function fetchdata(category){
			$.ajax({
				url: "php/product.php",
				method: "POST",
				data: {action: category},
				beforeSend: function(){
					$("#menu").html(load1());
				},
				success: function(data){
					$("#menu").html(data);
				}
			});
		}
		fetchdata('<?php echo $_SESSION['category']; ?>');
		activetogglelist('<?php echo $_SESSION['category']; ?>');
		$('body').tooltip({ selector: '[data-toggle="tooltip"]'});
	});
	function activetogglelist(category){
		var btnshowall = document.getElementById("showall");
		var btnshowcupcake = document.getElementById("showcupcake");
		var btnshowmug = document.getElementById("showmug");
		var btnshowmugwithcake = document.getElementById("showmugwithcake");
		if(category == "showall"){
			btnshowall.classList.remove("active");
			btnshowcupcake.classList.remove("active");
			btnshowmug.classList.remove("active");
			btnshowmugwithcake.classList.remove("active");
			btnshowall.className += " active white-text";
		}
		else if(category == "showcupcake"){
			btnshowall.classList.remove("active");
			btnshowcupcake.classList.remove("active");
			btnshowmug.classList.remove("active");
			btnshowmugwithcake.classList.remove("active");
			btnshowcupcake.className += " active white-text";
		}
		else if(category == "showmug"){
			btnshowall.classList.remove("active");
			btnshowcupcake.classList.remove("active");
			btnshowmug.classList.remove("active");
			btnshowmugwithcake.classList.remove("active");
			btnshowmug.className += " active white-text";
		}
		else if(category == "showmugwithcake"){
			btnshowall.classList.remove("active");
			btnshowcupcake.classList.remove("active");
			btnshowmug.classList.remove("active");
			btnshowmugwithcake.classList.remove("active");
			btnshowmugwithcake.className += " active white-text";
		}
	}
	function choicecategory(category){
		if(category == "showall"){
			$.ajax({
				url: "php/product.php", 
				method: "POST",
				data: {action: category},
				dataType: "text",
				beforeSend: function(){
					$("#menu").html(load1());
				},
				success: function(data){
					$("#menu").html(data);
				}
			});
		}
		else if(category == "showcupcake"){
			$.ajax({
				url: "php/product.php", 
				method: "POST",
				data: {action: category},
				dataType: "text",
				beforeSend: function(){
					$("#menu").html(load1());
				},
				success: function(data){
					$("#menu").html(data);
				}
			});
		}
		else if(category == "showmug"){
			$.ajax({
				url: "php/product.php", 
				method: "POST",
				data: {action: category},
				dataType: "text",
				beforeSend: function(){
					$("#menu").html(load1());
				},
				success: function(data){
					$("#menu").html(data);
				}
			});
		}
		else if(category == "showmugwithcake"){
			$.ajax({
				url: "php/product.php", 
				method: "POST",
				data: {action: category},
				dataType: "text",
				beforeSend: function(){
					$("#menu").html(load1());
				},
				success: function(data){
					$("#menu").html(data);
				}
			});
		}
	}
	
	$("#showall").click(function(){
		document.getElementById("showall").className += " white-text";
		document.getElementById("showcupcake").classList.remove("white-text");
		document.getElementById("showmug").classList.remove("white-text");
		document.getElementById("showmugwithcake").classList.remove("white-text");
	})
	$("#showcupcake").click(function(){
		document.getElementById("showall").classList.remove("white-text");
		document.getElementById("showcupcake").className += " white-text";
		document.getElementById("showmug").classList.remove("white-text");
		document.getElementById("showmugwithcake").classList.remove("white-text");
	})
	$("#showmug").click(function(){
		document.getElementById("showall").classList.remove("white-text");
		document.getElementById("showcupcake").classList.remove("white-text");
		document.getElementById("showmug").className += " white-text";
		document.getElementById("showmugwithcake").classList.remove("white-text");
	})
	$("#showmugwithcake").click(function(){
		document.getElementById("showall").classList.remove("white-text");
		document.getElementById("showcupcake").classList.remove("white-text");
		document.getElementById("showmug").classList.remove("white-text");
		document.getElementById("showmugwithcake").className += " white-text";
	})
</script>

