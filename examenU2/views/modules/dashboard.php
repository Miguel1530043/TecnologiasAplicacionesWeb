<?php
	
	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	$mvc = new MvcController();
?>
<div align="center">
	<img src="views/dist/img/danzlife.jpeg">
</div>