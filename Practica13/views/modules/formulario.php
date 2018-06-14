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
	<h1>Nuevo producto</h1>
	<form method="post" >
		<label for="codigo">Código de barras:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		<br>
		<label>Descripcion</label>
		<input class="form-control" type="text" name="descripcion" placeholder="Descripcion">
		<label>Precio Venta</label>
		<input class="form-control" type="text" name="precio_venta" placeholder="Precio Venta">
		<label>Precio Compra</label>
		<input class="form-control" type="text" name="precio_compra" placeholder="Precio Compra">
		<label>Existencia</label>
		<input class="form-control" type="text" name="existencia" placeholder="Existencia">
		<br>
		<input type="submit" name="add" value="Guardar" clasS="btn btn-primary" >
	</form>
	<?php

		$MVC->addProductController();
	?>
</div>
