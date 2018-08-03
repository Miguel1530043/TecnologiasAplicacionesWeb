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
		<h3 style="color:gray">Sessions (Teacher's groups)</h3>
				<input type="hidden" id="title" value="Sessions (Teacher's groups)">
			

		<table class="hover cell-border" id="example">
			<thead>
				<tr align="center">
					<th>Group</th>
					<th>Level</th>
					<th>View Students Sessions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->teacherSessionsController();
				?>
	</div>
	<div class="col s1"></div>	
</div>