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
	<h2>Dashboard</h2>
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="card card-widget widget-user">
			  	<div class="widget-user-header bg-info-active" >
			    	<h3 class="widget-user-username"><?php  $MVC->userInfoController(); ?></h3>
			  	</div>
			  	<div class="widget-user-image">
			    	<img class="img-circle elevation-2" src="views/dist/img/user.png" alt="User Avatar">
			  	</div>
			  	<div class="card-footer">
			    	<div class="row">
			    	 	<div class="col-sm-12 border-right">
			        		<div class="description-block">
			          			<h5 class="description-header"><?php  $MVC-> viewUserHistorialController();?></h5>
			          			<span class="description-text">Movimientos Realizados</span>
			        		</div>
			        <!-- /.description-block -->
			      		</div>
			      <!-- /.col -->
			      <!-- /.col -->
			    	</div>
			    <!-- /.row -->
			  	</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-info">
				<div class="inner">
					<h4>Productos <label class="nav-icon fa fa-cube"></label></h4>
					<h5>Total: <?php  $MVC ->countProductController();  ?></h5>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-success">
				<div class="inner">
					<h4>Usuarios <label class="nav-icon fa fa-user"></label></h4>
					<h5>Total: <?php $MVC -> countUserController();?></h5>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-12">
			<div class="small-box bg-danger">
				<div class="inner">
					<h4>Categorias <label class="nav-icon fa fa-tag"></label></h4>
					<h5>Total: <?php $MVC -> countCategoryController();?></h5>
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


