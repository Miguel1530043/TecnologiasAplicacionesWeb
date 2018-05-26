<?php
	session_start();
	if(!$_SESSION["maestro"]){
		header("location:index.php");
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
			echo $_SESSION['maestro'];
			$vistaAlumno = new MvcCont();
			
			$vistaAlumno -> vistaAlumnosPorTutorC();
			
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