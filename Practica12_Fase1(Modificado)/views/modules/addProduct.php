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
	            	<div class="card card-success">
	              		<div class="card-header">
	                		<label class="card-title">Registro de Producto</label>
	              		</div>
	          		</div>
	      
					<form method="post">
						<div class="card-body">
							<input type="text" name="code" placeholder="Codigo de Producto" class="form-control"></br>
							<input type="text" name="name" placeholder="Nombre del Producto" class="form-control"></br>
							<input type="date" name="date_added" placeholder="Fecha de Registro" class="form-control"></br>
							<input type="text" name="price" placeholder="Precio" class="form-control"></br>
							<input type="text" name="stock" placeholder="Cantidad" class="form-control"></br>
							<input type="text" name="category_id" placeholder="Categoria" class="form-control"></br>
							<div class="container" align="center">
								<input type="submit" name="add" value="Registrar" class="btn-lg btn-success">
							</div>
						</div>
						
					</form>
					<?php
							$MVC->addProductController();
					?>
	      		</div>
	  		</div>
		</div>
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
