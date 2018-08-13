
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
		<h3 style="color:gray">Groups</h3>
		<input type="hidden" id="title" value="Groups">
		<?php
       if($_SESSION["user"]=="admin"){
    ?>
		<a class="waves-effect waves-light blue darken-4 btn modal-trigger btn btn-floating btn-large" href="#modal1"><i class="material-icons">add</i></a>

		<table class="hover cell-border" id="example">
			
      <thead>
				<tr align="center">
					<th>Id</th>
					<th>Name</th>
					<th>Level</th>
					<th>Teacher</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		  <?php
          $mvc ->showGroupsController();
        }else{
      ?>
      <table class="hover cell-border" id="example">
        <thead>
				<tr align="center">
					<th>Id</th>
					<th>Name</th>
					<th>Level</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
      <?php 
           $mvc ->showTeachersGroupsController();
        }
		  ?>
      </tbody>
        </table>
	</div>
	<div class="col s1"></div>

	<form method="post" enctype="multipart/form-data">
		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
  				<h4>Add Group</h4>
            	<div class="row">
					<div class="input-field col s12">
						<input type="text" name="nombre_grupo">
						<label for="nombre_grupo">Name</label>
						<br>
						<br><br>
						
					</div>

					<div class="input-field col s6">
						<select name="nivel">
							<option value="" disabled selected>Select English Level</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<label>Level</label>
					</div>

					<div class="input-field col s6">
						<select name="teacher">
							<option disabled selected> Select Teacher</option>
							<?php
								$mvc->selectTeacher();
							?>
						</select>
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
	$mvc-> updateGroupController();
	$mvc-> addGroupController();
?>
