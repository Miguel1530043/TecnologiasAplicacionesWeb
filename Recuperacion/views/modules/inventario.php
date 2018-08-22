<?php
	$mvc = new MvcController();
?>
<div class="row">
	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header">
				<nav class="grey">
					<a href="#" class="brand-logo">Articulos - Inventario</a>
				</nav>
			</div><br>
			
			<input type="hidden" id="title" value="Articulos">
			
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<th>Clave</th>
						<th>Descripcion</th>
						<th>Existencia</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$mvc ->showProductosInventario();
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col s1"></div>
</div>