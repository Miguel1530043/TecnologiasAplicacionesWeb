<?php
	class MvcController{

		//Controlador para incluir el template en el index y mostrarlo en todas las paginas
		public static function page(){
      session_start();
			include "views/template.php";
		}

		//Controlador que llevara a cabo el mandejo de las direcciones de las paginas mediante acciones
		public static function linkPageController(){
			if(isset($_GET["action"])){
				$link = $_GET["action"];
			}else{
				$link = "index";
			}
			$answer = Pages::linkPageModel($link);
			include $answer;
		}

		//Funcion que permite el login de un usuario dependiendo si el email y el password que se ingresen son iguales a alguno de los registros de la base de datos
		public static function loginController(){
			if(isset($_POST["login"])){//Se condiciona si se utilizo el boton de nombre "login"

				//Se hace el llenado de un arreglo con los datos que se ingresaron en el login
				$data = array( "email"=>$_POST["email"], "password"=>$_POST["password"]);
				
				//Los datos del arreglo se mandan como parametros en el modelo del login y la table user
				$answer = Data::loginModel($data, "teachers");
				
				//Se condiciona que si los datos ingresados en el login coinciden con los de algun usuario de la base de datos se inicie la sesion
				if($answer["email"] == $_POST["email"] && $answer["email"]!="admin@admin.com" && $answer["password"] == $_POST["password"] && $answer["password"]!="admin"){
					//session_start();
					$_SESSION['user'] = $answer["num_empleado"];//A la variable de sesion se le asigna el valor del id del usuario que ingreso
					//Al iniciar la sesion se redirecciona al dashboard
					echo"<script>
						window.location='index.php?action=home';
					</script>";
				}else if($_POST["email"] == "admin@admin.com" && $_POST["password"] == "admin"){
         $_SESSION['user'] = "admin";//A la variable de sesion se le asigna el valor del id del usuario que ingreso
					//Al iniciar la sesion se redirecciona al dashboard
					echo"<script>
						window.location='index.php?action=home';
					</script>";
        }
			}
		}

		

		###############################################################################################################################
		############################################################ TEACHERS #########################################################
		###############################################################################################################################

		

		public static function showTeachersController(){
			$answer = Data::showTeachersModel("teachers");
			foreach ($answer as $row => $teacher) {
				
				echo'
					<tr>
						<td>'.$teacher['num_empleado'].'</td>
						<td>'.$teacher['nombre_teacher'].'</td>
						<td>'.$teacher['apellidos_teacher'].'</td>
						<td>'.$teacher['email'].'</td>';

						if($teacher["foto"]=="views/img/" || $teacher["foto"]==""){
							echo'<td><button class="btn" disabled><i class="material-icons">person_outline</i></button></td>';
						}else{
							echo'<td><img class="materialboxed" src="'.$teacher['foto'].'" style="height:50px;width:50px"></td>';
						}
					echo '<td>'.$teacher['telefono'].'</td>
						<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="#'.$teacher["num_empleado"].'"><i class="material-icons">edit</i></a></td>
						<td><a class="btn-floating btn-large waves-effect waves-light red darken-4 btn modal-trigger" href="#delete'.$teacher["num_empleado"].'"><i class="material-icons" >delete</i></a></td>
					</tr>

					<div id="delete'.$teacher["num_empleado"].'" class="modal modal-fixed-footer" style="height:270px">
						<div class="modal-content">
							<h4>Are you sure you want to delete this teacher?</h4><br>
							<button class="waves-effect waves-light red darken-4 btn-large modal-close">No</button>
							<a class="waves-effect waves-light blue darken-4 btn-large" href="index.php?action=eliminarTeacher&num_empleado='.$teacher["num_empleado"].'">Yes</a>
						</div>

					</div>
				';
			}
			echo "</tbody>
				</table>";
			foreach ($answer as $row => $teacher) {
				MvcController::editTeacherController($teacher["num_empleado"]);

			}
		}

		public static function addTeacherController(){
			if(isset($_POST["add"])){
					
					$target_dir = "views/img/";
					$target_file = $target_dir . basename($_FILES["foto"]["name"]);
					$uploadOk = 1;
					// Check if file already exists

	    			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
	    				$ruta = basename($_FILES["foto"]["name"]);
	        			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    			} else {
	        			echo "Sorry, there was an error uploading your file.";
	    			}

				$data = array("num_empleado"=>$_POST["num_empleado"],"nombre_teacher"=>$_POST["nombre_teacher"], "apellidos_teacher"=>$_POST["apellidos_teacher"],"email"=>$_POST["email"],"password"=>$_POST["password"], "foto"=>$target_file, "telefono"=>$_POST["telefono"]);
				$answer = Data::addTeacherModel($data,"teachers");
				var_dump($answer);
				if($answer=="success"){
					echo "<script>
						window.location='index.php?action=teachers';
					</script>";
				}else{
					echo "Error al registrar";
				}
			}
		}


		

		public static function deleteTeacherController(){
			$data = $_GET["num_empleado"];
			$answer= Data::deleteTeacherModel($data,"teachers");
			if($answer == "success"){
				echo "<script>
					window.location='index.php?action=teachers';
				</script>";
			}else{
				echo "Error al Eliminar";
			}
		}

		public static function editTeacherController($data){
			$answer = Data::editTeacherModel($data,"teachers");
			echo'
			<form method="post" enctype="multipart/form-data">
				<div id="'.$answer["num_empleado"].'" class="modal modal-fixed-footer">
					<div class="modal-content">
					<h4>Info</h4>
						<div class="row">
		                	<div class="input-field col s12">
		                    	<input type="hidden" name="num_empleado" value="'.$answer['num_empleado'].'">
		                    	    
		                	</div>
							<div class="input-field col s6">
								<input type="text" name="nombre_teacher" value="'.$answer['nombre_teacher'].'">
								<label for="nombre_teacher">Name</label>
							</div>
							<div class="input-field col s6">
								<input type="text" name="apellidos_teacher" value="'.$answer['apellidos_teacher'].'">
								<label for="apellidos_teacher">Last Name</label>
							</div>

							<div class="input-field col s6">
								<input type="email" name="email" value="'.$answer['email'].'">
								<label for="email">E-Mail</label>
							</div>
							<div class="input-field col s6">
								<input type="password" name="password" value="'.$answer['password'].'">
								<label for="password">Password</label>
							</div>
							<div class="input-field col s7">
								<label>Photo</label><br><br>
								<input type="file" name="foto" class="waves-effect waves-light btn-small">
							</div>
							<div class="input-field">
								<input type="hidden" name="fotoActual" value="'.$answer['foto'].'">
							</div>
							<div class="col s5"><img src="'.$answer['foto'].'" style="width:150px;height:150px"></div>
							<div id="verImagenEdit" class="col s5" style="width: auto; height: auto;"></div>
							<div class="input-field col s5">
								<input type="text" name="telefono" value="'.$answer['telefono'].'">
								<label for="telefono">Phone</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="waves-effect waves-light blue darken-4 btn-small" name="update">Update Information</button>
					</div>
				</div>
			</form>
			';

		}

		public static function updateTeacherController(){
			if(isset($_POST["update"])){
				if($_FILES["foto"]["name"]!=null){
					$target_dir = "views/img/";
					$target_file = $target_dir . basename($_FILES["foto"]["name"]);
					$uploadOk = 1;
					// Check if file already exists
		    		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
		    			$ruta = basename($_FILES["foto"]["name"]);
		        		//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    		} else {
		        		echo "Sorry, there was an error uploading your file.";
		    		}
		    	}else{
		    		$target_file = $_POST["fotoActual"];
		    	}
	    	

				$data = array("nombre_teacher"=>$_POST["nombre_teacher"],"apellidos_teacher"=>$_POST["apellidos_teacher"],"email"=>$_POST["email"],"password"=>$_POST["password"], "foto"=>$target_file, "telefono"=>$_POST["telefono"],"num_empleado"=>$_POST["num_empleado"]);
				
				$answer = Data::updateTeacherModel($data, "teachers");

				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=teachers';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
				var_dump($data);

			}

		}


		#########################################################################################################################3
		##########################################################################################################################
		###########################################################################################################################

		//Metodo para poder visualizar el nombre de los grupos en un select y que en cada opcion el valor contenga el id del grupo
		public static function selectTeacher(){
			$answer = Data::showTeachersModel("teachers");
			foreach ($answer as $row => $teacher) {
				echo "<option value='$teacher[num_empleado]'>".$teacher['nombre_teacher']."</option>";
			}
		}			

		//Metodo para poder visualizar el nombre de los grupos en un select y que en cada opcion el valor contenga el id del grupo
		public static function selectGroupController(){
			$answer = Data::selectGroupModel("grupos");
			foreach ($answer as $row => $group) {
				echo '<option value="'.$group['id_grupo'].'">'.$group['nombre_grupo'].'</option>';
			}
		}

		//Metodo para poder visualizar el nombre de las alumnas en un select y que en cada opcion el valor contenga el id de la alumna
		public static function selectStudent(){
			$answer = Data::showStudentsModel("alumnas","grupo");
			foreach ($answer as $row => $student) {
				echo "<option value='$student[id_alumna]'>".$student['nombre']." ".$student['apellidos']."</option>";
			}
		}

		

		############################################################################################################################################################3
		###########3##################################################### GRUPOS CONTROLLER !$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$#
		#############################################################################################################################################################

		//Metodo que mostrara todos  los grupos que se encuentran dentro de la base de datos, mediante una table
		public static function showGroupsController(){
			$answer = Data::showGroupsModel("grupos","teachers");
			foreach ($answer as $row => $group) {
				echo'
					<tr>
						<td>'.$group['id_grupo'].'</td>
						<td>'.$group['nombre_grupo'].'</td>
						<td>'.$group['nivel'].'</td>
						<td>'.$group['nombre_teacher'].'</td>
						<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="#'.$group["id_grupo"].'"><i class="material-icons">edit</i></a></td>
						<td><a class="btn-floating btn-large waves-effect waves-light red darken-4 btn modal-trigger" href="#delete'.$group["id_grupo"].'"><i class="material-icons" >delete</i></a></td>
					</tr>

					<div id="delete'.$group["id_grupo"].'" class="modal modal-fixed-footer" style="height:270px">
						<div class="modal-content">
							<h4>Are you sure you want to delete this teacher?</h4><br>
							<button class="waves-effect waves-light red darken-4 btn-large modal-close">No</button>
							<a class="waves-effect waves-light blue darken-4 btn-large" href="index.php?action=eliminarGrupo&id_grupo='.$group["id_grupo"].'">Yes</a>
						</div>
					</div>
				';
			}
			echo "</tbody>
				</table>";
			foreach ($answer as $row => $group) {
				MvcController::editGroupController($group["id_grupo"]);

			}
		}
    
    public static function showTeachersGroupsController(){
      $data=$_SESSION["user"];    
			$answer = Data::showTeachersGroupsModel($data,"grupos");
			foreach ($answer as $row => $group) {
				echo'
					<tr>
						<td>'.$group['id_grupo'].'</td>
						<td>'.$group['nombre_grupo'].'</td>
						<td>'.$group['nivel'].'</td>
            <td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="#3'.$group["id_grupo"].'"><i class="material-icons">assignment</i></a></td>
					</tr>
          <div id="3'.$group["id_grupo"].'" class="modal modal-fixed-footer" style="height:270px">
					  <div class="modal-content">
              <div class="row">
                <div class="col s3">
                  <h6>Matricula<h6>
                </div>
                <div class="col s2">
                  <h6>Name<h6>
                </div>
                <div class="col s2">
                  <h6>Carrer<h6>
                </div>
                <div class="col s2">
                  <h6>Email<h6>
                </div>
                <div class="col s3">
                  <h6>CAI Hours<h6>
                </div>
               </div>';

					      $answer2 = Data::showStudentsGroupModel($group["id_grupo"],"alumnos");
                foreach($answer2 as $row => $student){
                   echo'
                   <div class="row">
                     <div class="col s3" align="center">
                       <h6 style="color:gray">'.$student["matricula"].'<h6>
                     </div>
                     <div class="col s2">
                       <h6 style="color:gray">'.$student["nombre_alumno"].' '.$student["apellidos_alumno"].'<h6>
                     </div>
                     <div class="col s2">   
                       <h6 style="color:gray">'.$student["carrera"].'<h6>
                     </div>
                     <div class="col s2">
                       <h6 style="color:gray">'.$student["email"].'<h6>
                     </div>
                     <div class="col s3">
                       <h6 style="color:gray">0<h6>
                     </div>
                   </div>';
                  
                }
            echo'
            </div>
					</div>';
        
			}
			echo '</tbody>
				</table>';

		}
    

		//Metodo para acer la insercion de un grupo en la base de datos, utilizando el modelo de addGroupModel, ppara realizar la consulta en la base de datos e insertar un nuevo grupo
		public static function addGroupController(){
			if(isset($_POST["add"])){
				$data = array("nombre_grupo"=>$_POST["nombre_grupo"], "nivel"=>$_POST["nivel"],"teacher"=>$_POST["teacher"]);
				$answer = Data::addGroupModel($data,"grupos");
				var_dump($data);
				if($answer=="success"){
					echo "<script>
						window.location='index.php?action=grupos';
					</script>";
				}else{
					echo "Error al registrar";
				}
			}
		}
		//Metodo del controlador para tomar el id del grupo y mandarlo al modelo para realizar la eliminacion en la base de datos
		public static function deleteGroupController(){
			$data = $_GET["id_grupo"];
			$answer = Data::deleteGroupModel($data,"grupos");
			if($answer == "success"){
				echo "<script>
					window.location='index.php?action=grupos';
				</script>";
			}else{
				echo"Error al quitar el grupo";
			}
		}
		
		//Metodo que mediante el uso del modelo editGroupModel, la extraccion de los datos de la base de datos dependiendo del id del grupo que se tenga y se imprimiran dichos datos para poder visualizarlos y poder editarlos
		public static function editGroupController($data){
			$answer = Data::editGroupModel($data,"grupos","teachers");
			echo'
			<form method="post" enctype="multipart/form-data">
				<div id="'.$answer["id_grupo"].'" class="modal modal-fixed-footer">
					<div class="modal-content">
					<h4>Info</h4>
						<div class="row">
		                	<div class="input-field col s12">
		                    	<input type="hidden" name="id_grupo" value="'.$answer['id_grupo'].'">
		                	</div>
							<div class="input-field col s12">
								<input type="text" name="nombre_grupo" value="'.$answer['nombre_grupo'].'">
								<label for="nombre_grupo">Name</label>
							</div>
							<div class="input-field col s6">
								<select name="nivel">
									<optgroup label="Current Level">
										<option value="'.$answer["nivel"].'">'.$answer["nivel"].'</option>
									</optgroup>
									<optgroup label="All Levels">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
									</optgroup>
								</select>
								<label>Level</label>
							</div>

							<div class="input-field col s6">
								<select name="teacher">

									<optgroup label="Current Teacher">
										<option value="'.$answer['num_empleado'].'">'.$answer["nombre_teacher"].'</option>	
									</optgroup>
									<optgroup label="All Teachers">';

										MvcController::selectTeacher();

									echo '</optgroup>

								</select>
								<label>Teacher</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="waves-effect waves-light blue darken-4 btn-small" name="update">Update Information</button>
					</div>
				</div>
			</form>
			';
		}
		//Este metodo utilizara los datos que se encuentren dentro del metodo editGroupController, ya que son lo que se utilizaran para hacer la modificacion del grupo
		public static function updateGroupController(){

			if(isset($_POST["update"])){

				$data = array("id_grupo"=>$_POST["id_grupo"],"nombre_grupo"=>$_POST["nombre_grupo"],"teacher"=>$_POST["teacher"]);
				$answer = Data::updateGroupModel($data, "grupos");
				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=grupos';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
			}
		}

		###################################################################################################################
		################################################## STUDENTS CONTROLLER ############################################
		###################################################################################################################

		public static function showStudentsController(){
			$answer = Data::showStudentsModel("alumnos","grupos");
			foreach ($answer as $row => $student) {
				echo'
					<tr>
						<td>'.$student['matricula'].'</td>
						<td>'.$student['nombre_alumno'].'</td>
						<td>'.$student['apellidos_alumno'].'</td>
						<td>'.$student['email'].'</td>
						<td>'.$student['carrera'].'</td>
						<td>'.$student['nombre_grupo']." - Level ".$student["nivel"].'</td>
						<td>'.$student['nombre_teacher'].' '.$student["apellidos_teacher"].'</td>
						
						<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="#'.$student["matricula"].'"><i class="material-icons">edit</i></a></td>
						<td><a class="btn-floating btn-large waves-effect waves-light red darken-4 btn modal-trigger" href="#delete'.$student["matricula"].'"><i class="material-icons" >delete</i></a></td>
					</tr>

					<div id="delete'.$student["matricula"].'" class="modal modal-fixed-footer" style="height:270px">
						<div class="modal-content">
							<h4>Are you sure you want to delete this teacher?</h4><br>
							<button class="waves-effect waves-light red darken-4 btn-large modal-close">No</button>
							<a class="waves-effect waves-light blue darken-4 btn-large" href="index.php?action=eliminarAlumno&matricula='.$student["matricula"].'">Yes</a>
						</div>
					</div>
				';
			}
			echo "</tbody>
				</table>";
			foreach ($answer as $row => $group) {
				MvcController::editStudentController($student["matricula"]);

			}
		}

		public static function addStudentController(){
			if(isset($_POST["add"])){
				$data = array("matricula"=>$_POST["matricula"], "nombre_alumno"=>$_POST["nombre_alumno"],"apellidos_alumno"=>$_POST["apellidos_alumno"],"carrera"=>$_POST["carrera"],"grupo"=>$_POST["grupo"],"email"=>$_POST["email"]);
				$answer = Data::addStudentModel($data,"alumnos");
				if($answer=="success"){
					echo "<script>
						window.location='index.php?action=alumnos';
					</script>";
				}else{
					var_dump($data);
					echo "Error al registrar";
				}
			}
		}

		public static function deleteStudentController(){
			$matricula = $_GET["matricula"];
			$answer = Data::deleteStudentModel($matricula,"alumnos");
			if($answer == "success"){
				echo "<script>
						window.location='index.php?action=alumnos';
					</script>";
			}else{
				echo "Error al eliminar";
			}
		}

		public static function editStudentController($data){
			$answer = Data::editStudentModel($data,"alumnos","grupos");
			echo'
			<form method="post" enctype="multipart/form-data">
				<div id="'.$answer["matricula"].'" class="modal modal-fixed-footer">
					<div class="modal-content">
					<h4>Info</h4>
						<div class="row">
		                	<div class="input-field col s12">
		                    	<input type="hidden" name="matricula" value="'.$answer['matricula'].'">
		                	</div>
							<div class="input-field col s6">
								<input type="text" name="nombre_alumno" value="'.$answer['nombre_alumno'].'">
								<label for="nombre_grupo">Name</label>
							</div>

							<div class="input-field col s6">
								<input type="text" name="apellidos_alumno" value="'.$answer['apellidos_alumno'].'">
								<label for="apellidos_alumno">Last Name</label>
							</div>

							<div class="input-field col s6">
								<select name="carrera">
									<optgroup label="Current Carrer">
										<option value="'.$answer["carrera"].'">'.$answer["carrera"].'</option>
									</optgroup>
									<optgroup label="All Carrers">
										<option value="Ingenieria en Tecnologias de la Informacion">Ingenieria en Tecnologias de la Informacion</option>
										<option value="Ingenieria en Tecnologias de la Manufactura">Ingenieria en Tecnologias de la Manufactura</option>
										<option value="Ingenieria en Mecatronica">Ingenieria en Mecatronica</option>
										<option value="Ingenieria en Sistemas Automotries">Ingenieria en Sistemas Automotries</option>
										<option value="Licenciatura en Gestion y Administracion de Pequeñas y Medianas Empresas">Licenciatura en Gestion y Administracion de Pequeñas y Medianas Empresas</option>
									</optgroup>

								</select>
							</div>
							<div class="input-field col s6">
								<select name="grupo">
									<optgroup label="Current Group">
										<option value="'.$answer["id_grupo"].'">'.$answer["nombre_grupo"].'</option>
									</optgroup>
									<optgroup label="All Groups">';
										MvcController::selectGroupController();
									echo'</optgroup>
								</select>
							</div>
							<div class="input-field col s6">
								<input type="email" name="email" value="'.$answer["email"].'">
								<label for="email">E-mail</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="waves-effect waves-light blue darken-4 btn-small" name="update">Update Information</button>
					</div>
				</div>
			</form>
			';
		}

		//Este metodo utilizara los datos que se encuentren dentro del metodo editGroupController, ya que son lo que se utilizaran para hacer la modificacion del grupo
		public static function updateStudentController(){

			if(isset($_POST["update"])){

				$data = array("matricula"=>$_POST["matricula"],"nombre_alumno"=>$_POST["nombre_alumno"],"apellidos_alumno"=>$_POST["apellidos_alumno"],"carrera"=>$_POST["carrera"],"grupo"=>$_POST["grupo"],"email"=>$_POST["email"]);
				$answer = Data::updateStudentModel($data, "alumnos");
				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=alumnos';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
			}
		}
    
    
    ##########################################################################################################################
    ################################################ HOURS CONTROLLER #######################################################
    ##########################################################################################################################
    
    public static function addHourController(){
      if(isset($_POST["add"])){
        $data = array("matricula"=>$_POST["matricula"],"unidad"=>$_POST["unidad"],"actividad"=>$_POST["actividad"]);
        $answer = Data::addHourModel($data,"horas","alumno","horas_alumno");
        if($answer=="success"){
          echo "<script>
						window.location='index.php?action=home';
					</script>";
        }else{
          echo"error al registrar hora";
        }
      }
    }

		
	}
?>