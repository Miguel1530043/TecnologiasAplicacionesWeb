<?php
	
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
	<div class="card card-info">
	    <div class="card-header">
	        <a href="index.php?action=products"><b class="card-title">Productos</b></a>
	        <?php echo '<a href="index.php?action=addProduct&id_store='.$id_store.'" class="btn btn-success">Agregar Producto</a>';?>
	    </div>
	        <!-- /.card-header -->
	    <div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
	            <thead>
					<tr>
						<th>ID</th>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Fecha de registro</th>
						<th>Precio</th>
						<th>Stock</th>
						<th>Categoria</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$MVC -> productViewsController();
				?>
				</tbody>
	        </table>
	    </div>
	</div>
</div>

