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
        		<label class="card-title">Registro de Usuario</label>
        		<a href="index.php?action=users"><input type="button" name="" value="Regresar" class="btn btn-info"></a>
      		</div>
			<form method="post" role="form">
				<div class="card-body" align="center">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-4">
							<input type="text" name="firstname" placeholder="Nombre(s)" class="form-control">
						</div>
						<div class="col-4">
							<input type="text" name="lastname" placeholder="Apellido(s)" class="form-control">
						</div>
						<div class="col-2"></div>
						<br><br>
						<div class="col-2"></div>
						<div class="col-2">
							<input type="text" name="username" placeholder="Nombre de Usuario" class="form-control">
						</div>
						<div class="col-3">
							<input type="password" name="password" placeholder="Contraseña" class="form-control">
						</div>
						<div class="col-3">
							<input type="email"  name="email" placeholder="Correo electronico" class="form-control">
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
				$MVC->addUserController();
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
