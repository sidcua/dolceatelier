<?php
@session_start();
error_reporting(0);

date_default_timezone_set('Asia/Manila');
/*  $host = 'localhost';
$user = "id2659903_school";
$pass = "school";
$db  = "id2659903_school";*/



 $host = 'localhost';
$user = "root";
$pass = "";
$db = "dolce";
 

	@$con = mysql_connect($host,$user,$pass);
		@mysql_select_db($db);
?>
