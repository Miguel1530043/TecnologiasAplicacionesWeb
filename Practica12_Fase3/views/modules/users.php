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
	<div class="card card-info">
	    <div class="card-header">
	        <label class="card-title">Usuarios</label>
	        <a href="index.php?action=addUser"><input type="button" name="" class="btn btn-success" value="Registrar Usuario"></a>
	    </div>
	        <!-- /.card-header -->
	    <div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
	            <thead>
					<tr>
						<th>ID</th>
						<th>Nombre(s)</th>
						<th>Apellido(s)</th>
						<th>Usuario</th>
						<th>E-mail</th>
						<th>Fecha de Registro</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$MVC -> userViewController();
				?>
				</tbody>
	        </table>
	    </div>
	</div>
</div>

