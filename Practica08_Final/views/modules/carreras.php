<?php

session_start();

if(isset($_SESSION["maestro"])){	
	$id = $_SESSION["maestro"];
	header("location:index.php?action=alumnosMaestro&id=$id");
	exit();
}else if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}

?>

<h1>CARRERAS</h1>
	<a href="index.php?action=registroCarrera"><input type="button" value="Registrar"/></a>

	<table>
		
		<thead>
			
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
			$vistaAlumno -> vistaCarreraC();
			$vistaAlumno -> borraCarreraC();

			?>

		</tbody>

	</table>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>