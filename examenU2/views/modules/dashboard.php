<?php
$mvc = new MvcController();
echo $_SESSION["user"];
if(!isset($_SESSION["user"])){
		
  
  echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	
?>
<div align="center">
	<img src="views/dist/img/danzlife.jpeg">
</div>