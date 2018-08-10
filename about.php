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
				<h1 class="white-text mb-0"><i class="fa fa-at" aria-hidden="true"></i> About Us</a></h1>
				</a>
			</div>
		</div>
	</div>
	<main>
		<div class="divspace"><br><br></div>

		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-7">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<p class="h4-responsive p-1 blue-text"><i class="fa fa-map-marker" aria-hidden="true"></i> Our Location:</p>
								<p class="blue-text">OBL Subdivision, Rufina Tapangan Drive, Putik Tumaga Road, Zamboanga City, Philippines</p>
							</div>

							
						</div>
						<div class="row">
							<div class="col-lg-12">
								
								<div class="d-flex justify-content-center">
									<iframe src="https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d4146.220918860202!2d122.08362276489883!3d6.941958544984503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e6!4m3!3m2!1d6.942031699999999!2d122.085697!4m3!3m2!1d6.942039899999999!2d122.085687!5e1!3m2!1sen!2sph!4v1504955918771" height="500" width="800" frameborder="0" style="border:0;" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
					
					
					
				</div>
				
				<div class="col-lg-5 d-flex flex-column">
					<div class="bg-blue mg1">
						<p class="h2-responsive p-4 white-text">Like Us on Facebook <i class="fa fa-thumbs-up" aria-hidden="true"></i></p>
						<p class="h5-responsive white-text indent"><i class="fa fa-facebook-official" aria-hidden="true"></i> facebook.com/Dolce-Atelier-1582682975088173</p>
						<a target="_blank" href="https://www.facebook.com/Dolce-Atelier-1582682975088173/"><h1 class="indent"><span class="badge badge-pill badge-primary">Like <i class="fa fa-thumbs-up" aria-hidden="true"></i></span></h1></a>
						<br>
					</div>
					<div class="bg-light-blue mg1">
						<p class="h2-responsive p-4 white-text darken-2">Follow Us on Twitter <i class="fa fa-twitter" aria-hidden="true"></i></p>
						<p class="h5-responsive white-text indent"><i class="fa fa-twitter-square" aria-hidden="true"></i> twitter.com/dolceatelier17</p>
						<a target="_blank" href="https://twitter.com/dolceatelier17"><h1 class="indent"><span class="badge badge-pill badge-info darken-2">Follow <i class="fa fa-twitter" aria-hidden="true"></i></span></h1></a>
						<br>
					</div>
					<div class="bg-amber mg1">
						<p class="h2-responsive p-4 white-text darken-2">Follow Us on Instagram <i class="fa fa-instagram" aria-hidden="true"></i></p>
						<p class="h5-responsive white-text indent"><i class="fa fa-instagram" aria-hidden="true"></i> instagram.com/dolceatelier00</p>
						<a target="_blank" href="https://www.instagram.com/dolceatelier00"><h1 class="indent"><span class="badge badge-pill badge-orange darken-2">Follow <i class="fa fa-instagram" aria-hidden="true"></i></span></h1></a>
						<br>
					</div>
					
				</div>
			</div>
		</div>
	</main>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>
</html>