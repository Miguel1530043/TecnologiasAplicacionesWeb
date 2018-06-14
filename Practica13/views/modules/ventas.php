<?php
	$MVC = new MvcController();
    session_start();
    if(isset($_SESSION["user"])){
        echo '<script>
            window.locatiion="index.php?action=listar"
        </script>';
    }

?>

	<div class="col-xs-12">
		<br><br><br><h1>Ventas</h1>
		<div>
			<a class="btn btn-success" href="index.php?action=vender">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$MVC ->ventasController();
				?>
			
		</table>
	</div>
	<?php

		$MVC->eliminarVentaController();
	?>