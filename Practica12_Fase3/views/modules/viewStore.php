<?php
	
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$id_store=$_GET["id_store"];
	$MVC = new MvcController();
?>
<div class="content-wrapper">
	<a href="index.php?action=stores" class="btn btn-info">Tiendas</a>
	<h1 class="widget-user-username"><?php  $MVC->storeInfoController(); ?></h1>
	<div class="row">
		
		<div class="col-lg-3 col-12">
			<div class="small-box bg-info">
				<div class="inner">
					<h4>Productos <label class="nav-icon fa fa-cube"></label></h4>
					<h5>Total: <?php  $MVC ->countProductController();  ?></h5>
					<?php echo '<a href="index.php?action=products&id_store='.$id_store.'" class="btn btn-secondary">Ver</a>';?>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-success">
				<div class="inner">
					<h4>Usuarios <label class="nav-icon fa fa-user"></label></h4>
					<h5>Total: <?php $MVC -> countUserController();?></h5>
					<?php echo '<a href="index.php?action=users&id_store='.$id_store.'" class="btn btn-secondary">Ver</a>';?>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-danger">
				<div class="inner">
					<h4>Categorias <label class="nav-icon fa fa-tag"></label></h4>
					<h5>Total: <?php $MVC -> countCategoryController();?></h5>
					<?php echo '<a href="index.php?action=categories&id_store='.$id_store.'" class="btn btn-secondary">Ver</a>';?>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-warning">
				<div class="inner">
					<h4>Movimientos <label class="nav-icon fa fa-book"></label></h4>
					<h5>Total: <?php $MVC-> countHistorialController();  ?></h5>
				</div>
			</div>
		</div>
	</div>
</div>


