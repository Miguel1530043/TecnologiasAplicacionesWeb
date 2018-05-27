<?php

session_start();
?>
<h1>EDITAR TUTORIA</h1>

<form method="post">
	
	<?php

	$editarUsuario = new MvcCont();
	$editarUsuario -> editarTutoriaC();
	$editarUsuario -> acutalizarTutoriaC();

	?>

</form>