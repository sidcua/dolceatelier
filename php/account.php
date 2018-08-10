<?php 
	session_start();
	include 'connect.php';


	$action = $_POST['action'];
	function fetchdata($acctype){
		$output = '';
		if($acctype == "walkin"){
			$sql = mysql_query("SELECT * FROM account WHERE position = 'Walk-In'");
                    if(mysql_num_rows($sql) == 0){
                    	$output .=
                        "<tr>
                            <td colspan='5'><h1><center>No Accounts Found</center></h1></td>
                        </tr>";
                    }
                    while($fetch = mysql_fetch_assoc($sql)) {
                        $accID = $fetch['accID'];
                        $email = $fetch['email'];
                        $name = $fetch['name'];
                        $contact = $fetch['contact'];
                        $address = $fetch['address'];
                        $active = $fetch['active'];
                        $output .= "<tr id='acc' data-id='$accID'>
                                <td class='accID' hidden></td>
                                <td>$email</td>
                                <td>$name</td>
                                <td>$contact</td>
                                <td>$address</td>
                                <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-info waves-effect' data-toggle='modal' data-target='#addadminmodal'><i class='fa fa-plus-circle' aria-hidden='true'></i> Add as an Admin</button>";

                                if($active == 1){
                                    $output .= "<button type='button' class='btn btn-sm btn-warning waves-effect' data-toggle='modal' data-target='#deactivateaccmodal'><i class='fa fa-ban' aria-hidden='true'></i> Deactivate</button>";    
                                }
                                else{
                                $output .= "<button type='button' class='btn btn-sm btn-success waves-effect' data-toggle='modal' data-target='#activateaccmodal'><i class='fa fa-dot-circle-o' aria-hidden='true'></i> Activate</button>";   

                                }
                                


                        $output .= "<button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deleteaccmodal'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></td>
                            </tr>";
                    }
		}
		else if($acctype == "admin"){
			$sql = mysql_query("SELECT * FROM account WHERE position = 'Sub-Admin'");
                    if(mysql_num_rows($sql) == 0){
                    	$output .=
                        '<tr>
                            <td colspan="5"><h1><center>No Accounts Found</center></h1></td>
                        </tr>';
                    }
                    while($fetch = mysql_fetch_assoc($sql)) {
                        $accID = $fetch['accID'];
                        $email = $fetch['email'];
                        $name = $fetch['name'];
                        $contact = $fetch['contact'];
                        $address = $fetch['address'];
                        $active = $fetch['active'];
                        $output .= "<tr id='acc' data-id='$accID'>
                                <td class='accID' hidden></td>
                                <td>$email</td>
                                <td>$name</td>
                                <td>$contact</td>
                                <td>$address</td>
                                <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-default waves-effect' data-toggle='modal' data-target='#removeadmin'><i class='fa fa-remove' aria-hidden='true'></i> Remove Admin</button>";

                                if($active == 1){
                                    $output .= "<button type='button' class='btn btn-sm btn-warning waves-effect' data-toggle='modal' data-target='#deactivateaccmodal'><i class='fa fa-ban' aria-hidden='true'></i> Deactivate</button>";    
                                }
                                else{
                                $output .= "<button type='button' class='btn btn-sm btn-success waves-effect' data-toggle='modal' data-target='#activateaccmodal'><i class='fa fa-dot-circle-o' aria-hidden='true'></i> Activate</button>";   

                                }
                                


                        $output .= "<button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deleteaccmodal'><i class='fa fa-trash' aria-hidden='true'></i>Delete</button></td>
                            </tr>";
                 }
		}
		return $output;
	}
	if($action == "add"){
		$email = mysql_escape_string($_POST['email']);
		$password = mysql_escape_string($_POST['password']);
		$name = mysql_escape_string($_POST['name']);
		$contact = mysql_escape_string($_POST['contact']);
		$address = mysql_escape_string($_POST['address']);
		$hash = mysql_escape_string(md5(rand(0,1000)));
		$sql = mysql_query("SELECT * FROM account WHERE email = '$email'");
		if (mysql_num_rows($sql) > 0) {
			echo json_encode(false);
		}
		else {
			mysql_query("INSERT INTO account (email, password, name, contact, address, position, hash, active) VALUES ('$email', '$password', '$name', '$contact', '$address', 'Walk-In', '$hash', 1)");
			echo json_encode(true);
		}
	}

	if($action == "checkoldpassword"){
		$accID = $_SESSION['accID'];
		$oldpassword = mysql_escape_string($_POST['oldpassword']);
		$sql = mysql_query("SELECT password FROM account WHERE accID = '$accID'");
		$user = mysql_fetch_assoc($sql);
		$password = $user['password'];
		if($oldpassword === $password){
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	}

	if($action == "changepass"){
		$password = mysql_escape_string($_POST['password']);
		$acc = $_SESSION['accID'];
		mysql_query("UPDATE account SET password = '$password' WHERE accID = '$acc'");
	}

	if($action == "changeinfo"){
		$name = mysql_escape_string($_POST['name']);
		$contact = mysql_escape_string($_POST['contact']);
		$address = mysql_escape_string($_POST['address']);
		$acc = $_SESSION['accID'];
		mysql_query("UPDATE account SET name = '$name', contact = '$contact', address = '$address' WHERE accID = '$acc'");
		$_SESSION['name'] = $name;
		$_SESSION['contact'] = $contact;
		$_SESSION['address'] = $address;
	}

	if($action == "addadmin"){
		$accid = mysql_escape_string($_POST['accid']);
		mysql_query("UPDATE account SET position = 'Sub-Admin' WHERE accID = '$accid'");
		$obj['walkin'] = fetchdata("walkin");
		$obj['admin'] = fetchdata("admin");
		echo json_encode($obj);
	}

	if($action == "deleteaccount"){
		$accid = mysql_escape_string($_POST['accid']);
		$acctype = mysql_escape_string($_POST['acctype']);
		mysql_query("DELETE FROM account WHERE accID = '$accid'");
		mysql_query("DELETE FROM cart WHERE accID = '$accid'");
		echo fetchdata($acctype);
	}

	if($action == "deactivateaccount"){
		$accid = mysql_escape_string($_POST['accid']);
		$acctype = mysql_escape_string($_POST['acctype']);
		mysql_query("UPDATE account SET active = 0 WHERE accID = '$accid'");
		echo fetchdata($acctype);
	}

	if($action == "activateaccount"){
		$accid = mysql_escape_string($_POST['accid']);
		$acctype = mysql_escape_string($_POST['acctype']);
		mysql_query("UPDATE account SET active = 1 WHERE accID = '$accid'");
		echo fetchdata($acctype);
	}
	if($action == "removeadmin"){
		$accid = mysql_escape_string($_POST['accid']);
		mysql_query("UPDATE account SET position = 'Walk-In' WHERE accID = '$accid'");
		$obj['walkin'] = fetchdata("walkin");
		$obj['admin'] = fetchdata("admin");
		echo json_encode($obj);
	}
	if($action == "checklogin"){
		$accid = $_SESSION['accID'];
		if($accid == ""){
			echo json_encode(false);
		}
		else{
			echo json_encode(true);
		}
	}
	if($action == "checkactive"){
		$email = mysql_escape_string($_POST['email']);
		$password = mysql_escape_string($_POST['password']);
		$sql = mysql_query("SELECT * FROM account WHERE email = '$email' AND password = '$password'");
		$fetch = mysql_fetch_assoc($sql);
		if($fetch['active'] == 1){
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	}

	function fetchaddress(){
		$accid = $_SESSION['accID'];
		$output = '<div class="ld ld-ring ld-spin"></div>';
		$sql = mysql_query("SELECT * FROM address WHERE accID = '$accid'");
		if(mysql_num_rows($sql) == 0){
			$output .=
			'<div class="list-group-item flex-column">
				<p class="h1-responsive"><center>No Optional Address</center></p>
		    </div>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$addid = $fetch['addressID'];
				$name = $fetch['name'];
				$address = $fetch['address'];
				$contact = $fetch['contact'];
				$output .= 
				'<div id="add'.$addid.'" class="list-group-item flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">'.$name.'</h5>
				    </div>
				    <p class="mb-1">'.$address.'</p>
				    <small>'.$contact.'</small><br><br>
				    <button data-toggle="collapse" data-target="#collapseeditaddress'.$addid.'" type="button" class="btn btn-sm btn-outline-warning waves-effect">Edit</button>
				    <button onclick="removeoptionaddress('.$addid.')" type="button" class="btn btn-sm btn-outline-danger waves-effect">Remove</button>
				    <div class="collapse" id="collapseeditaddress'.$addid.'">
				    	<br>
				    	<p class="error" id="errormsgeditadd'.$addid.'"></p> 
					    <div class="md-form d-flex justify-content-center">
						    <input id="editaddname'.$addid.'" type="text" class="input-alternate" placeholder="Name">
						</div>
						<div class="md-form d-flex justify-content-center">
						    <input id="editaddadd'.$addid.'" type="text" class="input-alternate" placeholder="Address">
						</div>
						<div class="md-form d-flex justify-content-center">
						    <input id="editaddcontact'.$addid.'" type="text" class="input-alternate" placeholder="Contact">
						</div>
						
						<div class="d-flex justify-content-end">
								<button onclick="editoptionaddress('.$addid.')" type="button" class="btn btn-success waves-effect waves-light">Update</button>
								<button type="button" data-toggle="collapse" data-target="#collapseeditaddress'.$addid.'" class="btn btn-secondary waves-effect waves-light">Cancel</button>
						</div>
					</div>
			    </div>
			    ';
			}
		}
		return $output;
	}
	if($action == "showaddress"){
		echo json_encode(fetchaddress());
	}
	if($action == "addaddress"){
		$accid = $_SESSION['accID'];
		$name = mysql_escape_string($_POST['name']);
		$address = mysql_escape_string($_POST['address']);
		$contact = mysql_escape_string($_POST['contact']);
		mysql_query("INSERT INTO address (accID, name, address, contact) VALUES ('$accid', '$name', '$address', '$contact')");
		echo json_encode(fetchaddress());
	}
	if($action == "removeaddress"){
		$addid = mysql_escape_string($_POST['addressid']);
		mysql_query("DELETE FROM address WHERE addressID = '$addid'");
		echo json_encode(fetchaddress());
	}
	if($action == "removealladdress"){
		$accid = $_SESSION['accID'];
		mysql_query("DELETE FROM address WHERE accID = '$accid'");
		echo json_encode(fetchaddress());
	}
	if($action == "editoptaddress"){
		$addid = mysql_escape_string($_POST['addid']);
		$name = mysql_escape_string($_POST['name']);
		$address = mysql_escape_string($_POST['address']);
		$contact = mysql_escape_string($_POST['contact']);
		mysql_query("UPDATE address SET name = '$name', address = '$address', contact = '$contact' WHERE addressID = '$addid'");
		echo json_encode(fetchaddress());
	}
	if($action == "showwalkin"){
		echo json_encode(fetchdata('walkin'));
	}
	if($action == "showadmin"){
		echo json_encode(fetchdata('admin'));
	}
	if($action == "unsetusersessions"){
		unset($_SESSION['accID']);
		unset($_SESSION['email']);
		unset($_SESSION['name']);
		unset($_SESSION['contact']);
		unset($_SESSION['address']);
		unset($_SESSION['position']);
		unset($_SESSION['name_on_nav']);
	}

	function sendmail($email, $hash, $name){
		$body = '';
		$body .= "<h1 style='color: pink;'>Hello ".$name."!</h1><br>";
		$body .= "<h3>If you wish to change your password, click the link below.</h3><br>";
		// $body .= '<h4><a href ="http://dolce-atelier.000webhostapp.com/php/forgotpass.php?email='.$email.'&hash='.$hash.'">http://dolce-atelier.000webhostapp.com/forgotpass.php?email='.$email.'&hash='.$hash.'</h4></a>';
		$body .= '<h4><a href ="localhost/BS/php/forgotpass.php?email='.$email.'&hash='.$hash.'">http://dolce-atelier.000webhostapp.com/forgotpass.php?email='.$email.'&hash='.$hash.'</h4></a>';
		require_once 'PHPMailer_5.2.4/class.phpmailer.php';
		$mail = new PHPMailer();
		$mail -> IsSMTP();
		$mail -> SMTPDebug = 1;
		$mail -> SMTPAuth = true;
		$mail -> SMTPSecure = 'ssl';
		$mail -> Host = "smtp.gmail.com";
		$mail -> Port = 465;
		$mail -> IsHTML(true);
		$mail -> Username = "dolceatelier00@gmail.com";
		$mail -> Password = "kimjeremy";
		$mail -> SetFrom("dolceatelier00@gmail.com");
		$mail -> Subject = "Change Password";
		$mail -> Body = $body;
		$mail -> AddAddress($email);
		$mail -> Send();
	}
	if($action == "checkemail"){
		$email = mysql_escape_string($_POST['email']);
		$sql = mysql_query("SELECT * FROM account WHERE email = '$email'");
		if(mysql_num_rows($sql) == 0){
			echo json_encode(false);
		}
		else{
			$fetch = mysql_fetch_assoc($sql);
			$hash = $fetch['hash'];
			$name = str_word_count($fetch['name'], 1)[0];
			sendmail($email, $hash, $name);
			echo json_encode(true);
		}
	}
	if($action == "newpassword"){
		$password = mysql_escape_string($_POST['password']);
		$email = $_SESSION['emailfornewpass'];
		mysql_query("UPDATE account SET password = '$password' WHERE email = '$email'");
		unset($_SESSION['emailfornewpass']);
		$output = '';
		$output .= '<p class="h1-responsive text-center mb-4 green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Password Successfully Changed</p>';
		$output .= '<p class="h3-responsive text-center mb-4">Congratulation for changing your password. Hooray!!</p>';
		echo json_encode($output);
	}
?>