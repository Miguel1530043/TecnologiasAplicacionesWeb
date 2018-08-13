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
		<h3 style="color:gray">Teachers</h3>
		<input type="hidden" id="title" value="Teachers">
			
		<a class="waves-effect waves-light blue darken-4 btn modal-trigger btn btn-floating btn-large" href="#modal1"><i class="material-icons">person_add</i></a>

		<table class="hover cell-border" id="example">
			<thead>
				<tr align="center">
					<th>Employee Id</th>
					<th>Name</th>
					<th>Last Name</th>
					<th>E-Mail</th>
					<th>Photo</th>
					<th>Phone Number</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->showTeachersController();
				?>
	</div>
	<div class="col s1"></div>

	<form method="post" enctype="multipart/form-data">
		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
  				<h4>Add Teacher</h4>
            	<div class="row">
                	<div class="input-field col s12">
                    	<input type="text" name="num_empleado" required>
                    	<label for="num_empleado">Employee Id</label>    
                	</div>
					<div class="input-field col s6">
						<input type="text" name="nombre_teacher">
						<label for="nombre_teacher">Name</label>
					</div>
					<div class="input-field col s6">
						<input type="text" name="apellidos_teacher">
						<label for="apellidos_teacher">Last Name</label>
					</div>

					<div class="input-field col s6">
						<input type="email" name="email">
						<label for="email">E-Mail</label>
					</div>
					<div class="input-field col s6">
						<input type="password" name="password">
						<label for="password">Password</label>
					</div>
					<div class="input-field col s7">
						<label>Photo</label><br><br>
						<input type="file" name="foto" id="foto" class="waves-effect waves-light btn-small">
						
					</div>
					<div id="verImagen" class="col s5" style="width: auto; height: auto;"></div>
					<div class="input-field col s5">
						<input type="text" name="telefono">
						<label for="telefono">Phone</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="waves-effect waves-light btn-small" name="add">Add</button>
			</div>
			
		</div>
	</form>


	
		
</div>
<?php
	$mvc-> updateTeacherController();
	$mvc-> addTeacherController();
?>
