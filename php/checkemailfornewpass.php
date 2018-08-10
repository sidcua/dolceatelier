<?php  
	if($_SESSION['emailfornewpass'] == "" || !isset($_SESSION['emailfornewpass'])){
		?>
		<script>
			window.location = 'index.php';
		</script>
		<?php
	}
?>