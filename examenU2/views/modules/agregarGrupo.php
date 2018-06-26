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
		<a href="index.php?action=grupos" class="btn btn-secondary">Grupos</a>
		<h1 style="color:purple">Registro de Grupo</h1>
		<form method="post">
			<input type="text" name="nombre_grupo" placeholder="Nombre" class="form-control"><br>
			<input type="submit" name="add" value="Agregar" class="btn btn-info">
		</form>
		<?php
			$mvc->addGroupController();
		?>
	</div>
	<div class="col-2"></div>
</div>