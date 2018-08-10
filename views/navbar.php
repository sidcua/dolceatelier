<?php session_start(); ?>
<nav id="nav" class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar x-navbar clearfix pink">
		<a class="navbar-brand waves-effect waves-light headerlogo1 animated flash" href="index.php">Dolce Atelier</a>
		<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			    	<?php 
			    		if($_SESSION['accID'] != "") {
			    			include '../php/connect.php';
			    			$accid = $_SESSION['accID'];
			    			$sql = mysql_query("SELECT quantity FROM cart WHERE accID = '$accid'");
			    			if(mysql_num_rows($sql) == 0){
			    				$items = 0;
			    			}
			    			else{
			    				while($fetch = mysql_fetch_assoc($sql)){
									$items += $fetch['quantity'];
								}
			    			}
			    			echo '<li class="nav-item" id="badgewrapper">
						          	<span id="itembadgecounter" class="badge badge-danger badge-pill" style="z-index: 2;">'.$items.'</span>
						       	  </li>
			    			      <li class="nav-item">
						          <a onclick="showcartitem()" class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#cartmodal"><span id="itemcart" class="fa fa-cart-arrow-down" aria-hidden="true"></span> Cart</a>
						       	  </li>';
			    		}
			    		else{
			    			echo '<li class="nav-item" id="badgewrapper">
						          	<span id="itembadgecounter" class="badge badge-danger badge-pill" style="z-index: 2;"></span>
						       	  </li>
			    			      <li class="nav-item">
						          <a onclick="showcartitem()" class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#cartmodal"><span id="itemcart" class="fa fa-cart-arrow-down" aria-hidden="true"></span> Cart</a>
						       	  </li>';
			    		}
			    	?>
			        <li class="nav-item">
			            <a class="nav-link waves-effect waves-light" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only"></span></a>
			        </li>
			        <li class="nav-item">
			            <a class="nav-link waves-effect waves-light" href="products.php"><i class="fa fa-database" aria-hidden="true"></i> Products</a>
			        </li>
			        <li class="nav-item">
			            <a class="nav-link waves-effect waves-light" href="about.php"><i class="fa fa-at" aria-hidden="true"></i> About</a>
			        </li>
			        <li class="nav-item dropdown">
			            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
			            <?php
			            	if(isset($_SESSION['name'])) {
			            		echo $_SESSION['name_on_nav'];
			            	}
			            	else {
			            		echo 'Guest';
			            	}
			            ?>
				        </a>	
				        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
					    	<?php
					    		if($_SESSION['accID'] != "") {
					    			echo '<a class="dropdown-item" href="profile.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> My Profile</a>
					    				<a class="dropdown-item" href="orders.php"><i class="fa fa-send-o" aria-hidden="true"></i> My Orders</a>
					    				';
					    			if ($_SESSION['position'] == 'Admin' or $_SESSION['position'] == 'Sub-Admin'){
					    				echo '<a class="dropdown-item" href="panel.php"><i class="fa fa-gears" aria-hidden="true"></i> Admin Panel</a>';
					    			}
					    			echo '<a class="dropdown-item" href="php/logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>';
					    		}
					    		else {
					    			echo '<a class="dropdown-item" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
					        			 <a class="dropdown-item" data-toggle="modal" data-target="#modalRegister"><i class="fa fa-edit" aria-hidden="true"></i> Register</a>';
					    		}
					    		echo '</div>';
					    	?>      
			        	</div>
		            </li>
			    </li>
		</ul>
	</div>
</nav>

<!-- Cart modal -->
<div class="modal fade right" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
    <!--Content-->
	    <div class="modal-content">
	        <!--Header-->
	        <div class="modal-header primary-color white-text">
	            <h3 class="modal-title w-100" id="myModalLabel"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><strong> Cart</strong></h3>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	        </div>
	        <!--Body-->
	        <div class="modal-body" style="max-height: 10%">
	        	 <div class="p-3">
		            <div class="d-flex justify-content-between">
		                <p class="h4-responsive mb-0"><strong>Items</strong></p>
		                <a class="" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <u>Manage Cart</u></a>
		            </div>
		            <div>
		            	<hr class="">
		            </div>
		        </div>
	        </div>
	        <div class="modal-body" style="max-height: 70%; overflow-y: auto;">
	        	<ul id="cartitemlist" class="list-group z-depth-0"></ul>
	        </div>
	        <div id="payment" class="modal-body d-flex justify-content-center" style="max-height: 10%">
				<div class="h5 grey-text">Total Payment:&nbsp;&nbsp;&nbsp;</div>
					<div class="h3">&#8369;<span id="totalpayment_modal" class="" style="display: inline-block;"></span>
				</div>
	        </div>
	        
	        <!--Footer-->
	        <div class="modal-footer justify-content-center">
	            <button type="button" class="btn btn-secondary waves-effect waves-light closecart" data-dismiss="modal">Close</button>
	            <div id="checkoutsubmodal">
	            	 <a href="checkout.php" class="btn btn-success waves-effect waves-light">Proceed to Checkout</a>
	            </div>
	           
	        </div>
	    </div>
	    <!--/.Content-->
	</div>
</div>

<script>
    $(document).ready(function(){
    	fetchtotalpayment();
        $('#modalLogin').on('hidden.bs.modal', function(){
        	var output = '<p class="error" id="errormsglogin"></p>'+
                    '<div class="md-form form-sm">'+
                        '<i class="fa fa-envelope prefix"></i>'+
                        '<input type="email" onKeyDown="if(event.keyCode==13)login();" id="loginemail" name="email" class="form-control">'+
                        '<label for="loginemail">Email</label>'+
                    '</div>'+

                    '<div class="md-form form-sm">'+
                        '<i class="fa fa-lock prefix"></i>'+
                        '<input type="password" id="loginpassword" name="password" onKeyDown="if(event.keyCode==13)login();" class="form-control">'+
                        '<label for="loginpassword">Password</label>'+
                    '</div>'+
                    '<div class="text-center mt-2">'+
                        '<button id="btnlogin" onclick="login()" name="btnlogin" class="btn btn-pink ld-over-inverse">'+
                            '<div class="ld ld-ring ld-spin"></div>'+
                            'Log In'+
                        '</button>'+
                    '</div>';
    //         $('#errormsglogin').html(null);
 			// $('#loginemail').val(null);
 			// $('#loginpassword').val(null);
 			$("#modallogintitle").html('<i class="fa fa-user"></i> Log In');
 			$("#loginmodalbody").html(output);
        });
        itembadge_anon(<?php echo $_SESSION['accID']; ?>);
		$('#modalRegister').on('hidden.bs.modal', function(){
        	$("#errormsgreg").html("");
        });
    });
    function fetchtotalpayment(){
    	$.ajax({
    		url: "php/cart.php",
    		method: "POST",
    		data: {action: "totalpayment_text"},
    		beforeSend: function(){
    			$("#totalpayment_modal").text("");
    		},
    		success: function(data){
    			data = $.parseJSON(data);
    			$("#totalpayment_modal").text(data);
    		}
    	})
    }
    function itembadge_anon(session){
    	if(!session){
    		$.ajax({
	    		url: "php/cart.php",
	    		method: "POST",
	    		data: {action: "itembadge_anon"},
	    		beforeSend: function(){
	    			$("#itembadgecounter").html("");
	    		},
	    		success: function(data){
	    			data = $.parseJSON(data);
	    			$("#itembadgecounter").html(data);
	    		}
	    	});
    	}
    }
</script>