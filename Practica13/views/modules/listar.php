<?php
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$MVC = new MvcController();
?>

	<div class="col-xs-12">
		<br><br><br><h1>Productos</h1>
		<div>
			<a class="btn btn-success" href="index.php?action=formulario">Nuevo Producto <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de compra</th>
					<th>Precio de venta</th>
					<th>Existencia</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				
					<?php
						$MVC ->productsViewController();
					?>
			</tbody>
		</table>
	</div>
