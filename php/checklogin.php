<?php  
	session_start();
	include 'connect.php';

	$action = $_POST['action'];
	$email = mysql_escape_string($_POST['email']);
	$password = mysql_escape_string($_POST['password']);
	$sql = mysql_query("SELECT * FROM account WHERE email = '$email' AND password = '$password'");
	if (mysql_num_rows($sql) > 0) {
		$user = mysql_fetch_array($sql);
		$_SESSION['accID'] = $user[0];
		$_SESSION['email'] = $user[1];
		$_SESSION['name'] = $user[3];
		$_SESSION['contact'] = $user[4];
		$_SESSION['address'] = $user[5];
		$_SESSION['position'] = $user[6];
		$_SESSION['name_on_nav'] = str_word_count($user[3], 1)[0];
		$cartprod = $_SESSION['prod'];
		$cartqty = $_SESSION['qty'];
		if(count($cartprod) != 0){
			$accid = $_SESSION['accID'];
			$sql = mysql_query("SELECT * FROM cart WHERE accID = '$accid'");
			for ($i=0; $i < count($cartprod); $i++) { 
				while($fetch = mysql_fetch_assoc($sql)){
					$prodid = $fetch['productID'];
					if($prodid == $cartprod[$i]){
						$quantity = $fetch['quantity'] + $cartqty[$i];
						mysql_query("UPDATE cart SET quantity = '$quantity' WHERE productID = '$prodid'");
						unset($cartprod[$i]);
						unset($cartqty[$i]);
					}
				}
			}
			if(count($cartprod) != 0){
				for ($i=0; $i < count($cartprod); $i++) { 
					$prodid = $cartprod[$i];
					$quantity = $cartqty[$i];
					mysql_query("INSERT INTO cart (accID, productID, quantity) VALUES ('$accid', '$prodid', '$quantity')");
				}
			}
			$_SESSION['prod'] = array();
			$_SESSION['qty'] = array();
		}
		echo json_encode(true);
	}
	else{
		echo json_encode(false);
	}
	
?>