
<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php");
		exit();
	}
	//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
	$registro = new MvcConT();
	//se invoca la función registroUsuarioController de la clase MvcController:
	$registro -> registrarTutoriaC();
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro Exitoso";
		}
	}
?>
<h1>REGISTRO DE MAESTRO</h1>

<form method="post">

	<?php
		$registro -> selectTutor();
	?>
	
	<input type="date" placeholder="Fecha" name="fecha" required>


	<input type="time" placeholder="hora" name="hora" required>

	<input type="text" name="descripcion" placeholder="Descripcion" required>

	<select name="tipo">
		<option value="Individual">Individual</option>
		<option value="Grupal">Grupal</option>
	</select>
	
	<input type="submit" name="registrar" value="Enviar">

</form>