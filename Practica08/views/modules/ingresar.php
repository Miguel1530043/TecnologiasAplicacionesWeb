
<h1>INGRESAR</h1>
	<form method="post">
		
		<input type="text" placeholder="Maestro" name="nameMaestro" required>

		<input type="password" placeholder="Contraseña" name="password" required>

		<input type="submit" name="ingresar" value="Enviar">
	

	</form>

<?php

$ingreso = new MvcCont();
$ingreso -> ingresoMaestroC();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

?>