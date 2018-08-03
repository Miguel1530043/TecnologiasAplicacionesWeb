<?php
$mvc = new MvcController();
	if(!isset($_SESSION["user"])){
		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
	
?>
<div class="row">
	<div class="col s1"></div>
	<div class="col s10" align="center">
		<h3 style="color:gray">Sessions (Teachers)</h3>
		<input type="hidden" id="title" value="Sessions (Teachers)">
			

		<table class="hover cell-border" id="example">
			<thead>
				<tr align="center">
					<th>Teacher</th>
					<th>View Groups</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->sessionsController();
				?>
	</div>
	<div class="col s1"></div>	
</div>

