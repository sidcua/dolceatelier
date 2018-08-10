<?php  
	if($_SESSION['erroraccess'] != true || !isset($_SESSION['erroraccess'])){
		?>
		<script>
			window.location = 'index.php';
		</script>
		<?php
	}
?>