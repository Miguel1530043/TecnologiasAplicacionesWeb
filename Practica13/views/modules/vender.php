<?php 
	session_start();
	if(!isset($_SESSION["carrito"])){ 
		$_SESSION["carrito"] = [];
	}
	$MVC = new MvcController();

	$granTotal = 0;
?>
	<div class="col-xs-12">
		
		
		<?php
			$MVC->venderController();
		?>
		<br><br><br>
		<h1>Vender</h1>
		<form method="post">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		</form>
		
		<?php
			$MVC->agregarCarritoController();
		?>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$MVC -> verCarritoController();
		
					$MVC->terminarVentaController();
				?>
			
	</div>
	
	