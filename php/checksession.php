<?php  
	session_start();
	if($_SESSION['accID'] == ""){
		?>
		<script>
			window.location = 'index.php';
		</script>
		<?php
	}
?>