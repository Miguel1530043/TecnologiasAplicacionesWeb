<?php

	$MVC = new MvcController();

?>

<div class="container">
	<section class="content">
	    <div class="container-fluid">
	        <div class="row">
	          <!-- left column -->
	          	<div class="col-md-12">
	            <!-- general form elements -->
	            	<div class="card card-primary">
	              		<div class="card-header">
	                		<label class="card-title">Editar Producto</label>
	              		</div>
	          		</div>
					<form method="post">
						<?php
							$MVC ->editProductController();
							$MVC -> updateProductController();
						?>		
					</form>
				</div>
			</div>
		</div>
	</section>
</div>