<?php session_start(); ?>
<div class="row animated fadeIn">
    <div class="col-lg-1"></div>
    <div class="col-lg-8">
        <div class="md-form">
            <i class="fa fa-pencil prefix"></i>
            <input type="text" id="name" class="input-alternate" placeholder="Name" disabled value="<?php echo $_SESSION['name']; ?>">
        </div>
        <div class="md-form">
            <i class="fa fa-phone prefix"></i>
            <input type="text" id="contact" class="input-alternate" placeholder="Contact" disabled value="<?php echo $_SESSION['contact']; ?>">
            
        </div>
        <div class="md-form">
            <i class="fa fa-map prefix"></i>
            <input type="text" id="address" class="input-alternate" placeholder="Address" disabled value="<?php echo $_SESSION['address']; ?>">
        </div>
    </div>
</div>
<div class="row animated fadeIn">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
        <button type="button" onclick="info_content('2')" class="btn btn-outline-success waves-effect">Edit Info</button>
    </div>
</div>