<?php
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
	    <div class="container-fluid">
	    	<a href="index.php?action=users" class="btn btn-info">Regresar</a>
	    	<div class="row">
	    		<div class="col-6">
		        	<div class="card card-danger">
		          		<div class="card-header">
		            		<label class="card-title">Eliminar Usuario</label>

		          		</div>
		      		
						<form method="post" role="form">
							<div class="card-body" align="center">
									<h3>Por favor ingresa tu contraseña para eliminar el producto</h3>
									<div class="col-4"></div>
									<div class="col-4">
										<input type="password" name="password" placeholder="Contraseña" class="form-control" required><br>
									</div>
									<div class="col-4"></div>
									<input type="submit" name="delete" value="Aceptar" class="btn btn-danger" onclick="alertaEliminar()">
									<a href="index.php?action=products"><input type="button" name="cancelar" value="Cancelar" class="btn btn-warning"></a>
							</div>	
						</form>
						<?php
							$MVC->deleteUserController();
						?>
					</div>
				</div>

				<div clasS="col-6">
					<div class="card card-info">
		          		<div class="card-header">
		            		<label class="card-title">Informacion del Usuario</label>
		          		</div>
		          		<div align="center">
							<?php
								$MVC->userDInfoController();
							?>
						</div>
		          	</div>
		        </div>
          	</div>
		</div>
	</section>
</div>

<script type="text/javascript">
      //Funcion para escribir una alerta y validar si se desaea o no se desea eliminarlo
      function alertaEliminar(){
        var alerta = confirm("Seguro que desea eliminarlo?");
        if(alerta == false){
            event.preventDefault();
        }
      }
    </script>