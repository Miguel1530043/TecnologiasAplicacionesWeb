<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php");

	exit();

}
?>
<h1>EDITAR ALUMNO</h1>

<form method="post">
	
	<?php

	$editarUsuario = new MvcCont();
	$editarUsuario -> editarCarreraC();
	$editarUsuario -> actualizarCarreraC();

	?>

</form>