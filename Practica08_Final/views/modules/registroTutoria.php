
<?php
	session_start();
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
	<select name="tutor" id="tutor">
	<?php
		$registro -> selectTutor();
	?>
	</select>
	
	<input type="date" placeholder="Fecha" name="fecha" required>


	<input type="time" placeholder="hora" name="hora" required>

	<input type="text" name="descripcion" placeholder="Descripcion" required>

	<select name="tipo">
		<option value="Individual">Individual</option>
		<option value="Grupal">Grupal</option>
	</select>
	
	<input type="submit" name="registrar" value="Enviar">

</form>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#tutor').select2();
	});
</script>