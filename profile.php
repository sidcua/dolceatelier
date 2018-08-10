<?php  
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}
	include_once 'php/checksession.php';
	include_once 'php/checkadmin.php';
	include 'views/login.php';
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
	<script>
		load();
	</script>

	<div id="navbar"></div>
	<div class="divspace"><br></div>
	<main>
		<div class="container-fluid animated fadeIn">
			<div class="card green text-left z-depth-5">
				<div class="card-body z-depth-1">
					<a href="profile.php" class="linknostyle">
					<h1 class="white-text mb-0"><i class="fa fa-user-secret" aria-hidden="true"></i> My Profile</a></h1>
					</a>
				</div>
			</div>
		</div>
		<div class="divspace"><br><br><br></div>

		<div class="divspace"></div>
		<div class="container">
			<p class="h1-responsive blue-text"><i class="fa fa-wrench" aria-hidden="true"></i> Account</p>
		    <div class="divspace"></div>
		    <div id="account">
		    	<script>account_content("1")</script>
		    </div>
		    <div class="divspace"></div>
			<p class="h1-responsive green-text"><i class="fa fa-user" aria-hidden="true"></i> Personal Info</p>
	    	<div class="divspace"></div>
	    	<div id="info">
	    		<script>info_content("1")</script>
	    	</div>
		</div>
		<div class="divspace"></div>
		<div class="container">
			<p class="h1-responsive purple-text"><i class="fa fa-map" aria-hidden="true"></i> Optional Address</p>
	    	<div class="divspace"></div>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-8">
					<div class="collapse" id="collapseaddress">
						<p id="errormsgaddress" class="error"></p>
						<div class="md-form">
						    <input type="text" id="addressname" class="form-control">
						    <label for="addressname" class="">Name</label>
						</div>
						<div class="md-form">
						    <input type="text" id="addressaddress" class="form-control">
						    <label for="addressaddress" class="">Address</label>
						</div>
						<div class="md-form">
						    <input type="text" id="addresscontact" class="form-control">
						    <label for="addresscontact" class="">Contact</label>
						</div>
						<div class="d-flex justify-content-end">
							<button onclick="addoptionaddress()" type="button" class="btn btn-success waves-effect waves-light">Add</button>
							<button type="button" data-toggle="collapse" data-target="#collapseaddress" class="btn btn-secondary waves-effect waves-light">Cancel</button>
						</div>
						<div class="divspace"></div>
					</div>
					<div id="divaddress" class="list-group ld-over">

					</div>
				</div>
				<div class="col-lg-3">
					<div class="container">
						<div class="row d-flex justify-content-center">
							<button data-toggle="collapse" data-target="#collapseaddress" type="button" class="btn btn-outline-secondary waves-effect">Add Address</button>
						</div>
						<div class="row d-flex justify-content-center">
							<button data-toggle="modal" data-target="#deleteoptaddress" type="button" class="btn btn-outline-danger waves-effect">Clear All</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>
<div class="modal fade" id="deleteoptaddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Delete</strong></h4>
                <button type="button" id="deleteprodmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to remove all your option address?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="removealloptaddress()">Delete</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
</html>
<script>
	$(document).ready(function(){
		fetchdata();
		$("#collapseaddress").on('hidden.bs.collapse', function(){
			$("#errormsgaddress").html("");
		});
	});
	function fetchdata(){
		$.ajax({
			url: "php/account.php",
			method: "POST",
			data: {action: "showaddress"},
			beforeSend: function(){
				$('#divaddress').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#divaddress").html(data);
			}
		})
	}
</script>