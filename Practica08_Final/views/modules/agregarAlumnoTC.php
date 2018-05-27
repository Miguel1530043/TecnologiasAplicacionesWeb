<?php
	session_start();
?>
<h1>ALUMNOS</h1>
<form method="post">	
	<table>
		<thead>
			
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>id Carrera</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
			
			$vistaAlumno -> vistaAlumnosPorTutorC();
			
			$vistaAlumno -> borraAlumnoC();

			?>

		</tbody>

	</table>
	<input type="submit" name="agregar" value="Agregar">
</form>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>