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
	    <div class="container-fluid">
          <!-- left column -->
            <!-- general form elements -->
        	<div class="card card-primary">
          		<div class="card-header">
            		<label class="card-title">Editar Producto</label>
            		<a href="index.php?action=products" class="btn btn-secondary">Regresar</a>
          		</div>
      		
				<form method="post" role="form">
					<div class="card-body">
						<div class="row">
							<?php
								$MVC ->editProductController();
								$MVC -> updateProductController();
							?>
						</div>	
					</div>	
				</form>
			</div>
		</div>
	</section>
</div>