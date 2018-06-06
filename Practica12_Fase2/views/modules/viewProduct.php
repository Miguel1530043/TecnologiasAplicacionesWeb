<?php
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$MVC = new MvcController();
	$MVC->addHistorialController();
?>

<div class="content-wrapper" >
	<section class="content">
	    <div class="container-fluid">
        	<div class="row">
        		<div class="col-12">
        			<div class="card card-info">
          				<div class="card-header">
            				<label class="card-title">Producto</label>
            				<a href="index.php?action=products"><input type="button" name="" value="Regresar" class="btn btn-secondary"></a>
          				</div>
						
						<div class="card-body">
							<form method="post">
								<div class="row">
									<div class="col-3">
										<br>
										<img src="views/dist/img/box.png" style="height:250px;width: 250px;">
									</div>
									<div class="col-3">
										<?php
											$MVC->userController();
											$MVC ->productController();
										?>	
									</div>
									<div class="col-3" align="center">
										
											<br>

											<input type="number" name="quantity" class="form-control" placeholder="Cantidad" min="1" required><br>
											<textarea class="form-control" placeholder="Nota" name="note" required></textarea><br>
											<input type="text" name="reference" class="form-control" placeholder="Referencia" required><br>
									</div>
									<div class="col-3" align="center">
											<br><br><br>
											<input type="submit" name="addStock" class="btn btn-info" value="Agregar al Stock"><br><br>
	        								<input type="submit" name="removeStock" class="btn btn-warning" value="Remover de Stock"><br><br>
	        							
									</div>
								</div>	
							</form>			
						</div>	
					</div>	
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-12">
        			<div class="card card-info">
        				<div class="card-header">
        					<label>Inventario - Movimientos del Producto</label>
        				</div>
	        			<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
		            			<thead>
									<tr>
										<th>ID</th>
										<th>ID Producto</th>
										<th>Nombre del Producto</th>
										<th>ID Usuario</th>
										<th>Nombre Usuario</th>
										<th>Fecha de Movimiento</th>
										<th>Nota</th>
										<th>Referencia</th>
										<th>Cantidad</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$MVC -> viewProductHistorialController();
								?>
								</tbody>
		        			</table>
		    			</div>
	    			</div>
        		</div>
        		
        	</div>
		</div>
	</section>
</div>