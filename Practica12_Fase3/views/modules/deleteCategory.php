<?php
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$MVC = new MvcController();
	$id_store = $_GET['id_store']:
?>

<div class="content-wrapper">
	<section class="content">
	    <div class="container-fluid">
	    	<a href="index.php?action=categories" class="btn btn-info">Regresar</a>
	    	<div class="row">
	    		<div class="col-6">
		        	<div class="card card-danger">
		          		<div class="card-header">
		            		<label class="card-title">Eliminar Categoria</label>
		          		</div>
		      		
						<form method="post" role="form" id="formid" action="index.php?action=deleteCategory&id=4">
							<div class="card-body" align="center">
									<h3>Por favor ingresa tu contraseña para eliminar el producto</h3>
									<div class="col-4"></div>
									<div class="col-4">
										<input type="password" name="password" id="password1" placeholder="Contraseña" class="form-control" required><br>
									</div>
									<div class="col-4"></div>
									<input type="button" name="delete" id="delete" value="Aceptar" class="btn btn-danger" onclick="alertaEliminar()">
									<a href="index.php?action=categories"><input type="button" name="cancelar" value="Cancelar" class="btn btn-warning"></a>
							</div>	
						</form>
						<?php
							$MVC->deleteCategoryController();
						?>
					</div>
				</div>

				<div clasS="col-6">
					<div class="card card-info">
		          		<div class="card-header">
		            		<label class="card-title">Informacion de la Categoria</label>
		          		</div>
		          		<div align="center">
							<?php
								$MVC->categoryController();
							?>
						</div>
		          	</div>
		        </div>
          	</div>
		</div>
	</section>
</div>