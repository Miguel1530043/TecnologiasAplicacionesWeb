<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>CARRERAS</h1>

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