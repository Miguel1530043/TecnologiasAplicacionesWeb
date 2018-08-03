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
		<h3 style="color:gray">Sessions (Students Hours)</h3>
		<input type="hidden" id="title" value="Sessions (Students)">
		
		<table class="hover cell-border" id="example">
			<thead>
				<tr align="center">
					<th>Matricula</th>
					<th>Student</th>
					<th>Career</th>
					<th>E-Mail</th>
					<th>Total CAI Hours</th>
					<th>View All Activities</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->teacherStudentsSessionController();
				?>
	</div>
	<div class="col s1"></div>	
</div>