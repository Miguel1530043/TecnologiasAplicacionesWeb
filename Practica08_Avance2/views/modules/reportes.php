<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}else if(!$_SESSION["maestro"]){
	header("location:index.php?action=alumnos");
	exit();
}

?>


<h1>REPORTES</h1>

<h3>MAESTROS</h3>
	<table>
		
		<thead>
			
			<tr>
				<th>Numero de Empleado</th>
				<th>Nombre</th>
				<th>E-Mail</th>
				<th>Carrera</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$vistaMaestros = new MvcCont();
			$vistaMaestros -> vistaMaestrosC();
			$vistaMaestros -> borraMaestroC();

			?>

		</tbody>

	</table>

	<h3>ALUMNOS</h3>

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


<h3>CARRERAS</h3>

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