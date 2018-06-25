<?php

	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	$mvc = new MvcController();
?>
<div class="row">
	<div class="col-2"></div>
	<div class="col-8" align="center">
		<h1 style="color:purple">Grupos</h1>
		<a href="index.php?action=agregarGrupo" class="btn btn-primary">Agregar Grupo</a>
		<table class="table table-bordered table-striped">
			<thead style="background-color:purple;color:white;">
				<tr align="center">
					<th>ID</th>
					<th>Nombre</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$mvc ->showGroupsController();
			?>
			</tbody>
		</table>
	</div>
	<div class="col-2"></div>
</div>
