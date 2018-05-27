<?php
	session_start();
?>
<h1>ALUMNOS</h1>
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

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>