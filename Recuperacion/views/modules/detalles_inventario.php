<?php
	$mvc= new MvcController();
	$mvc->operacionesInventarioController();
?>
<div class="row">
	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header ">
				<nav class="grey">
					<a href="index.php?action=home" class="brand-logo">Articulos - Inventario</a>
				</nav>
			</div>
			<br>
			<div class="row">
				<form method="post">
					<div class="col s1"></div>
					<?php
						$mvc->inventarioController();
					?>
					<div class="col s3" align="center">
						<input type="number" name="cantidad" class="form-control" placeholder="Cantidad" min="1" required><br>
						<textarea class="form-control" placeholder="Nota" name="comentario" required></textarea><br>
						<input type="text" name="referencia" class="form-control" placeholder="Referencia" required><br>
			
						<input type="submit" name="addStock" class="btn btn-info" value="Agregar al Stock"><br><br>
						<input type="submit" name="removeStock" class="btn btn-warning" value="Remover de Stock"><br><br>
			
					</div>
					
				</form>
			</div>
			<a class='dropdown-trigger pink darken-4 btn-large' href='#' style="width:1103px">Historial de Inventario</a>
			<table class="hover cell-border responsive" id="example">
					<thead>
						<tr align="center">
							<th>id</th>
							<th>Clave</th>
							<th>Descripcion</th>
							<th>Referencia</th>
							<th>Comentario</th>
							<th>Cantidad</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$mvc ->showProductoInventarioController();
						?>
					</tbody>
				</table>
			
			
		</div>
	</div>
	<div class="col s1"></div>
</div>

