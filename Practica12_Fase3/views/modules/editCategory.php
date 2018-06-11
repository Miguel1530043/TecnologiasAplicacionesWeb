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
            		<label class="card-title">Editar Categoria</label>
            		<a href="index.php?action=categories"><input type="button" name="" value="Regresar" class="btn btn-secondary"></a>
          		</div>
      		
				<form method="post" role="form">
					<div class="card-body">
						<div class="row">
							<?php
								$MVC ->editCategoryController();
								$MVC -> updateCategoryController();
							?>
						</div>	
					</div>	
				</form>
			</div>
		</div>
	</section>
</div>