<?php
	if(!isset($_SESSION['prod'])){
		$_SESSION['prod'] = array();
		$_SESSION['qty'] = array();
	}  
	include_once 'php/checksession.php';
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
	<script>load()</script>
	<div id="navbar"></div>
	<div class="divspace"><br></div>
	<input type="text" id="orderidholder" hidden value="" />
	<main>
		<div class="container-fluid animated fadeIn">
			<div class="card red text-left z-depth-5">
				<div class="card-body z-depth-1">
					<a href="orders.php" class="linknostyle">
					<h1 class="white-text mb-0"><i class="fa fa-suitcase" aria-hidden="true"></i> My Orders</a></h1>
					</a>
				</div>
			</div>
		</div>
		<div class="divspace"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 ld-over">
					<div class="ld ld-ball ld-bounce"></div>
					<div class="list-group animated fadeIn" id="myorders">
						
					</div>
				</div>
			</div>
		</div>
	</main>
	<div class="divspace"></div>
	<div id="footer"></div>
</body>

</div>
</html>
<div class="modal fade" id="cancelordermodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Cancel Order</strong></h4>
                <button type="button" id="deleteprodmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to cancel this order?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="cancelorder()">Delete</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<script>
	$(document).ready(function(){
		showorders();

	})
	function showorders(){
		$.ajax({
			url: "php/orders.php",
			method: "POST",
			data: {action: "showorders"},
			beforeSend: function(){
				$('#myorders').html(load1().replace("<br><br><br>", ""));
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#myorders").html(data);
			}
		});
	}
	function chooseorder(id){
		$("#orderidholder").val(id);
	}
</script>