<?php
$mvc = new MvcController();
?>
<div class="row">

	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header ">
				<nav class="grey">
					<a href="#" class="brand-logo">Venta - Detalles</a>
				</nav>
			</div><br>
			
			<input type="hidden" id="title" value="Ventas">
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<TH></TH>
						<th>ID</th>
						<th>CLAVE</th>
						<th>NOMBRE</th>
						<TH>CANTIDAD</TH>
						<TH>PRECIO</TH>
					</tr>
				</thead>
				<tbody>
					<?php
						$mvc ->verDetalleVenta();
					?>
					</tbody>
				</table>
			
		</div>
	</div>
	<div class="col s1"></div>
</div>
