<?php  
	session_start();
	include 'connect.php';
	function totalpayment(){
		$cartprod = $_SESSION['prod'];
		$cartqty = $_SESSION['qty'];
		$totalpayment = 0;
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity, price FROM product INNER JOIN cart ON product.productID = cart.productID WHERE accID = '$accid'");
			while($fetch = mysql_fetch_assoc($sql)){
				$quantity = $fetch['quantity'];
				$price = $fetch['price'];
				$x = 1;
				while($x <= $quantity){
					$totalpayment += $price;
					$x++;
				}
			}
		}
		else{
			for ($i=0; $i < count($cartprod); $i++) { 
				$prodid = $cartprod[$i];
				$sql = mysql_query("SELECT price FROM product WHERE productID = '$prodid'");
				$fetch = mysql_fetch_assoc($sql);
				$price = $fetch['price'];
				$totalpayment += $price * $cartqty[$i];
			}
		}
		if($totalpayment == 0){
			$output .=
			'<div class="text-center">
				<p class="mb-0 h3-responsive">Dont Sweat it..</p>
				<a href="products.php" class="btn btn-info waves-effect">Order Now</a>		     
			</div>';
		}
		else{
			$output .= 
			'<div class="text-center">
		            <div class="card-body">
		                <p class="mb-0 h4-responsive">Total Payment</p>
		            </div>
		        </div>
		        <br>
		        <p id="totalpayment_cart" class="mb-0 h5 text-center animated">&#8369;<span id="totalpym">'.$totalpayment.'</span></p> 
		        <br>
		        <a id="btnchekout" href="checkout.php" class="btn btn-success waves-effect" style="width: 100%">Proceed to Checkout</a>
			</div>';
		}
		return $output;
	}
	function cartitemlist(){
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT * FROM cart INNER JOIN product ON product.productID = cart.productID WHERE accID = '$accid'");
			if(mysql_num_rows($sql) == 0){
				$output .= 
					'<div class="row">
						<div class="col-lg-3"></div>
						<div class="col-lg-6 text-center">
							<h1><center><i class="fa fa-shopping-cart prefix" aria-hidden="true"></i> No Items</center></h1>
						</div>
						<div class="col-lg-3"></div>
						
					</div>';
			}
			else{
				$output .=
				'<table class="table table-responsive">
				  <thead>
				    <tr>
				      <th width="20%"></th>
				      <th width="30%">Item</th>
				      <th width="20%">Quantity</th>
				      <th width="20%">Price</th>
				      <th width="5%"></th>
				    </tr>
				  </thead>
				  <tbody>';
				while($fetch = mysql_fetch_assoc($sql)){
					$prodid = $fetch['productID'];
					$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
					$title = $fetch['title'];
					$price = $fetch['price'];
					$quantity = $fetch['quantity'];
					$x = 1;
					$total = 0;
					while($x <= $quantity){
						$total += $price;
						$x++;
					}
					$output .=
					'<tr id="item'.$prodid.'">
				      <td><img src="'.$image.'" style="height: 120px; width: 100%"></td>
				      <td class="valigncenter">'.$title.'</td>
				      <td class="valigncenter">
				      	<div class="d-flex flex-column">
				      		<div class="">
				      			<input id="txtquantity'.$prodid.'" type="text" onKeyDown="if(event.keyCode == 13) changequantity('.$prodid.', this.value);" class="input-alternate text-center d-flex " value="'.$quantity.'" style="width: 30px;">
				      		</div>
				      		<div class="btn-group btn-group-sm" role="group">
				      			<button id="minus'.$prodid.'" onclick="decreaseitem('.$prodid.')" type="button" class="btn btn-secondary"><i class="fa fa-minus" aria-hidden="true"></i></button>
				      			<button id="plus'.$prodid.'" onclick="increaseitem('.$prodid.')" type="button" class="btn btn-secondary"><i class="fa fa-plus" aria-hidden="true"></i></button>
				      		</div>
				      	</div>
				      	
				      </td>
				      <td class="valigncenter">&#8369;'.$price.'</td>
				      <td><button onclick="removeitem('.$prodid.')" type="button" class="close float-right" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button></td>
				    </tr>';
				}
			}
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			if(count($cartprod) == 0){
				$output .= 
					'<div class="row">
						<div class="col-lg-3"></div>
						<div class="col-lg-6 text-center">
							<h1><center><i class="fa fa-shopping-cart prefix" aria-hidden="true"></i> No Items</center></h1>
						</div>
						<div class="col-lg-3"></div>
						
					</div>';
			}
			else{
				$output .=
				'<table class="table table-responsive">
				  <thead>
				    <tr>
				      <th width="20%"></th>
				      <th width="30%">Item</th>
				      <th width="20%">Quantity</th>
				      <th width="20%">Price</th>
				      <th width="5%"></th>
				    </tr>
				  </thead>
				  <tbody>';
				for ($i=0; $i < count($cartprod); $i++) { 
					$prodid = $cartprod[$i];
					$sql = mysql_query("SELECT * FROM product WHERE productID = '$prodid'");
					$fetch = mysql_fetch_assoc($sql);
					$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
					$title = $fetch['title'];
					$price = $fetch['price'];
					$quantity = $cartqty[$i];
					$total = $price * $quantity;
					$output .=
					'<tr id="item'.$prodid.'">
				      <td><img src="'.$image.'" style="height: 120px; width: 100%"></td>
				      <td class="valigncenter">'.$title.'</td>
				      <td class="valigncenter">
				      	<div class="d-flex flex-column">
				      		<div class="">
				      			<input id="txtquantity'.$prodid.'" type="text" onKeyDown="if(event.keyCode == 13) changequantity('.$prodid.', this.value);" class="input-alternate text-center d-flex " value="'.$quantity.'" style="width: 30px;">
				      		</div>
				      		<div class="btn-group btn-group-sm" role="group">
				      			<button id="minus'.$prodid.'" onclick="decreaseitem('.$prodid.')" type="button" class="btn btn-secondary"><i class="fa fa-minus" aria-hidden="true"></i></button>
				      			<button id="plus'.$prodid.'" onclick="increaseitem('.$prodid.')" type="button" class="btn btn-secondary"><i class="fa fa-plus" aria-hidden="true"></i></button>
				      		</div>
				      	</div>
				      	
				      </td>
				      <td class="valigncenter">&#8369;'.$price.'</td>
				      <td><button onclick="removeitem('.$prodid.')" type="button" class="close float-right" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button></td>
				    </tr>';
				}
			}
		}
		$output .=
		'</tbody>
		</table>';
		return $output;
	}

	$action = $_POST['action'];
	if($action == "additem"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){	
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT * FROM cart WHERE productID = '$prodid' AND accID = '$accid'");
			if(mysql_num_rows($sql) > 0){
				$fetch = mysql_fetch_assoc($sql);
				$quantity = $fetch['quantity'];
				$quantity++;
				mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid'");
			}
			else{
				mysql_query("INSERT INTO cart (accID, productID, quantity) VALUES('$accid', '$prodid', 1)");	
			}
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			if(in_array($prodid, $cartprod)){
				$index = array_search($prodid, $cartprod);
				$cartqty[$index] += 1;
			}
			else{
				array_push($cartprod, $prodid);
				array_push($cartqty, 1);
			}
			$_SESSION['prod'] = $cartprod;
			$_SESSION['qty'] = $cartqty;
		}
	}

	if($action == "showcartitem"){
		$output = '';
		$obj['showpayment'] = true;
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT cart.productID, title, quantity FROM product INNER JOIN cart ON product.productID = cart.productID WHERE accID = '$accid'");
			if(mysql_num_rows($sql) == 0){
				$output .= '<div class="divspace"></div>';
				$output .= '<h1 align="center">Your cart is empty</h1>';
				$output .= '<div class="divspace"></div>';
				$output .= '<div class="container">
								<div class="row">
									<div class="col-lg-3"></div>
									<div class="col-lg-6">
										<a class="btn btn-info" href="products.php">Order now</a>
									</div>
									<div class="col-lg-3"></div>
								</div>
							</div>';
				$obj['showpayment'] = false;
			}
			else{
				while($fetch = mysql_fetch_assoc($sql)){
					$prodid = $fetch['productID'];
					$title = $fetch['title'];
					$quantity = $fetch['quantity'];
					$plusbtn = "'plus".$prodid."'";
					$minusbtn = "'minus".$prodid."'";
			        $output .= 
			                '<div class="list-group-item flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <h6 class="mb-1">'.$title.'</h6>
							      <small class="text-muted"><span id="itemcount'.$prodid.'" class="badge badge-primary badge-pill float-right">'.$quantity.'</span></small>
							    </div>
							    <div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic example">
								  <button type="button" id="minus'.$prodid.'" onclick="decrementitem('.$prodid.', '.$minusbtn.')" class="btn btn-info"><i class="fa fa-minus" aria-hidden="true"></i></button>
								  <button type="button" id="plus'.$prodid.'" onclick="incrementitem('.$prodid.', '.$plusbtn.')" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i></button>
								</div>
							  </div>';
				}
			}
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			if(count($cartprod) == 0){
				$output .= '<div class="divspace"></div>';
				$output .= '<h1 align="center">Your cart is empty</h1>';
				$output .= '<div class="divspace"></div>';
				$output .= '<div class="container">
								<div class="row">
									<div class="col-lg-3"></div>
									<div class="col-lg-6">
										<a class="btn btn-info" href="products.php">Order now</a>
									</div>
									<div class="col-lg-3"></div>
								</div>
							</div>';
				$obj['showpayment'] = false;
			}
			else{
				for ($i=0; $i < count($cartprod); $i++) { 
					$prodid = $cartprod[$i];
					$sql = mysql_query("SELECT * FROM product WHERE productID = '$prodid'");
					$fetch = mysql_fetch_assoc($sql);
					$prodid = $fetch['productID'];
					$title = $fetch['title'];
					$quantity = $cartqty[$i];
					$plusbtn = "'plus".$prodid."'";
					$minusbtn = "'minus".$prodid."'";
					$output .= 
			                '<div class="list-group-item flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <h6 class="mb-1">'.$title.'</h6>
							      <small class="text-muted"><span id="itemcount'.$prodid.'" class="badge badge-primary badge-pill float-right">'.$quantity.'</span></small>
							    </div>
							    <div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic example">
								  <button type="button" id="minus'.$prodid.'" onclick="decrementitem('.$prodid.', '.$minusbtn.')" class="btn btn-info"><i class="fa fa-minus" aria-hidden="true"></i></button>
								  <button type="button" id="plus'.$prodid.'" onclick="incrementitem('.$prodid.', '.$plusbtn.')" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i></button>
								</div>
							  </div>';
				}
			}
		}
		$obj['output'] = $output;
		$obj['totalpayment'] = totalpayment();
		echo json_encode($obj);
	}

	if($action == "itembadge"){
		$quantity = 0;
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity FROM cart WHERE accID = '$accid'");
			if(mysql_num_rows($sql) == 0){
				$quantity = 0;
			}
			else{
				while($fetch = mysql_fetch_assoc($sql)){
					$quantity += $fetch['quantity'];
				}
			}
		}
		else{
			$cartqty = $_SESSION['qty'];
			for ($i=0; $i < count($cartqty) ; $i++) { 
				$quantity += $cartqty[$i];
			}
		}
		echo json_encode($quantity);
	}
	if($action == "incrementitem"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity FROM cart WHERE productID = '$prodid' AND accID = '$accid'");
			$fetch = mysql_fetch_assoc($sql);
			$quantity = $fetch['quantity'] + 1;
			mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid'");
		}
		else{
			$cartqty = $_SESSION['qty'];
			$cartprod = $_SESSION['prod'];
			$index = array_search($prodid, $cartprod);
			$cartqty[$index] += 1;
			$quantity = $cartqty[$index];
			$_SESSION['prod'] = $cartprod;
			$_SESSION['qty'] = $cartqty;
		}
		echo json_encode($quantity);
	}
	if($action == "decrementitem"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity FROM cart WHERE productID = '$prodid' AND accID = '$accid'");
			$fetch = mysql_fetch_assoc($sql);
			if($fetch['quantity'] < 2){
				$obj['quantity'] = $fetch['quantity'];
				$obj['status'] = false;
			}
			else{
				$quantity = $fetch['quantity'] - 1;
				mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid'");
				$obj['quantity'] = $quantity;
				$obj['status'] = true;
			}
		}
		else{
			$cartqty = $_SESSION['qty'];
			$cartprod = $_SESSION['prod'];
			$index = array_search($prodid, $cartprod);
			if($cartqty[$index] < 2){
				$obj['quantity'] = $cartqty[$index];
				$obj['status'] = false;
			}
			else{
				$cartqty[$index] -= 1;
				$obj['quantity'] = $cartqty[$index];
				$obj['status'] = true;
				$_SESSION['prod'] = $cartprod;
				$_SESSION['qty'] = $cartqty;
			}
		}
		echo json_encode($obj);
	}
	if($action == "totalpayment"){
		echo json_encode(totalpayment());
	}
	if($action == "totalpayment_text"){
		$totalpayment = 0;
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity, price FROM product INNER JOIN cart ON product.productID = cart.productID WHERE accID = '$accid'");
			while($fetch = mysql_fetch_assoc($sql)){
				$quantity = $fetch['quantity'];
				$price = $fetch['price'];
				$x = 1;
				while($x <= $quantity){
					$totalpayment += $price;
					$x++;
				}
			}
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			for ($i=0; $i < count($cartprod); $i++) { 
				$prodid = $cartprod[$i];
				$sql = mysql_query("SELECT price FROM product WHERE productID = '$prodid'");
				$fetch = mysql_fetch_assoc($sql);
				$totalpayment += $fetch['price'] * $cartqty[$i];
			}
		}
		echo json_encode($totalpayment);
	}
	if($action == "cartitems"){
		echo json_encode(cartitemlist());
	}
	if($action == "removeitem"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			mysql_query("DELETE FROM cart WHERE accID = '$accid' AND productID = '$prodid'");
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			$x = array_search($prodid, $cartprod);
			unset($cartprod[$x]);
			unset($cartqty[$x]);
			$cartprod = array_values($cartprod);
			$cartqty = array_values($cartqty);
			$_SESSION['prod'] = $cartprod;
			$_SESSION['qty'] = $cartqty;
		}
	}
	if($action  == "increaseitem_cart"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity FROM cart WHERE productID = '$prodid' AND accID = '$accid'");
			$fetch = mysql_fetch_assoc($sql);
			if($fetch['quantity'] >= 50){
				echo json_encode(false);
			}
			else{
				$quantity = $fetch['quantity'] + 1;
				mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid' AND accID = '$accid'");
				echo json_encode($quantity);
			}
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			$index = array_search($prodid, $cartprod);
			if($cartqty[$index] >= 50){
				echo json_encode(false);
			}
			else{
				$cartqty[$index] += 1;
				$quantity = $cartqty[$index];
				$_SESSION['qty'] = $cartqty;
				echo json_encode($quantity);
			}
		}
		
	}
	if($action  == "decreaseitem_cart"){
		$prodid = mysql_escape_string($_POST['prodid']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT quantity FROM cart WHERE productID = '$prodid' AND accID = '$accid'");
			$fetch = mysql_fetch_assoc($sql);
			$quantity = $fetch['quantity'] - 1;
			mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid' AND accID = '$accid'");
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			$index = array_search($prodid, $cartprod);
			$cartqty[$index] -= 1;
			$quantity = $cartqty[$index];
			$_SESSION['qty'] = $cartqty;
		}
		echo json_encode($quantity);

	}
	if($action  == "changequantity_cart"){
		$prodid = mysql_escape_string($_POST['prodid']);
		$quantity = mysql_escape_string($_POST['quantity']);
		if($_SESSION['accID'] != ""){
			$accid = $_SESSION['accID'];
			mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid' AND accID = '$accid'");
		}
		else{
			$cartprod = $_SESSION['prod'];
			$cartqty = $_SESSION['qty'];
			$index = array_search($prodid, $cartprod);
			$cartqty[$index] = $quantity;
			$_SESSION['qty'] = $cartqty;
		}
		echo json_encode($quantity);
	}
	if($action == "itembadge_anon"){
		$cartqty = $_SESSION['qty'];
		$quantity = 0;
		for ($i=0; $i < count($cartqty); $i++) { 
			$quantity += $cartqty[$i];
		}
		echo json_encode($quantity);
	}
?>