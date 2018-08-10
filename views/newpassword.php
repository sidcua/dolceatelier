<?php 
    session_start();
?>
<div class="row animated fadeIn">
	<div class="col-lg-1"></div>
	<div class="col-lg-8">
        <p class="error" id="errormsgnewpass"></p>
        <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="oldpassword" class="input-alternate" placeholder="Old password">
        </div>
        <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="newpassword" class="input-alternate" placeholder="New password">
        </div>
        <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="newpassword2" class="input-alternate" placeholder="Retype new password">
        </div>
	</div>
    <div class="col-lg-3"></div>
</div>
<div class="row animated fadeIn">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
        <button type="button" onclick="checknewpass()" class="btn btn-outline-info waves-effect">Confirm</button>
        <button type="button" class="btn btn-outline-danger waves-effect" onclick="account_content('1')">Cancel</button>
    </div>
</div>
