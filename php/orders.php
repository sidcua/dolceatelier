<?php  
	session_start();
	include 'connect.php';
	$action = mysql_escape_string($_POST['action']);
	function fetchpending(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'PENDING' GROUP BY orderID ORDER BY orderID DESC");
		if(mysql_num_rows($sql) == 0){
			$output .= 
			'<a class="list-group-item list-group-item-action flex-column align-items-start ">
				<p class="text-center h2-responsive">No Pending Orders</p>
			</a>
			';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$orderid = $fetch['orderID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$dateorder = $fetch['dateorder'];
				$mode = $fetch['mode'];
				$output .= 
				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</h5>
				      <small>'.$dateorder.'</small>
				    </div>
				    <p class="mb-1"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
				    <small><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</small><br>
				    <small><i class="fa fa-truck" aria-hidden="true"></i> '.$mode.'</small>
				    <br>
				    <button data-toggle="collapse" data-target="#collapsepending'.$orderid.'" type="button" class="btn btn-sm btn-primary">View Orders</button>
				    <button onclick="acceptorder('.$orderid.')" type="button" class="btn btn-sm btn-success">Accept Order</button>
				    <button onclick="declineorder('.$orderid.')" type="button" class="btn btn-sm btn-warning">Decline Order</button>
				    <div class="collapse" id="collapsepending'.$orderid.'">
				  	<div class="container">
				  		<table class="table table-responsive">
						  <tbody>';
						  $totalpayment = 0;
						  $sql1 = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
						  while($fetch = mysql_fetch_assoc($sql1)){
						  	$image = $fetch['image'];
						  	$title = $fetch['title'];
						  	$price = $fetch['price'];
						  	$quantity = $fetch['quantity'];
						  	$totalpayment += $quantity * $price;
						  	$output .= 
						  	'<tr>
						      <td align="center"><img src="'.$image.'" style="height: 100; max-width: 100%"></td>
						      <td class="valigncenter">'.$title.'</td>
						      <td class="valigncenter">'.$quantity.'</td>
						      <td class="valigncenter">'.$price.'</td>
						    </tr>';
						  }
						  $output .= 
						  '<tr>
						      <td class="valigncenter" colspan="3">
							      <div class="d-flex justify-content-end h3-responsive">
							      	Total Payment: &nbsp;'.$totalpayment.'
							      </div>
						  	  </td>
						  	  <td></td>
						    </tr>
						  </tbody>
						</table>
				  	</div>
				    
				  </div>
				  </a> ';
			}
		}
		
		return $output;
	}
	function fetchaccept(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'PROCESSING' GROUP BY orderID ORDER BY orderID DESC");
		if(mysql_num_rows($sql) == 0){
			$output .= 
			'<a class="list-group-item list-group-item-action flex-column align-items-start ">
				<p class="text-center h2-responsive">No Accepted Orders</p>
			</a>
			';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$orderid = $fetch['orderID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$dateorder = $fetch['dateorder'];
				$mode = $fetch['mode'];
				$output .= 
				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</h5>
				      <small>'.$dateorder.'</small>
				    </div>
				    <p class="mb-1"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
				    <small><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</small><br>
				    <small><i class="fa fa-truck" aria-hidden="true"></i> '.$mode.'</small>
				    <br>
				    <button data-toggle="collapse" data-target="#collapseaccept'.$orderid.'" type="button" class="btn btn-sm btn-primary">View Orders</button>
				    <button onclick="finishorder('.$orderid.')" type="button" class="btn btn-sm btn-warning">Finish Order</button>
				    <div class="collapse" id="collapseaccept'.$orderid.'">
				  	<div class="container">
				  		<table class="table table-responsive">
						  <tbody>';
						  $totalpayment = 0;
						  $sql1 = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
						  while($fetch = mysql_fetch_assoc($sql1)){
						  	$image = $fetch['image'];
						  	$title = $fetch['title'];
						  	$price = $fetch['price'];
						  	$quantity = $fetch['quantity'];
						  	$totalpayment += $quantity * $price;
						  	$output .= 
						  	'<tr>
						      <td align="center"><img src="'.$image.'" style="height: 100; max-width: 100%"></td>
						      <td class="valigncenter">'.$title.'</td>
						      <td class="valigncenter">'.$quantity.'</td>
						      <td class="valigncenter">'.$price.'</td>
						    </tr>';
						  }
						  $output .= 
						  '<tr>
						      <td class="valigncenter" colspan="3">
							      <div class="d-flex justify-content-end h3-responsive">
							      	Total Payment: &nbsp;'.$totalpayment.'
							      </div>
						  	  </td>
						  	  <td></td>
						    </tr>
						  </tbody>
						</table>
				  	</div>
				    
				  </div>
				  </a> ';
			}
		}
		
		return $output;
	}
	function fetchfinish(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'FINISH' GROUP BY orderID ORDER BY orderID DESC");
		if(mysql_num_rows($sql) == 0){
			$output .= 
			'<a class="list-group-item list-group-item-action flex-column align-items-start ">
				<p class="text-center h2-responsive">No Finished Orders</p>
			</a>
			';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$orderid = $fetch['orderID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$dateorder = $fetch['dateorder'];
				$mode = $fetch['mode'];
				$output .= 
				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</h5>
				      <small>'.$dateorder.'</small>
				    </div>
				    <p class="mb-1"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
				    <small><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</small><br>
				    <small><i class="fa fa-truck" aria-hidden="true"></i> '.$mode.'</small>
				    <br>
				    <button data-toggle="collapse" data-target="#collapsefinish'.$orderid.'" type="button" class="btn btn-sm btn-primary">View Orders</button>
				    <button onclick="completeorder('.$orderid.')" type="button" class="btn btn-sm btn-success">Complete Order</button>
				    <div class="collapse" id="collapsefinish'.$orderid.'">
				  	<div class="container">
				  		<table class="table table-responsive">
						  <tbody>';
						  $totalpayment = 0;
						  $sql1 = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
						  while($fetch = mysql_fetch_assoc($sql1)){
						  	$image = $fetch['image'];
						  	$title = $fetch['title'];
						  	$price = $fetch['price'];
						  	$quantity = $fetch['quantity'];
						  	$totalpayment += $quantity * $price;
						  	$output .= 
						  	'<tr>
						      <td align="center"><img src="'.$image.'" style="height: 100; max-width: 100%"></td>
						      <td class="valigncenter">'.$title.'</td>
						      <td class="valigncenter">'.$quantity.'</td>
						      <td class="valigncenter">'.$price.'</td>
						    </tr>';
						  }
						  $output .= 
						  '<tr>
						      <td class="valigncenter" colspan="3">
							      <div class="d-flex justify-content-end h3-responsive">
							      	Total Payment: &nbsp;'.$totalpayment.'
							      </div>
						  	  </td>
						  	  <td></td>
						    </tr>
						  </tbody>
						</table>
				  	</div>
				    
				  </div>
				  </a> ';
			}
		}
		
		return $output;
	}
	function pendingrows(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'PENDING' GROUP BY orderID");
		if(mysql_num_rows($sql) >= 3){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	function acceptrows(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'PROCESSING' GROUP BY orderID");
		if(mysql_num_rows($sql) >= 3){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	function finishrows(){
		$sql = mysql_query("SELECT * FROM orders WHERE status = 'FINISH' GROUP BY orderID");
		if(mysql_num_rows($sql) >= 3){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	if($action == "showpending"){
		$obj['addclass'] = pendingrows();
		$obj['data'] = fetchpending();
		echo json_encode($obj);
	}
	if($action == "acceptorder"){
		$orderid = mysql_escape_string($_POST['orderid']);
		mysql_query("UPDATE orders SET status = 'PROCESSING' WHERE orderID = '$orderid'");
		$obj['addclass'] = pendingrows();
		$obj['data'] = fetchpending();
		$obj['addclass2'] = acceptrows();
		$obj['data2'] = fetchaccept();
		echo json_encode($obj);
	}
	if($action == "declineorder"){
		$orderid = mysql_escape_string($_POST['orderid']);
		$sql = mysql_query("SELECT MAX(orderID) FROM history");
		$fetch = mysql_fetch_array($sql);
		$orderidforhist = $fetch[0] + 1;
		$sql = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
		while($fetch = mysql_fetch_assoc($sql)){
			$email = $fetch['email'];
			$name = $fetch['name'];
			$address = $fetch['address'];
			$contact = $fetch['contact'];
			$mode = $fetch['mode'];
			$title = $fetch['title'];
			$image = $fetch['image'];
			$price = $fetch['price'];
			$quantity = $fetch['quantity'];
			$dateorder = $fetch['dateorder'];
			mysql_query("INSERT INTO history (orderID, email, name, address, contact, mode, title, image, price, quantity, dateorder, status) VALUES ('$orderidforhist', '$email', '$name', '$address', '$contact', '$mode', '$title', '$image', '$price', '$quantity', '$dateorder', 'DECLINE')");
		}
		mysql_query("DELETE FROM orders WHERE orderID = '$orderid'");
		$obj['addclass'] = pendingrows();
		$obj['data'] = fetchpending();
		echo json_encode($obj);
	}
	if($action == "showaccept"){
		$obj['addclass'] = acceptrows();
		$obj['data'] = fetchaccept();
		echo json_encode($obj);
	}
	if($action == "finishorder"){
		$orderid = mysql_escape_string($_POST['orderid']);
		mysql_query("UPDATE orders SET status = 'FINISH' WHERE orderID = '$orderid'");
		$obj['addclass'] = acceptrows();
		$obj['data'] = fetchaccept();
		$obj['addclass2'] = finishrows();
		$obj['data2'] = fetchfinish();
		echo json_encode($obj);
	}
	if($action == "showfinish"){
		$obj['addclass'] = finishrows();
		$obj['data'] = fetchfinish();
		echo json_encode($obj);
	}
	if($action == "completeorder"){
		$orderid = mysql_escape_string($_POST['orderid']);
		$sql = mysql_query("SELECT MAX(orderID) FROM history");
		$fetch = mysql_fetch_array($sql);
		$orderidforhist = $fetch[0] + 1;
		$sql = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
		while($fetch = mysql_fetch_assoc($sql)){
			$email = $fetch['email'];
			$name = $fetch['name'];
			$address = $fetch['address'];
			$contact = $fetch['contact'];
			$mode = $fetch['mode'];
			$title = $fetch['title'];
			$image = $fetch['image'];
			$price = $fetch['price'];
			$quantity = $fetch['quantity'];
			$dateorder = $fetch['dateorder'];
			mysql_query("INSERT INTO history (orderID, email, name, address, contact, mode, title, image, price, quantity, dateorder, status) VALUES ('$orderidforhist', '$email', '$name', '$address', '$contact', '$mode', '$title', '$image', '$price', '$quantity', '$dateorder', 'DONE')");
		}
		mysql_query("DELETE FROM orders WHERE orderID = '$orderid'");
		$obj['addclass'] = finishrows();
		$obj['data'] = fetchfinish();
		echo json_encode($obj);
	}
	function fetchorders_account(){
		$email = $_SESSION['email'];
		$sql = mysql_query("SELECT * FROM orders WHERE email = '$email' GROUP BY orderID ORDER BY orderID DESC");
		if(mysql_num_rows($sql) == 0){
			// $output .= 
			// '<a class="list-group-item list-group-item-action flex-column align-items-start ">
			// 	<p class="text-center h2-responsive">No Orders</p>
			// </a>
			// ';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$orderid = $fetch['orderID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$dateorder = $fetch['dateorder'];
				$mode = $fetch['mode'];
				if($fetch['status'] == "PENDING"){
					$status = "Pending";
				}
				else if($fetch['status'] == "PROCESSING"){
					$status = "Processing";
				}
				else if($fetch['status'] == "FINISH"){
					$status = "Finish";
				}
				$output .= 
				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</h5>
				      <small>'.$dateorder.'</small>
				    </div>
				    <p class="mb-1"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
				    <small><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</small><br>
				    <small><i class="fa fa-truck" aria-hidden="true"></i> '.$mode.'</small><br>
				    <p class="mb-1 ';
				    if($status == "Pending"){
				    	$output .= 'blue-text';
				    }
				    else if($status == "Processing"){
				    	$output .= 'orange-text';
				    }
				    else if($status == "Finish"){
				    	$output .= 'green-text';
				    }
				    $output .= '"><i class="fa fa-paper-plane" aria-hidden="true"></i> '.$status.'</p>
				    <br>
				    <button data-toggle="collapse" data-target="#collapsepending'.$orderid.'" type="button" class="btn btn-sm btn-primary">View Orders</button>';
				    if($status == "Pending"){
				    	$output .= '<button onclick="chooseorder('.$orderid.')" data-toggle="modal" data-target="#cancelordermodal" type="button" class="btn btn-sm btn-danger">Cancel Order</button>';
				    }
				    
				    $output .= '<div class="collapse" id="collapsepending'.$orderid.'">
				  	<div class="container">
				  		<table class="table table-responsive">
						  <tbody>';
						  $totalpayment = 0;
						  $sql1 = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
						  while($fetch = mysql_fetch_assoc($sql1)){
						  	$image = $fetch['image'];
						  	$title = $fetch['title'];
						  	$price = $fetch['price'];
						  	$quantity = $fetch['quantity'];
						  	$totalpayment += $quantity * $price;
						  	$output .= 
						  	'<tr>
						      <td align="center"><img src="'.$image.'" style="height: 100; max-width: 100%"></td>
						      <td class="valigncenter">'.$title.'</td>
						      <td class="valigncenter">'.$quantity.'</td>
						      <td class="valigncenter">'.$price.'</td>
						    </tr>';
						  }
						  $output .= 
						  '<tr>
						      <td class="valigncenter" colspan="3">
							      <div class="d-flex justify-content-end h3-responsive">
							      	Total Payment: &nbsp;'.$totalpayment.'
							      </div>
						  	  </td>
						  	  <td></td>
						    </tr>
						  </tbody>
						</table>
				  	</div>
				    
				  </div>
				  </a> ';
			}
		}
		$sql2 = mysql_query("SELECT * FROM history WHERE email = '$email' GROUP BY orderID ORDER BY orderID DESC");
		if(mysql_num_rows($sql) == 0 && mysql_num_rows($sql2) == 0){
			$output = 
			'<a class="list-group-item list-group-item-action flex-column align-items-start ">
				<p class="text-center h2-responsive">No Orders</p>
			</a>
			';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql2)){
				$orderid = $fetch['orderID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$dateorder = $fetch['dateorder'];
				$mode = $fetch['mode'];
				$status = $fetch['status'];
				if($fetch['status'] == "DONE"){
					$status = "Done";
				}
				else if($fetch['status'] == "CANCEL"){
					$status = "Cancelled";
				}
				else if($fetch['status'] == "DECLINE"){
					$status = "Declined";
				}
				$output .= 
				'<a class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1"><i class="fa fa-user" aria-hidden="true"></i> '.$name.'</h5>
				      <small>'.$dateorder.'</small>
				    </div>
				    <p class="mb-1"><i class="fa fa-map" aria-hidden="true"></i> '.$address.'</p>
				    <small><i class="fa fa-phone" aria-hidden="true"></i> '.$contact.'</small><br>
				    <small><i class="fa fa-truck" aria-hidden="true"></i> '.$mode.'</small><br>
				    <p class="mb-1 ';
				    if($status == 'Done'){
				    	$output .= 'lime-text';
				    }
				    else if($status == 'Cancelled'){
				    	$output .= 'red-text';
				    }
				    else if($status == 'Declined'){
				    	$output .= 'yellow-text';
				    }
				    $output .= '"><i class="fa fa-paper-plane" aria-hidden="true"></i> '.$status.'</p>
				    <br>
				    <button data-toggle="collapse" data-target="#collapsepending'.$orderid.'" type="button" class="btn btn-sm btn-primary">View Orders</button>
				    <div class="collapse" id="collapsepending'.$orderid.'">
				  	<div class="container">
				  		<table class="table table-responsive">
						  <tbody>';
						  $totalpayment = 0;
						  $sql3 = mysql_query("SELECT * FROM history WHERE email = '$email' AND dateorder = '$dateorder'");
						  while($fetch = mysql_fetch_assoc($sql3)){
						  	$image = $fetch['image'];
						  	$title = $fetch['title'];
						  	$price = $fetch['price'];
						  	$quantity = $fetch['quantity'];
						  	$totalpayment += $quantity * $price;
						  	$output .= 
						  	'<tr>
						      <td align="center"><img src="'.$image.'" style="height: 100; max-width: 100%"></td>
						      <td class="valigncenter">'.$title.'</td>
						      <td class="valigncenter">'.$quantity.'</td>
						      <td class="valigncenter">'.$price.'</td>
						    </tr>';
						  }
						  $output .= 
						  '<tr>
						      <td class="valigncenter" colspan="3">
							      <div class="d-flex justify-content-end h3-responsive">
							      	Total Payment: &nbsp;'.$totalpayment.'
							      </div>
						  	  </td>
						  	  <td></td>
						    </tr>
						  </tbody>
						</table>
				  	</div>
				    
				  </div>
				  </a> ';
			}
		}
		return $output;
	}
	if($action == "showorders"){
		echo json_encode(fetchorders_account());	
	}
	if($action == "cancelorder"){
		$orderid = mysql_escape_string($_POST['orderid']);
		$sql = mysql_query("SELECT MAX(orderID) FROM history");
		$fetch = mysql_fetch_array($sql);
		$orderidforhist = $fetch[0] + 1;
		$sql = mysql_query("SELECT * FROM orders WHERE orderID = '$orderid'");
		while($fetch = mysql_fetch_assoc($sql)){
			$email = $fetch['email'];
			$name = $fetch['name'];
			$address = $fetch['address'];
			$contact = $fetch['contact'];
			$mode = $fetch['mode'];
			$title = $fetch['title'];
			$image = $fetch['image'];
			$price = $fetch['price'];
			$quantity = $fetch['quantity'];
			$dateorder = $fetch['dateorder'];
			mysql_query("INSERT INTO history (orderID, email, name, address, contact, mode, title, image, price, quantity, dateorder, status) VALUES ('$orderidforhist', '$email', '$name', '$address', '$contact', '$mode', '$title', '$image', '$price', '$quantity', '$dateorder', 'CANCEL')");
		}
		mysql_query("DELETE FROM orders WHERE orderID = '$orderid'");
		echo json_encode(fetchorders_account());
	}
?>