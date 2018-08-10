<?php session_start(); ?>
<form method="post" id="editinfo" onsubmit="return checknewinfo()">
	<div class="row animated fadeIn">
	    <div class="col-lg-1"></div>
	    <div class="col-lg-8">
			<p class="error" id="errormsgnewinfo"></p>
	        <div class="md-form">
	            <i class="fa fa-pencil prefix"></i>
	            <input type="text" id="infoname" class="input-alternate" placeholder="Name" value="<?php echo $_SESSION['name']; ?>">
	        </div>
	        <div class="md-form">
	            <i class="fa fa-phone prefix"></i>
	            <input type="text" id="infocontact" class="input-alternate	" placeholder="Contact" value="<?php echo $_SESSION['contact']; ?>">
	        </div>
	        <div class="md-form">
	            <i class="fa fa-map prefix"></i>
	            <input type="text" id="infoaddress" class="input-alternate	" placeholder="Address" value="<?php echo $_SESSION['address']; ?>">
	        </div>
		        
	    </div>
	</div>
	<div class="row animated fadeIn">
	    <div class="col-lg-3"></div>
	    <div class="col-lg-9">
	        <button type="submit" class="btn btn-outline-success waves-effect">Confirm</button>
	        <button type="button" class="btn btn-outline-danger waves-effect" onclick="info_content('1')">Cancel</button>
	    </div>
	</div>
</form>