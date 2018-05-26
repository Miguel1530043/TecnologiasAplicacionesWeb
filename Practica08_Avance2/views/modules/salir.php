<?php

session_start();
if(!$_SESSION['validar']){
	header("location:index.php");
	exit();
}else{
	session_destroy();

?>

	<h1>¡Haz salido de la aplicación!</h1>
<?php
	}
?>