
<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php");
		exit();
	}
	//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
	$registro = new MvcConT();
	//se invoca la función registroUsuarioController de la clase MvcController:
	$registro -> registroMaestroC();
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro Exitoso";
		}
	}
?>
<h1>REGISTRO DE MAESTRO</h1>

<form method="post">
	
	<input type="text" placeholder="Usuario" name="maestro" required>

	<input type="password" placeholder="Contraseña" name="password" required>

	<input type="email" placeholder="Email" name="email" required>
	<select id ="carrera" name="carrera">
	<?php
		$registro->selectCarreras();
	?>	
	</select>
	<input type="submit" name="registrar" value="Enviar">

</form>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#carrera').select2();
	});
</script>
