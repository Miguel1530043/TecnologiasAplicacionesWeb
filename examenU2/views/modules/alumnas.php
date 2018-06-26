<?php
$mvc = new MvcController();
	echo $_SESSION["user"];
	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	
	
?>
<div class="row">
	<div class="col-2"></div>
	<div class="col-8" align="center">
		<h1 style="color:purple">Alumnas</h1>
		<a href="index.php?action=agregarAlumna" class="btn btn-primary">Agregar Alumna</a>
		<table class="table table-bordered table-striped">
			<thead style="background-color: purple;color:white;">
				<tr align="center">
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Fecha de Nacimiento</th>
					<th>Grupo</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$mvc ->showStudentsController();
				?>
			</tbody>
		</table>
	</div>
	<div class="col-2"></div>
</div>