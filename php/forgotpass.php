<?php  
	session_start();
	include 'connect.php';
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
		$email = mysql_escape_string($_GET['email']);
		$hash = mysql_escape_string($_GET['hash']);
		$sql = mysql_query("SELECT * FROM account WHERE email = '$email' AND hash = '$hash'");
		if(mysql_num_rows($sql) == 0){
			$_SESSION['erroraccess'] = true;
			header("location: ../error.php");
		}
		else{
			$_SESSION['emailfornewpass'] = $email;
			header("location: ../changepass.php");
		}
	}else{
		$_SESSION['erroraccess'] = true;
		header("location: ../error.php");
	}
?>