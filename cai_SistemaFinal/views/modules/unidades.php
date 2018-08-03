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
		<h3 style="color:gray">Units</h3>
		<input type="hidden" id="title" value="Units">
			
		
		<table class="hover cell-border" id="example">
			<thead>
				<tr align="center">
					<th>Unit</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$mvc ->showUnitsController();
				?>
	</div>
	<div class="col s1"></div>

	<form method="post" enctype="multipart/form-data">
		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
  				<h4>Add Student</h4>
            	<div class="row">
                	<div class="input-field col s12">
                    	<input type="text" name="matricula" required>
                    	<label for="matricula">Matricula</label>    
                	</div>
					<div class="input-field col s6">
						<input type="text" name="nombre_alumno">
						<label for="nombre_alumno">Name</label>
					</div>
					<div class="input-field col s6">
						<input type="text" name="apellidos_alumno">
						<label for="apellidos_alumno">Last Name</label>
					</div>

					<div class="input-field col s6">
						<select name="carrera">
							<option value='' disabled selected>Select a carrer</option>
							<option value="Ingenieria en Tecnologias de la Informacion">Ingenieria en Tecnologias de la Informacion</option>
							<option value="Ingenieria en Tecnologias de la Manufactura">Ingenieria en Tecnologias de la Manufactura</option>
							<option value="Ingenieria en Mecatronica">Ingenieria en Mecatronica</option>
							<option value="Ingenieria en Sistemas Automotries">Ingenieria en Sistemas Automotries</option>
							<option value="Licenciatura en Gestion y Administracion de Pequeñas y Medianas Empresas">Licenciatura en Gestion y Administracion de Pequeñas y Medianas Empresas</option>
						</select>
						<label for="carrera">Carrer</label>
					</div>
					<div class="input-field col s6">
						<select name="grupo">
						<option  disabled selected>Select a group</option>
							<?php
								$mvc->selectGroupController();
							?>
						</select>
					</div>
					<div class="input-field col s12">
						<label>E-Mail</label>
						<input type="text" name="email">
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="waves-effect waves-light btn-small" name="add">Add</button>
			</div>
			
		</div>
	</form>


	<div id="modal2" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Are you sure you want to delete this teacher?</h4>
		</div>
		<div class="modal-footer">
			<button type="submit" class="waves-effect waves-light red darken-4 btn-small modal-close" name="add">No</button>
			<button type="submit" class="waves-effect waves-light blue darken-4 btn-small" name="add">Yes</button>
		</div>
	</div>
		
</div>
<?php
	$mvc-> updateStudentController();
	$mvc-> addStudentController();
?>
