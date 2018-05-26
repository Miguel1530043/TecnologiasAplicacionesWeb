<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}
?>

<h1>ALUMNOS</h1>
	<a href="index.php?action=registroAlumno"><input type="button" value="Registrar"/></a>
	<table>
		
		<thead>
			
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
				
			$vistaAlumno -> vistaAlumnosC();	
			
			$vistaAlumno -> borraAlumnoC();

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