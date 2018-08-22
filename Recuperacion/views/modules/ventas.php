<?php
$mvc = new MvcController();
?>
<div class="row">

	<div class="col s1"></div>
	<div class="col s10">
		<div  class="card">
			<div class="card-header ">
				<nav class="grey">
					<a href="#" class="brand-logo">Ventas</a>
				</nav>
			</div><br>
			
			<input type="hidden" id="title" value="Ventas">
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<th>ID</th>
						<th>FECHA</th>
						<th>TOTAL</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$mvc ->verVentas();
					?>
					</tbody>
				</table>
			
		</div>
	</div>
	<div class="col s1"></div>
</div>
