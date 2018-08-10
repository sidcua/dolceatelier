<?php
    session_start(); 
    include '../php/connect.php';
    $accID = $_SESSION['accID'];
    $sql = mysql_query("SELECT password FROM account WHERE accID = '$accID'");
    $user = mysql_fetch_assoc($sql);
    $password = $user['password'];
?>
<div class="row animated fadeIn">
	<div class="col-lg-1"></div>
	<div class="col-lg-8">
    	<div class="md-form">  
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="email" class="input-alternate" disabled value="<?php echo $_SESSION['email']; ?>">
        </div>
        <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="password" class="input-alternate" disabled value="<?php echo $password; ?>">
        </div>
	</div>
    <div class="col-lg-3"></div>
</div>
<div class="row animated fadeIn">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
        <button type="button" class="btn btn-outline-default waves-effect"onclick="account_content('2')">Change Password</button>
    </div>
</div>