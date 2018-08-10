<?php  
	session_start();
	include 'connect.php';
	$action = mysql_escape_string($_POST['action']);
	function currentstep(){
		$output .= '<br>';
		if($_SESSION['checkoutstep'] == "delivery"){
			$output .= 
			'<div class="container">
	        	<div class="row">
	        		<div class="col-lg-1"></div>
	        		<div class="col-lg-10 animated fadeInRight ld-over">
	        			<div class="ld ld-ball ld-bounce"></div>
	        			<p class="h2-responsive p-2"><i class="fa fa-truck" aria-hidden="true"></i> Mode of Delivery</p>
	        			<div class="list-group">
						  <a id="pickup" class="list-group-item list-group-item-action flex-column align-items-start ';
						  if($_SESSION['checkout_deliver'] == "pickup"){
						  	$output .=
						  	'active white-text';
						  }
						  $output .= '">
						    <div class="d-flex w-100 justify-content-between">
						      <h3 class="mb-1">Pick Up</h3>
						    </div>
						    <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get your order at our local store</p>
						  </a>
						  <a id="deliver" class="list-group-item list-group-item-action flex-column align-items-start ';
						  if($_SESSION['checkout_deliver'] == "deliver"){
						  	$output .=
						  	'active white-text';
						  }
						  $output .= '">
						    <div class="d-flex w-100 justify-content-between">
						      <h3 class="mb-1">Deliver to You</h3>
						    </div>
						    <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We\'ll deliver your orders infront of your house</p>
						  </a>
						</div>
						<br>
	        			<div class="d-flex justify-content-end">
					    	<button onclick="proceedtolvl2()" data-toggle="tab" data-target="#paneladdress" type="button" class="btn btn-success">Proceed</button>
					    </div>
	        		</div>
	        		<div class="col-lg-1"></div>
	        	</div>
	        </div>';
		}
		else if($_SESSION['checkoutstep'] == "address"){
			$output .= 
				'<div class="container">
				        	<div class="row">
				        		<div class="col-lg-1"></div>
				        		<div class="col-lg-10 animated fadeInRight ld-over">
				        		<div class="ld ld-ball ld-bounce"></div>
				        			<p class="h2-responsive p-2"><i class="fa fa-map" aria-hidden="true"></i> Address</p>
				        			<div class="list-group">';
			if($_SESSION['accID'] != ""){
				$accid = $_SESSION['accID'];
				$sql = mysql_query("SELECT * FROM account WHERE accID = '$accid'");
				$fetch = mysql_fetch_assoc($sql);
				$addid = $fetch['addressID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$output .= 
				'<a onclick="activetoggleaddress(0)" id="address0" class="list-group-item list-group-item-action flex-column align-items-start ';
					if($_SESSION['checkout_address'] == 0){
						$output .= 
						'active white-text';
					}
					$output .= '">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">'.$name.'</h5>
				    </div>
				    <p class="mb-1">'.$address.'</p>
				    <small class="">'.$contact.'</small>
				  </a>';
				$sql = mysql_query("SELECT * FROM address WHERE accID = '$accid'");
				  	if(mysql_num_rows($sql) > 0){
				  		while($fetch = mysql_fetch_assoc($sql)){
				  			$addid = $fetch['addressID'];
				  			$name = $fetch['name'];
				  			$address = $fetch['address'];
				  			$contact = $fetch['contact'];
				  			$output .=
				  			'<a onclick="activetoggleaddress('.$addid.')" id="address'.$addid.'" class="list-group-item list-group-item-action flex-column align-items-start ';
				  			if($_SESSION['checkout_address'] == $addid){
				  				$output .= "active white-text";
				  			}
				  			$output .= '">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">'.$name.'</h5>
							    </div>
							    <p class="mb-1">'.$address.'</p>
							    <small class="">'.$contact.'</small>
							  </a>';
						}
		    	}
		    	$output .=
				'</div><br>
		        			<div class="d-flex justify-content-between">
						    	<button onclick="backtolvl1()" type="button" class="btn btn-secondary">Back</button>
						    	<button onclick="proceedtolvl3()" type="button" class="btn btn-success">Proceed</button>
						    </div>
		        		</div>
		        		<div class="col-lg-1"></div>
		        	</div>
		        </div>';
			}
			else{
				$output .= 
				'<div class="container">
					<div class="row">
						<div class="col-lg-2"></div>
							<div class="col-lg-8">
								<p class="error" id="errormsgcheckoutaddress"></p>
								<div class="md-form">
								    <i class="fa fa-user prefix"></i>
								    <input type="text" id="addemail" class="form-control">
								    <label for="form2">Email (Optional)</label>
								</div>
								<div class="md-form">
								    <i class="fa fa-user prefix"></i>
								    <input type="text" id="addname" class="form-control">
								    <label for="form2">Name</label>
								</div>
								<div class="md-form">
								    <i class="fa fa-map prefix" aria-hidden="true"></i>
								    <input type="text" id="addaddress" class="form-control">
								    <label for="form2">Address</label>
								</div>
								<div class="md-form">
								    <i class="fa fa-phone prefix" aria-hidden="true"></i>
								    <input type="text" id="addcontact" class="form-control">
								    <label for="form2">Contact</label>
								</div>
							</div>
						<div class="col-lg-2"></div>
					</div>
				</div>
				';
				$output .=
			'</div><br>
	        			<div class="d-flex justify-content-between">
					    	<button onclick="backtolvl1()" type="button" class="btn btn-secondary">Back</button>
					    	<button onclick="proceedtolvl3_anon()" type="button" class="btn btn-success">Proceed</button>
					    </div>
	        		</div>
	        		<div class="col-lg-1"></div>
	        	</div>
	        </div>';
			}
		}
		else if($_SESSION['checkoutstep'] == "placeorder"){
			if($_SESSION['accID'] != ""){
				$output .= 
				'<div class="container">
		        	<div class="row">
		        		<div class="col-lg-1"></div>
		        		<div class="col-lg-10 animated fadeInRight ld-over-full">
		        			<div class="ld ld-ball ld-bounce"></div>
		        			<p class="h2-responsive p-2"><i class="fa fa-map-pin" aria-hidden="true"></i> Place Order</p>
		        			<div class="container-fluid">
		        				<div class="row">
		        					<div class="col-lg-7">
		        						<div class="list-group" style="height: 400px; overflow-y: auto;">';
						        			$accid = $_SESSION['accID'];
						        			$sql = mysql_query("SELECT * FROM product INNER JOIN cart ON product.productID = cart.productID WHERE accID = '$accid'");
						        			while($fetch = mysql_fetch_assoc($sql)){
						        				$title = $fetch['title'];
						        				$quantity = $fetch['quantity'];
						        				$price = $fetch['price'];
						        				$output .= 
						        				'<a class="list-group-item list-group-item-action flex-column align-items-start">
											    <div class="d-flex w-100 justify-content-between">
											      <h5 class="mb-1">'.$title.'</h5>
											      <small><span class="badge badge-primary badge-pill">'.$quantity.'</span></small>
											    </div>
											    <p class="mb-1">'.$price.'</p>
											  </a>';
						        			}
											$output .=   
										'</div>
		        					</div>
		        					<div class="col-lg-5 d-flex flex-column">';
		        					if($_SESSION['checkout_address'] == 0){
		        						$accid = $_SESSION['accID'];
		        						$sql = mysql_query("SELECT * FROM account WHERE accID = '$accid'");
		        						$fetch = mysql_fetch_assoc($sql);
		        						$name = $fetch['name'];
		        						$address = $fetch['address'];
		        						$contact = $fetch['contact'];
		        						$output .=
		        						'<p class="h3-responsive"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</p>
		        						<p class="h4-responsive"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
		        						<p class="h5-responsive"><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</p>
		        						';
		        					}
		        					else{
		        						$addid = $_SESSION['checkout_address'];
		        						$sql = mysql_query("SELECT * FROM address WHERE addressID = '$addid'");
		        						$fetch = mysql_fetch_assoc($sql);
		        						$name = $fetch['name'];
		        						$address = $fetch['address'];
		        						$contact = $fetch['contact'];
		        						$output .=
		        						'<p class="h3-responsive"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</p>
		        						<p class="h4-responsive"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
		        						<p class="h5-responsive"><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</p>
		        						';
		        					}
		        					if($_SESSION['checkout_deliver'] == "pickup"){
		        						$output .= 
		        						'<p class="h5-responsive"><i class="fa fa-truck" aria-hidden="true"></i> Pickup</p>';
		        					}
		        					else{
		        						$output .= 
		        						'<p class="h5-responsive"><i class="fa fa-truck" aria-hidden="true"></i> Deliver</p>';
		        					}
		        					$accid = $_SESSION['accID'];
		        					$sql = mysql_query("SELECT * FROM cart INNER JOIN product ON product.productID = cart.productID WHERE accID = '$accid'");
		        					$totalpayment = 0;
		        					while($fetch = mysql_fetch_assoc($sql)){
		        						$price = $fetch['price'];
		        						$quantity = $fetch['quantity'];
		        						$totalpayment += $price * $quantity;
		        					}
		        					$output .=
		        					'<br>
		        					<p class="h2-responsive">Total Payment: &#8369;'.$totalpayment.'</p>
		        					</div>
		        				</div>
		        			</div>
							<br>
		        			<div class="d-flex justify-content-between">
						    	<button onclick="backtolvl2()" type="button" class="btn btn-secondary">Back</button>
						    	<button onclick="ordercomplete()" type="button" class="btn btn-success">Place Order</button>
		        			</div>
		        		<div class="col-lg-1"></div>
		        	</div>
		        </div>';
			}
			else{
				$output .= 
				'<div class="container">
		        	<div class="row">
		        		<div class="col-lg-1"></div>
		        		<div class="col-lg-10 animated fadeInRight ld-over-full">
		        			<div class="ld ld-ball ld-bounce"></div>
		        			<p class="h2-responsive p-2"><i class="fa fa-map-pin" aria-hidden="true"></i> Place Order</p>
		        			<div class="container-fluid">
		        				<div class="row">
		        					<div class="col-lg-7">
		        						<div class="list-group" style="height: 400px; overflow-y: auto;">';
		        $cartprod = $_SESSION['prod'];
		        $cartqty = $_SESSION['qty'];
		        $totalpayment = 0;
		        for ($i=0; $i < count($cartprod); $i++) { 
		        	$prodid = $cartprod[$i];
		        	$sql = mysql_query("SELECT * FROM product WHERE productID = '$prodid'");
		        	$fetch = mysql_fetch_assoc($sql);
		        	$title = $fetch['title'];
    				$quantity = $cartqty[$i];
    				$price = $fetch['price'];
    				$totalpayment += $price * $quantity;
    				$output .= 
    				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">'.$title.'</h5>
				      <small><span class="badge badge-primary badge-pill">'.$quantity.'</span></small>
				    </div>
				    <p class="mb-1">'.$price.'</p>
				  </a>';
		        }
		        $output .=   
					'</div>
				</div>
				<div class="col-lg-5 d-flex flex-column">';
				$info = $_SESSION['checkout_address'];
				$output .=
				'<p class="h3-responsive"><i class="fa fa-user" aria-hidden="true"></i> '.$info['name'].'</p>
				<p class="h4-responsive"><i class="fa fa-map" aria-hidden="true"></i> '.$info['address'].'</p>
				<p class="h5-responsive"><i class="fa fa-phone" aria-hidden="true"></i> '.$info['contact'].'</p>';
				if($_SESSION['checkout_deliver'] == "pickup"){
					$output .= 
					'<p class="h5-responsive"><i class="fa fa-truck" aria-hidden="true"></i> Pickup</p>';
				}
				else{
					$output .= 
					'<p class="h5-responsive"><i class="fa fa-truck" aria-hidden="true"></i> Deliver</p>';
				}
				$output .= 
				'<br>
		        					<p class="h2-responsive">Total Payment: &#8369;'.$totalpayment.'</p>
		        					</div>
		        				</div>
		        			</div>
							<br>
		        			<div class="d-flex justify-content-between">
						    	<button onclick="backtolvl2()" type="button" class="btn btn-secondary">Back</button>
						    	<button onclick="ordercomplete()" type="button" class="btn btn-success">Place Order</button>
		        			</div>
		        		<div class="col-lg-1"></div>
		        	</div>
		        </div>';
			}
		}
		else if($_SESSION['checkoutstep'] == "ordercomplete"){
			$output .= 
			'<div class="container">
	        	<div class="row">
	        		<div class="col-lg-1"></div>
	        		<div class="col-lg-10 animated fadeInRight ld-over">
	        			<div class="ld ld-ball ld-bounce"></div>
	        			<div class="divspace"></div>
	        			<p class="h2-responsive p-2 text-center">Your Order was Successfull</p>
	        			<br>
	        			<p class="h5-responsive p-2 text-center">Dont hesitate...</p>
	        			<div class="d-flex justify-content-center">
					    	<a href="products.php" class="btn btn-primary">Continue Shopping</a>
					    </div>
	        		</div>
	        		<div class="col-lg-1"></div>
	        	</div>
	        </div>';

		}
		return $output;
	}
	function circles(){
		if($_SESSION['checkoutstep'] == "delivery"){
			$output =
			'<div class="col-lg-3">
				<div id="delivercircle">
					<h1><i class="fa blue-text fa-circle animated flash infinite" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Order Delivery</p>
			</div>
			<div class="col-lg-3">
				<div id="addresscircle">
					<h1><i class="fa fa-circle" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Address</p>
			</div>
			<div class="col-lg-3">
				<div id="ordercircle">
					<h1><i class="fa fa-circle" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Place Order</p>
			</div>';
		}
		else if($_SESSION['checkoutstep'] == "address"){
			$output =
			'<div class="col-lg-3">
				<div id="delivercircle">
					<h1><i class="fa fa-check-circle green-text" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Order Delivery</p>
			</div>
			<div class="col-lg-3">
				<div id="addresscircle">
					<h1><i class="fa fa-circle blue-text animated flash infinite" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Address</p>
			</div>
			<div class="col-lg-3">
				<div id="ordercircle">
					<h1><i class="fa fa-circle" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Place Order</p>
			</div>';
		}
		else if($_SESSION['checkoutstep'] == "placeorder"){
			$output =
			'<div class="col-lg-3">
				<div id="delivercircle">
					<h1><i class="fa fa-check-circle green-text" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Order Delivery</p>
			</div>
			<div class="col-lg-3">
				<div id="addresscircle">
					<h1><i class="fa fa-check-circle green-text" aria-hidden="true"></i></h1>
				</div>
				
				<p class="h3-responsive">Address</p>
			</div>
			<div class="col-lg-3">
				<div id="ordercircle">
					<h1><i class="fa fa-circle blue-text animated flash infinite" aria-hidden="true"></i></h1>
				</div>				
				<p class="h3-responsive">Place Order</p>
			</div>';
		}
		return $output;
	}

	if($action == "loadcheckout"){
		echo json_encode(currentstep());
	}
	if($action == "delivery_pickup"){
		$_SESSION['checkout_deliver'] = "pickup";
	}
	if($action == "delivery_deliver"){
		$_SESSION['checkout_deliver'] = "deliver";
	}
	if($action == "proceedtolvl2"){
		$_SESSION['checkoutstep'] = "address";
		echo json_encode(currentstep());
	}
	if($action == "backtolvl1"){
		$_SESSION['checkoutstep'] = "delivery";
		echo json_encode(str_replace("fadeInRight", "fadeInLeft", currentstep()));	
	}
	if($action == "loadcircles"){
		echo json_encode(circles());
	}
	if($action == "pick_address"){
		$addid = mysql_escape_string($_POST['addid']);
		$_SESSION['checkout_address'] = $addid;
	}
	if($action == "proceedtolvl3"){
		$_SESSION['checkoutstep'] = "placeorder";
		echo json_encode(currentstep());
	}
	if($action == "proceedtolvl3_anon"){
		$_SESSION['checkoutstep'] = "placeorder";
		$email = mysql_escape_string($_POST['email']);
		$name = mysql_escape_string($_POST['name']);
		$address = mysql_escape_string($_POST['address']);
		$contact = mysql_escape_string($_POST['contact']);
		$obj['email'] = $email;
		$obj['name'] = $name;
		$obj['address'] = $address;
		$obj['contact'] = $contact;
		$_SESSION['checkout_address'] = $obj;
		echo json_encode(currentstep());
	}
	if($action == "backtolvl2"){
		$_SESSION['checkoutstep'] = "address";
		echo json_encode(str_replace("fadeInRight", "fadeInLeft", currentstep()));
	}
	if($action == "ordercomplete"){
		$_SESSION['checkoutstep'] = "ordercomplete";
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$email = $_SESSION['email'];
			$addid = $_SESSION['checkout_address'];
			if($_SESSION['checkout_deliver'] == "pickup"){
				$mode = "PickUp";
			}
			else{
				$mode = "Deliver";
			}
			if($addid == 0){
				$sql = mysql_query("SELECT name, address, contact FROM account WHERE accID = '$accid'");
			}
			else{
				$sql = mysql_query("SELECT * FROM address WHERE addressID = '$addid' AND accID = '$accid'");
			}
			$fetch = mysql_fetch_assoc($sql);
			$name = $fetch['name'];
			$address = $fetch['address'];
			$contact = $fetch['contact'];
			$sql = mysql_query("SELECT MAX(orderID) FROM orders");
			$fetch = mysql_fetch_array($sql);
			$orderid = $fetch[0] + 1;
			$dateorder = date('m-d-Y h:i:sa');
			$sql = mysql_query("SELECT * FROM cart INNER JOIN product ON cart.productID = product.productID WHERE accID = '$accid'");
			while($fetch = mysql_fetch_assoc($sql)){
				$title = $fetch['title'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$price = $fetch['price'];
				$quantity = $fetch['quantity'];
				mysql_query("INSERT INTO orders (orderID, email, name, address, contact, mode, title, image, price, quantity, dateorder, status) VALUES ('$orderid', '$email', '$name', '$address', '$contact', '$mode', '$title', '$image', '$price', '$quantity', '$dateorder', 'PENDING')");
			}
			mysql_query("DELETE FROM cart WHERE accID = '$accid'");
		}
		else{
			$info = $_SESSION['checkout_address'];
			$email = $info['email'];
			$name = $info['name'];
			$address = $info['address'];
			$contact = $info['contact'];
			if($_SESSION['checkout_deliver'] == "pickup"){
				$mode = "PickUp";
			}
			else{
				$mode = "Deliver";
			}
			$sql = mysql_query("SELECT MAX(orderID) FROM orders");
			$fetch = mysql_fetch_array($sql);
			$orderid = $fetch[0] + 1;
			$dateorder = date('m-d-Y h:i:sa');
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			for ($i=0; $i < count($cartprod); $i++) { 
				$id = $cartprod[$i];
				$sql = mysql_query("SELECT title, image, price FROM product WHERE productID = '$id'");
				$fetch = mysql_fetch_assoc($sql);
				$title = $fetch['title'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$price = $fetch['price'];
				$quantity = $cartqty[$i];
				mysql_query("INSERT INTO orders (orderID, email, name, address, contact, mode, title, image, price, quantity, dateorder, status) VALUES ('$orderid', '$email', '$name', '$address', '$contact', '$mode', '$title', '$image', '$price', '$quantity', '$dateorder', 'PENDING')");
			}
			$_SESSION['prod'] = array();
			$_SESSION['qty'] = array();
		}
		unset($_SESSION['checkout_deliver']);
		unset($_SESSION['checkout_address']);
		echo json_encode(currentstep());
	}
?>