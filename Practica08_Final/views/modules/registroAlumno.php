
<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php?");
		exit();
	}
	//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
	$registro = new MvcConT();
	//se invoca la función registroUsuarioController de la clase MvcController:
	$registro -> registrarAlumnoC();
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro Exitoso";
		}
	}
?>
<h1>REGISTRO DE ALUMNO</h1>

<form method="post">
	
	<input type="text" placeholder="Nombre" name="alumno" required>

	<select name='carrera' id='carrera' >
	<?php
		$registro->selectCarreras();
	?>
	</select>
		<select name='tutor' id='tutor' >
	<?php
		$registro->selectTutor();
	?>	
	</select>
	<input type="submit" name="registrar" value="Enviar">

</form>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#carrera').select2();
	});
	$(document).ready(function(){
		$('#tutor').select2();
	});

</script>

