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
		<h3 style="color:gray">Sessions (Details)</h3>
		<input type="hidden" id="title" value="Sessions (Details)">
		<table class="display" id="example">
			<thead>
				<tr align="center">
					<th>Activity</th>
					<th>Unit</th>
					<th>Date</th>
					<th>Start Hour</th>
					<th>End Hour</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->studentHoursDetailController();
				?>
	</div>
	<div class="col s1"></div>	
</div>