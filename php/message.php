<?php 
	session_start();
	include 'connect.php';
	$action = $_POST['action'];
	function fetchdata(){
		$sql = mysql_query("SELECT * FROM message ORDER BY messageID DESC");
		if(mysql_num_rows($sql) == 0){
			$output .=
			'<tr>
				<td colspan="4"><h1><center>No Messages found</center></h1></td>
			</tr>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)) {
	            $messageid = $fetch['messageID'];
	            $email = $fetch['email'];
	            $name = $fetch['name'];
	            $message = $fetch['message'];
	            $datemsg = $fetch['datemsg'];
				$output .=
		                "<tr id='tdrow' data-id='".$messageid."'>
		                        <td class='messageid' hidden>".$messageid."</td>
		                        <td class='email'>" . $email. "</th>
		                        <td class='name'>".$name."</td>
		                        <td class='message' hidden>".$message."</td>
		                        <td class='datemsg'>" . $datemsg . "</td>
		                        <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-info showmessage waves-effect' data-toggle='modal' data-target='#viewmodal'><i class='fa fa-sticky-note-o' aria-hidden='true'></i> View</button><button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deletemodal'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></td>
		                    </tr>";
	        }
		}
        return $output;
	}
	if($action == 'addmessage'){
		$status = $_POST['status'];
		if($status == 0){
			$email = mysql_escape_string($_POST['email']);
			$name = mysql_escape_string($_POST['name']);
			$message = mysql_escape_string($_POST['message']);
			$date = date('m-d-Y h:i:sa');
			mysql_query("INSERT INTO message (email, name, message, datemsg) VALUES('$email', '$name', '$message', '$date')");

		}
		else{
			$email = $_SESSION['email'];
			$name = $_SESSION['name'];
			$message = mysql_escape_string($_POST['message']);
			$date = date('m-d-Y h:i:sa');
			mysql_query("INSERT INTO message (email, name, message, datemsg) VALUES('$email', '$name', '$message', '$date')");
		}
	}

	if($action == "deletemessage"){
		$messageid = mysql_escape_string($_POST['messageid']);
		$output = '';
		mysql_query("DELETE FROM message WHERE messageID = '$messageid'");
		$sql = mysql_query("SELECT * FROM message");
        if(mysql_num_rows($sql) == 0 ){
        	$output .= 
            "<tr>
                <td colspan='4'><h1><center>No Messages Found</center></h1></td>
            </tr>";
        }
        else{
            $output .= fetchdata();
        }
        echo $output;
	}
	if($action == "showmessage"){
		echo json_encode(fetchdata());
	}

	function sendreply($email, $message, $name, $client_msg){
		$body = '';
		$body .= "<h1 style='color: pink;'>Hello ".$name."!</h1><br>";
		$body .= "<h3>Our reply from your message: </h3>";
		$body .= "<h4>".$client_msg."</h4><br>";
		$body .= "<h3>Reply: </h3><h4>".$message."</h4>";
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
		$mail -> Subject = "Reply";
		$mail -> Body = $body;
		$mail -> AddAddress($email);
		$mail -> Send();
	}
	if($action == "sendreply"){
		$message = mysql_escape_string($_POST['message']);
		$name = mysql_escape_string($_POST['name']);
		$name = str_word_count($name, 1)[0];
		$email = mysql_escape_string($_POST['email']);
		$client_msg = mysql_escape_string($_POST['client_msg']);
		sendreply($email, $message, $name, $client_msg);
	}
?>