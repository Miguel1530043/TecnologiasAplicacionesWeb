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
	            	<div class="card card-info">
	              		<div class="card-header">
	                		<label class="card-title">Productos</label>
	                		<a href="index.php?action=addProduct"><input type="button" name="add" Value="+" class="btn btn-success"></a>
	              		</div>
	          		</div>
	          		<div class="card-body">
	          		
					<table class="table table-bordered table-hover" id="t1" style="background-color:white">
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
