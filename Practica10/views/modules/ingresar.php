<?php

	
?>
<h1>INGRESAR</h1>

	<form method="post">
		
		<input type="text" placeholder="Usuario" name="user" required>

		<input type="password" placeholder="Contraseña" name="pass" required>

		<input type="submit" value="Enviar">

	</form>

<?php

$ingreso = new MvcProdController();
$ingreso -> ingresoUsuarioC();
if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}

?>