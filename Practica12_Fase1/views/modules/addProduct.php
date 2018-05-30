<H1>AREGAR PRODUCTO</H1>

<form method="post">
	
	<input type="text" name="id" placeholder="ID"><br>
	<input type="text" name="name" placeholder="Nombre"><br>
	<input type="text" name="description" placeholder="Descripcion"><br>
	<input type="text" name="price" placeholder="Precio"><br>
	<input type="number" name="stock" placeholder="Cantidad"><br>
	<input type="submit" name="add" value="Agregar">

	<?php
		$MVC = new MvcController();
		$MVC -> addProductController();
	?>

</form>