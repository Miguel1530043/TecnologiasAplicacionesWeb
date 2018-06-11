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
	<div class="card card-info">
	    <div class="card-header">
	        <a href="index.php?action=stores"><b class="card-title">Tiendas</b></a>
	        <a href="index.php?action=addStore"><input type="button" name="" class="btn btn-success" value="Agregar Tienda"></a>
	    </div>
	        <!-- /.card-header -->
	    <div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
	            <thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Direccion</th>
						<th>Estado</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$MVC -> storeViewsController();
				?>
				</tbody>
	        </table>
	    </div>
	</div>
</div>