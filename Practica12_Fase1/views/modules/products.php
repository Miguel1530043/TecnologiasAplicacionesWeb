<?php
	$MVC = new MvcController();
?>


<h1>PRODUCTOS</h1>
<a href="index.php?action=addProduct"><input type="button" name="add" Value="Agregar Producto"></a>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Precio</th>
			<th>Cantidad</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$MVC -> productViewsController();
		?>
	</tbody>

</table>