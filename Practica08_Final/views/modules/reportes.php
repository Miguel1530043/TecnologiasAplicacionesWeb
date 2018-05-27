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


<h1>REPORTES</h1>

<h3>MAESTROS</h3>
	<table id="maestro" class="cell-border">
		
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

	<table id="alumno">
		
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

	<table id="carreras" >
		
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
<h3>TUTORIAS</h3>
	<table id="tutorias" class="cell-border">
		<thead>
			
			<tr>
				<th>ID</th>
				<th>Tutor</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Descripcion</th>
				<th>Tipo</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
			
			$vistaAlumno ->vistaTutoriaC();
			
			$vistaAlumno -> borraTutoriaC();

			?>

		</tbody>

	</table>

<script type="text/javascript">
	$(document).ready(function() {
    	$('#tutorias').DataTable();
	});
	$(document).ready(function() {
    	$('#maestro').DataTable();
	});
	$(document).ready(function() {
    	$('#alumno').DataTable();
	});
	$(document).ready(function() {
    	$('#carreras').DataTable();
	});

</script>