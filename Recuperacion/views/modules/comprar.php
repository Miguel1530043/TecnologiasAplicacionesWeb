<?php
	$mvc = new MvcController();
	$mvc -> agregarCompra();
	$mvc -> cancelarCompra();
	$mvc -> terminarCompra();


?>
<div class="row">
	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header ">
				<nav class="grey">
					<a href="#" class="brand-logo">Compras</a>
				</nav>
			</div><br>
			<div class="row">
				<form method="post">
					<div class="col s1"></div>
					<div class="col s5">
						<label style="font-size:10px">Seleccione un Articulo</label>
						<select name="articulo">
							<option selected disabled>Articulos</option>
							<?php
								$mvc->selectProductosController();
							?>
						</select>
					</div>
					<div class="input-field col s4">
						
                    	<label for="cantidad">Cantidad</label> 
						<input type="number" name="cantidad"></div>
					<div class="col s2">
						<br>
						<input type="submit" name="agregar" class="btn" value="Agregar">
						<input type="submit" name="cancelar" class="btn red" value="Cancelar">
					</div>
				

				<div class="col s12">

				<?php
					$mvc->mostrarCompra();
				?>
				</div>
				</form>
				
			</div>
		</div>
	</div>
	<div class="col s1"></div>
</div>