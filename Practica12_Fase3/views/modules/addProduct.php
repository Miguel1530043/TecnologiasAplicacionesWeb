<?php
	//error_reporting(0);
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}
	$id_store = $_GET["id_store"];	
	$MVC = new MvcController();
?>

<div class="content-wrapper">
	<section class="content">
    	<div class="card card-success">
      		<div class="card-header">
        		<label class="card-title">Registro de Producto</label>
        		<?php echo '<a href="index.php?action=products&id_store='.$id_store.'" class="btn btn-info">Regresar</a>';?>
      		</div>
			<form method="post" role="form">
				<div class="card-body" align="center">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-8">
							<input type="text" name="code" placeholder="Codigo de Producto" class="form-control">
						</div><br><br>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div class="col-4">
							<input type="text" name="prod_name" placeholder="Nombre del Producto" class="form-control">
						</div>
						<div class="col-4">
							<select name="category_id" class="form-control select2" id="select2" >
								<option value=" ">Categoria...</option>
								<?php
									$MVC -> selectCategory();
								?>
							</select>
						</div>
						<div class="col-2"></div>
						<br><br>
						<div class="col-2"></div>
						<div class="col-4">
							<input type="text" name="price" placeholder="Precio" class="form-control">
						</div>
						<div class="col-4">
							<input type="number" min="1" name="stock" placeholder="Cantidad" class="form-control">
						</div>
						<div class="col-3"></div>
						<div class="col-2"></div>
						<br><br>
						<div class="container" align="center">
							<input type="submit" name="add" value="Registrar" class="btn-lg btn-success">
						</div>
					</div>
				</div>
			</form>
		</div>
			<?php
				$MVC->addProductController();
			?>
	</section>
</div>
