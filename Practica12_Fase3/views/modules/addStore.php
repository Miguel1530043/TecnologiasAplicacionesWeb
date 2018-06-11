<?php
	//error_reporting(0);
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$MVC = new MvcController();
?>

<div class="content-wrapper">
	<section class="content">
    	<div class="card card-success">
      		<div class="card-header">
        		<label class="card-title">Registro de Tiendas</label>
        		<a href="index.php?action=categories"><input type="button" name="" value="Regresar" class="btn btn-info"></a>
      		</div>
			<form method="post" role="form">
				<div class="card-body" align="center">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-4">
							<input type="text" name="store_name" placeholder="Nombre de la tienda" class="form-control"><br>
						</div>
						<div class="col-4">
							<input type="text" name="store_description" placeholder="Descripcion" class="form-control"><br>
						</div>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div clasS="col-4">
							<input type="text" name="store_address" placeholder="Direccion" class="form-control">
						</div>
						<div clasS="col-4">
							<select name="status" class="form-control">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						<br><br>
						<div class="container" align="center">
							<input type="submit" name="add" value="Registrar" class="btn-lg btn-success">
						</div>
					</div>
				</div>
			</form>
		</div>
			<?php
				$MVC->addStoreController();
			?>
	</section>
</div>
<script>
  	$(function () {
    	$('#t1').DataTable({
      		"paging": true,
      		"lengthChange": false,
      		"searching": false,
      		"ordering": true,
      		"info": true,
      		"autoWidth": false
    	});
  	});
</script>
