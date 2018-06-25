<?php
	
	if(isset($_SESSION["user"])){
		session_destroy();	
	}
?>

<script type="text/javascript">
	window.location="index.php";
</script>