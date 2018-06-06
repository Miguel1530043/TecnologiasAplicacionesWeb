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
	        <label class="card-title">Categorias</label>
	        <a href="index.php?action=addCategory"><input type="button" name="" class="btn btn-success" value="Agregar Categoria"></a>
	    </div>
	        <!-- /.card-header -->
	    <div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
	            <thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Fecha de Registro</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$MVC -> categoryViewController();
				?>
				</tbody>
	        </table>
	    </div>
	</div>
</div>

