<?php  
	session_start();
	$_SESSION['adminpanel'] = "orders";
?>
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeIn">
    <div class="card-body">
        <h2 class="white-text mb-0">Manage Orders</h2>
    </div>
</div>

<br>
<div class="container animated fadeIn d-flex justify-content-between">
    <span class="blue-text h1-responsive"><i class="fa fa-tasks" aria-hidden="true"></i> Orders</span>
</div>
<br>
<div class="container-fluid">
	<div class="row">
		<p class="h2-responsive p-2 yellow-text darken-3"><i class="fa fa-clock-o" aria-hidden="true"></i> Pending Orders</p>
	</div>
	<div class="row ld-over">
		<div class="ld ld-ring ld-spin"></div>
		<div class="col-lg-12">
			<div class="list-group animated fadeIn" id="divpending">
			</div>
		</div>	
	</div>
	<br>
	<div class="row">
		<p class="h2-responsive p-2 green-text darken-3"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Accepted Orders</p>
	</div>
	<div class="row ld-over">
		<div class="ld ld-ring ld-spin"></div>
		<div class="col-lg-12">
			<div class="list-group ld-over animated fadeIn" id="divaccept">
			</div>
		</div>	
	</div>
	<br>
	<div class="row">
		<p class="h2-responsive p-2 blue-text darken-3"><i class="fa fa-check-square-o" aria-hidden="true"></i> Finished Orders</p>
	</div>
	<div class="row ld-over">
		<div class="ld ld-ring ld-spin"></div>
		<div class="col-lg-12">
			<div class="list-group ld-over animated fadeIn" id="divfinish">
			</div>
		</div>	
	</div>
</div>
<script>
	$(document).ready(function(){
		showpending();
		showaccept();
		showfinish();
	})
	function showpending(){
		$.ajax({
			url: "php/orders.php",
			method: "POST",
			data: {action: "showpending"},
			beforeSend: function(){
				$('#divpending').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				if(data.addclass == true){
					$("#divpending").parent().addClass("orderdiv");
				}
				$("#divpending").html(data.data);
			}
		})
	}
	function showaccept(){
		$.ajax({
			url: "php/orders.php",
			method: "POST",
			data: {action: "showaccept"},
			beforeSend: function(){
				$('#divaccept').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				if(data.addclass == true){
					$("#divaccept").parent().addClass("orderdiv");
				}
				$("#divaccept").html(data.data);
			}
		})
	}
	function showfinish(){
		$.ajax({
			url: "php/orders.php",
			method: "POST",
			data: {action: "showfinish"},
			beforeSend: function(){
				$('#divfinish').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				if(data.addclass == true){
					$("#divfinish").parent().addClass("orderdiv");
				}
				$("#divfinish").html(data.data);
			}
		})
	}
</script>