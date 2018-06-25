<?php
	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	$mvc = new MvcController();
?>
<div class="row" >
	<div class="col-2"></div>
	<div class="col-8" align="center">
		<h1 style="color:purple">Editar Pago</h1>
		<form method="post">
			<?php
				$mvc->editPaymentController();
			?>
			</select><br>
			<input type="submit" name="update" value="Actualizar" class="btn btn-info">
		</form>
	<?php
		$mvc->updatePaymentController();
	?>
	</div>
	<div class="col-2"></div>
</div>
