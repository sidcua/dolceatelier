
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeInLeftBig">
	<div class="card-body">
		<h2 class="white-text mb-0">Panel</h2>
	</div>
</div>
<div class="divspace"></div>
<div class="list-group animated fadeInLeftBig">
    <a id="panelorders" onclick="panel('orders')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-map-pin" aria-hidden="true"></i> Orders</a>
    <?php 
    	if($_SESSION['position'] == "Admin"){
    		echo '<a id="panelaccounts" onclick="panel(&#39;accounts&#39;)" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-user" aria-hidden="true"></i> Accounts</a>';
    	}
    ?>
    <a id="panelproducts" onclick="panel('products')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-database" aria-hidden="true"></i> Products</a>
    <a id="panelmessages" onclick="panel('messages')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a>
    <a id="panelsettings" onclick="panel('settings')" class="list-group-item list-group-item-action waves-effect waves-light" data-toggle="list"><i class="fa fa-gear" aria-hidden="true"></i> Settings</a>
</div>
<br>
<script>
    $(document).ready(function(){
        activetogglepanel('<?php echo $_SESSION['adminpanel']; ?>')
        panel('<?php echo $_SESSION['adminpanel']; ?>');
    });
    function activetogglepanel(panel){
        if(panel == "orders"){
            document.getElementById("panelorders").className += " active";
        }
        else if(panel == "accounts"){
            document.getElementById("panelaccounts").className += " active";
        }
        else if(panel == "products"){
            document.getElementById("panelproducts").className += " active white-text";
        }
        else if(panel == "messages"){
            document.getElementById("panelmessages").className += " active";
        }
        else if(panel == "settings"){
            document.getElementById("panelsettings").className += " active";  
        }
    }
    function whitetext(content){
        var orders = document.getElementById("panelorders");
        var accounts = document.getElementById("panelaccounts");
        var products = document.getElementById("panelproducts");
        var messages = document.getElementById("panelmessages");
        var settings = document.getElementById("panelsettings");
        if(content == "orders"){
            orders.classList.remove("white-text");
            accounts.classList.remove("white-text");
            products.classList.remove("white-text");
            messages.classList.remove("white-text");
            settings.classList.remove("white-text");
            orders.className += " white-text";
        }
        else if(content == "accounts"){
            orders.classList.remove("white-text");
            accounts.classList.remove("white-text");
            products.classList.remove("white-text");
            messages.classList.remove("white-text");
            settings.classList.remove("white-text");
            accounts.className += " white-text";
        }
        else if(content == "products"){
            orders.classList.remove("white-text");
            accounts.classList.remove("white-text");
            products.classList.remove("white-text");
            messages.classList.remove("white-text");
            settings.classList.remove("white-text");
            products.className += " white-text";
        }
        else if(content == "messages"){
            orders.classList.remove("white-text");
            accounts.classList.remove("white-text");
            products.classList.remove("white-text");
            messages.classList.remove("white-text");
            settings.classList.remove("white-text");
            messages.className += " white-text";
        }
        else if(content == "settings"){
            orders.classList.remove("white-text");
            accounts.classList.remove("white-text");
            products.classList.remove("white-text");
            messages.classList.remove("white-text");
            messages.classList.remove("white-text");
            settings.classList += " white-text";
        }
    }
</script>