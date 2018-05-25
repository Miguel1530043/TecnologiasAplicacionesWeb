
<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php?action=ingresar");
		exit();
	}
	//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
	$registro = new MvcConT();
	//se invoca la función registroUsuarioController de la clase MvcController:
	$registro -> registrarCarreraC();
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro Exitoso";
		}
	}
?>
<h1>REGISTRO DE ALUMNO</h1>

<form method="post">
	
	<input type="text" placeholder="Nombre" name="carrera" required>
	<input type="submit" name="registrar" value="Enviar">

</form>