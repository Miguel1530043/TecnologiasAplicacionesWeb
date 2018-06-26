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
	<div class="col-1"></div>
	<div class="col-10" align="center">
		<h1 style="color:purple">Pagos</h1>
		<table class="table table-bordered table-striped">
			<thead style="background-color: purple;color:white;">
				<tr align="center">
					<th>ID</th>
					<th>Grupo</th>
					<th>Alumna</th>
					<th>Madre</th>
					<th>Fecha de Envio</th>
					<th>Fecha de Pago</th>
					<th>Imagen del Folio</th>
					<th>Folio</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$mvc ->showPaymentsController();
				?>
			</tbody>
		</table>
	</div>
	<div class="col-1"></div>
</div>
