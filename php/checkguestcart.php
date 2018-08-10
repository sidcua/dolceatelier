<?php  
	if($_SESSION['accID'] == ""){
		$cartprod = $_SESSION['prod'];
		if(count($cartprod) == 0 || empty($cartprod)){
			?>
			<script>
				window.location = 'index.php';
			</script>
			<?php
		}
	}
?>