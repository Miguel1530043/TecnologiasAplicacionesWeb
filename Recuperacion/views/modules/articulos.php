<?php
$mvc = new MvcController();
?>
<div class="row">

	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header ">
				<nav class="grey">
					<a href="index.php?action=home" class="brand-logo">Articulos</a>
				</nav>
			</div><br>
			
			<input type="hidden" id="title" value="Articulos">
			
			<div align="center">
				<a class="waves-effect waves-light pink darken-4 btn modal-trigger btn btn-floating btn-large" href="#modal1"><i class="material-icons">add</i></a>
			</div>
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<th>Clave</th>
						<th>Descripcion</th>
						<th>Existencia</th>
						<th>Precio</th>
						<th>Foto del Articulo</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$mvc ->showProductsController();
					?>
		</div>
	</div>
	<div class="col s1"></div>


	<form method="post" enctype="multipart/form-data">
		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
				<nav class="pink darken-4">
					<ul >
						<li><h4>Agregar Articulo</h4></li>
					</ul>
				</nav>
						
				
  				
            	<div class="row">
                	<div class="input-field col s4">
                    	<input type="text" name="clave" required>
                    	<label for="num_empleado">Clave</label>    
                	</div>
                	<div class="input-field col s4">
                    	<input type="text" name="clave_alterna" required>
                    	<label for="clave_alterna">Clave Alterna</label>    
                	</div>
                	<div class="input-field col s4">
                        <select name="servicio">
                            <option selected disabled>Servicio</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
					<div class="input-field col s12">
						<input type="text" name="descripcion">
						<label for="descripcion">Descripcion</label>
					</div>
					<div class="input-field col s3">
						<select name="categoria">
                            <option selected disabled>Categorias</option>
                            <?php
                            	$mvc -> selectCategoriaController();
                            ?>
                        </select>
					</div>
					<div class="input-field col s3">
						<select name="departamento">
                            <option selected disabled>Departamentos</option>
                            <?php
                            	$mvc -> selectDepartamentoController();
                            ?>
                        </select>
					</div>
					<div class="input-field col s2">
						<input type="text" name="unidad_compra">
						<label for="unidad_compra">Unidad Compra</label>
					</div>
					<div class="input-field col s2">
						<input type="text" name="unidad_venta">
						<label for="unidad_venta">Unidad Venta</label>
					</div>
					<div class="input-field col s2">
						<input type="text" name="factor">
						<label for="factor">Factor</label>
					</div>
					<div class="input-field col s4">
                        <select name="iva">
                            <option selected disabled>IVA</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
					<div class="input-field col s4">
						<input type="text" name="precio_compra">
						<label for="precio_compra">Precio de Compra</label>
					</div>
					<div class="input-field col s4">
						<input type="text" name="precio_compra_promedio">
						<label for="precio_compra_promedio">Precio de Compra Promedio</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio1">
						<label for="precio1">Precio 1</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio2">
						<label for="precio2">Precio 2</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio3">
						<label for="precio3">Precio 3</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio4">
						<label for="precio4">Precio 4</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio_venta1">
						<label for="precio_venta1">Precio Venta 1</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio_venta2">
						<label for="precio_venta2">Precio Venta 2</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio_venta3">
						<label for="precio_venta3">Precio Venta3</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="precio_venta4">
						<label for="precio_venta4">Precio Venta 4</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="unidades_mayoreo1">
						<label for="unidades_mayoreo1">U. Mayoreo 1</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="unidades_mayoreo2">
						<label for="unidades_mayoreo2">U. Mayoreo 2</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="unidades_mayoreo3">
						<label for="unidades_mayoreo3">U. Mayoreo 3</label>
					</div>
					<div class="input-field col s3">
						<input type="text" name="unidades_mayoreo4">
						<label for="unidades_mayoreo4">U. Mayoreo 4</label>
					</div>
					<div class="input-field col s4">
						<label>Imagen</label><br><br>
						<input type="file" name="imagen" id="foto" class="waves-effect waves-light pink darken-4 btn-small">
						
					</div>
					<div id="verImagen" class="col s5" style="width: auto; height: auto;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="waves-effect waves-light pink darken-4 btn-small" name="add">AGREGAR</button>
			</div>
			
		</div>
	</form>	
</div>
<?php
	$mvc-> updateProductController();
	$mvc-> addProductController();
?>
