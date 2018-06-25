<?php
	
	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	$mvc = new MvcController();
	
?>
<div class="row">
	<div class="col-2"></div>
	
	<div class="col-8" align="center">
		<a href="index.php?action=alumnas" class="btn btn-secondary">Alumnas</a>
		<h1 style="color:purple">Registro de Alumna</h1>
		<form method="post">
			<input type="text" name="nombre" placeholder="Nombre" class="form-control"><br>
			<input type="text" name="apellidos" placeholder="Apellidos" class="form-control"><br>
			<input type="date" name="fecha_nacimiento" class="form-control"><br>
			<select class="form-control" name="grupo">
				<?php
					$mvc->selectGroup();
				?>
			</select><br>
			<input type="submit" name="add" value="Agregar" class="btn btn-info">
		</form>
		<?php
			$mvc->addStudentController();
		?>
	</div>
	<div class="col-2"></div>
</div>