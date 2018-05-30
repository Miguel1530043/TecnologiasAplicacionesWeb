<?php

	$MVC = new MvcController();

?>

<h1>EDITAR PRODUCTO</h1>
<form method="post">
	<?php
		$MVC ->editProductController();
		$MVC -> updateProductController();


	?>
</form>