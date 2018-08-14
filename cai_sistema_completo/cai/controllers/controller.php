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
			$answer = Data::showStudentsModel("alumnos","grupos");
			foreach ($answer as $row => $student) {
				echo "<option value='$student[matricula]'>".$student['matricula']."</option>";
			}
		}

		

		###################################################################################################################################################
		###########3##################################################### GRUPOS CONTROLLER############################################################### 
		################################################################################################################################################

		//Metodo que mostrara todos  los grupos que se encuentran dentro de la base de datos, mediante una table
		public static function showGroupsController(){
			//por cada registro de grupos que se encuentre en la base de dat0s, se imprimiran dichos datos
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
					<input type="hidden" id="inf" value="3'.$group["id_grupo"].'">
					<tr>
						<td>'.$group['id_grupo'].'</td>
						<td>'.$group['nombre_grupo'].'</td>
						<td>'.$group['nivel'].'</td>
            			<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="index.php?action=sesionAlumnos&id_grupo='.$group["id_grupo"].'"><i class="material-icons">assignment</i></a></td>
					</tr>';
         
        
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
			foreach ($answer as $row => $student) {
				MvcController::editStudentController($student["matricula"]);

			}
		}


		//Se ejecuta caundo se realiza un submit y un poat, al momento de recibir la varable "add" mediante el metodo post, se recibiran todas las variables dek formulario de aagregar a un estudiante
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
    	//Metodo para agregar una hora de cai
	    public static function addHourController(){

	      	if(isset($_POST["Iniciar"])){//Si se hace uso del metodo post con el boton de nombre iniciar se hara lo siguiente
	      		
	      		$numero = 0;//Variable que determinara si un alumno se encuntra dentro de cai o no
	      		$nombre = Data::editStudentModel($_POST["matricula"],"alumnos","grupos");//Se consultan los datos del alumno dependiendo de la matricula
	      		if($nombre){//Se condiciona si si existe dicho alumno

	      			//Se declara un arreglo con todos los datos que se neceistan para registrar la hora
	      			$arreglo = array("matricula"=>$_POST["matricula"],"actividad" =>$_POST["actividad"],"nombre"=>$nombre["nombre_alumno"]." ".$nombre["apellidos_alumno"],"hora_entrada"=>date("H:i"),"fecha"=>date("Y-m-d"),"tiempo"=>time());
		      		//Por cada sesison que se encuentre dentro del arreglo de sesion en hora, se hara una comparacion para ver si el alumno ya esta dentro de cai o no
		      		foreach ($_SESSION["horas"] as $row => $matriculas) {
		      			if($matriculas["matricula"]==$arreglo["matricula"]){
		      				$numero=1;
		      				break;	
		      			}
		      		}
		      		//Se condiciona si el tiempo en minutos es menor a 5, entonces el alumno puede ingresar a cai
		      		if(date("i")<05){
		      			if($numero==1){
	      					echo"This student is already in CAI";
	      				}else{
	      					$_SESSION["horas"][] = $arreglo;
	      				}
	      			}else{
	      				//Sino se determinara que se excedio el tiempo de registro de sesion en cai
	      				echo "Exceed Limit time to add a student to cai";
	      			}
	      			
		      	}else{
		      		echo"This student isn't registred in the system";//Si la consullta no fue exitosa se determinara que el alumno no estta registrado
		      	}

	      		
	     	}
	    }
	    //Metodo que muestra todas las sesiones de cai que estan activas
	    public static function showHourController(){
	    	if(isset($_SESSION["horas"])){
	    		foreach ($_SESSION["horas"] as $row => $matriculas) {
	        	echo'
	        	
	        		<tr>
	        			<td>'.$matriculas["matricula"].'</td>
	        			<td>'.$matriculas["nombre"].'</td>
	        			<td>'.$matriculas["actividad"].'</td>
	        			<td>'.$matriculas["hora_entrada"].'</td>
	        			<td>'.$matriculas["fecha"].'</td>
	        			<td>
	        				<form method="post">
	        					<input type="hidden" name="matricula" value="'.$matriculas["matricula"].'">
	        					<input type="hidden" name="nombre" value="'.$matriculas["nombre"].'">
	        					<input type="hidden" name="actividad" value="'.$matriculas["actividad"].'">
	        					<input type="hidden" name="hora_entrada" value="'.$matriculas["hora_entrada"].'">
	        					<input type="hidden" name="fecha" value="'.$matriculas["fecha"].'">
	        					<button type="submit" name="finish" class="waves-effect waves-light red darken-4 btn-large">Finish CAI hour</button>
	        				</form>
	        			</td>
	        			<td>
	        				<form method="post">
	        					<button type="submit" name="finish" class="waves-effect waves-light yellow darken-4 btn-large">Cancel CAI hour</button>
	        				</form>
	        			</td>
	        		</tr>
	        	';
	        	}	
	        }
	    }

	    //Metodo que termina con la sesion de cai de un alumno
	    public static function finishHourController(){
	    	$tiempo = 3000;
	    	$tiempoMaximo = 3600;
	    	$var = 0;//Variable que determinara si se puede terminar la sesion o no
	    	if(isset($_POST["finish"])){
	    		foreach ($_SESSION["horas"] as $row => $alumno) {
	    			if($alumno["matricula"]==$_POST["matricula"]){
	    				
	    				$T = time()-$alumno["tiempo"];
	    				echo $T;
	    				if($T<$tiempo){//Si el tiempo en segundos es menor a 3000  var=1
	    					$var=1;
	    				}else if($T>$tiempoMaximo){// Si el tiempo pasa de los 3600 var = 2 y la sesion terminara
	    					$var=2;
	    					session_unset($_SESSION["horas"]);
	    				}else if($T>=$tiempo && $T<=$tiempoMaximo){// Si el tiempo es meyor o igual a 3000 y el tiempo en menor o igual a 3600, var=3 y terminara la sesion
	    					$var=3;
	    					session_unset($_SESSION["horas"]);
	    				}
	    			}
	    		}

	    		if($var==1){//Si var es igual a 1, entonces la sesion no puede terminar
	    			echo "The session can not be finish before a 50 minutes lapse";
	    		}else if($var == 2){//Si var es igual a 2, la sesion teminara por que se paso el tiempo de terminar la sesion
	    			echo "The student exceed the limit to finish the session";
	    		}else if($var==3){// Si var es igual a 3, entonces se termino la sesion exitosamente y se realizara la insercion a la base de datos de dicha sesion de cai
	    			$unidad = MvcController::determineUnit();
	    			echo "Session Concluded";
	    			$arregloHora = array("hora_entrada"=>$_POST["hora_entrada"],"hora_salida"=>date("H:i:s"),"fecha"=>$_POST["fecha"],"matricula"=>$_POST["matricula"],"actividad"=>$_POST["actividad"],"unidad"=>$unidad);
	    			$answer = Data::finishHourModel($arregloHora,"horas","horas_alumno");
	    		}
	    	}
	    }
	    //Metodo para cancelar la hora de cai
	    public static function cancelHourController(){
	    	if(isset($_POST["cancelar"])){
	    		foreach ($_SESSION["horas"] as $row => $alumno) {
	    			if($alumno["matricula"]==$_POST["matricula"]){
	    				session_unset($_SESSION["horas"]);
	    			}
	    		}
	    	}
	    }
	    //Metodo para terminar todas las sesiones de cai
	    public static function finishAllHoursController(){
		    if(isset($_POST["finishAll"])){
		    	if(date("i")>=55||date("i")>=50 && date("i")<=59){//se determinara si la hora es apropiada para terminar la hora de cai, si lo es se ralizara lo siguiente
		    		$unidad = MvcController::determineUnit();
		    		foreach ($_SESSION["horas"] as $row => $sesion) {//Por cada sesion de cai se realizara la asignacion de los valores de la sesion a un arreglo, el cual sera registrado como parametro para terminar cada una de las horas de cai.
	    				$arregloHora = array("hora_entrada"=>$_SESSION["horas"]["hora_entrada"],"hora_salida"=>date("H:i:s"),"fecha"=>date("Y-M-D"),"matricula"=>$_SESSION["horas"]["matricula"],"actividad"=>$_SESSION["horas"]["actividad"],"unidad"=>$unidad);
	    				$answer = Data::finishHourModel($arregloHora,"horas","horas_alumno");
		    		}		    		
		    		session_unset($_SESSION["horas"]);//Se terminaran las horas de cai
		    	}else{//Si la hora no es adecuada para terminar, se determinara que no se puede acabar la sesion
		    		echo"You can't end up all cai hours yet";
		    	}
		    }
	    }
	    //Metodo para determinar la unidad de la sesion de cai que se esta realizando, dependiendo de las fechas en la cual se esta realizando se determinara para que unidad se esta realizando a hora de cai.
	    public static function determineUnit(){
	    	$answer = Data::showUnitsModel("unidad");
	    	foreach ($answer as $row => $unit) {
	    		if($unit["id_unidad"]==1){
	    			if(date("Y-m-d")>=$unit["fecha_inicio"] && date("Y-m-d")<=$unit["fecha_termino"]){
	    				return 1;
					}else{
						break;
					}
	    		}else if($unit["id_unidad"]==2){
	    			if(date("Y-m-d")>=$unit["fecha_inicio"] && date("Y-m-d")<=$unit["fecha_termino"]){
	    				return 2;
					}else{
						break;
					}
	    		}else if($unit["id_unidad"]==2){
	    			if(date("Y-m-d")>=$unit["fecha_inicio"] && date("Y-m-d")<=$unit["fecha_termino"]){
	    				return 3;
					}else{
						break;
					}
	    		}else if($unit["id_unidad"]==2){
	    			if(date("Y-m-d")>=$unit["fecha_inicio"] && date("Y-m-d")<=$unit["fecha_termino"]){
	    				return 3;
					}else{
						break;
					}
	    		}
	    		
	    	}
	    }

	    //Metodo para mostrar los teachers que tienen alumnos que realizaron sesion de cai.
	    public static function sessionsController(){
	    	$answer = Data::showTeachersModel("teachers");
			foreach ($answer as $row => $session) {
				if($session['num_empleado']!=1){
					echo'
						<tr>
							<td>'.$session['nombre_teacher'].' '.$session["apellidos_teacher"].'</td>
							<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="index.php?action=sesionGrupos&num_empleado='.$session['num_empleado'].'">Check</a></td>
						</tr>

					';
				}
			}
			echo "</tbody>
				</table>";
	    }

	    //Metodo que Visualiza la sesion de los alumnos de cada grupo que tiene cada teacher
	    public static function teacherSessionsController(){
	    	$data = $_GET["num_empleado"];
	    	$answer =  Data::showTeachersGroupsModel($data,"grupos");
	    	foreach ($answer as $row => $group) {
				echo'
					<input type="hidden" id="inf" value="3'.$group["id_grupo"].'">
					<tr>
						<td>'.$group['nombre_grupo'].'</td>
						<td>'.$group['nivel'].'</td>
            			<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="index.php?action=sesionAlumnos&id_grupo='.$group["id_grupo"].'"><i class="material-icons">assignment</i></a></td>
					</tr>';
			}
			echo "</tbody>
			</table>";

	    }
	    //Metodo que muestra a los alumnos de cada grupo que hayan realizado alguna sesion de cai
	    public static function teacherStudentsSessionController(){
	    	$data=$_GET["id_grupo"];
	    	$answer = Data::teacherStudentSessionsModel($data,"alumnos","horas_alumno");
	    	foreach ($answer as $row => $student) {
				echo'
					<input type="hidden" id="inf" value="3'.$student["matricula"].'">
					<tr>
						<td>'.$student['matricula'].'</td>
						<td>'.$student['nombre_alumno'].' '.$student['apellidos_alumno'].'</td>
						<td>'.$student['carrera'].'</td>
						<td>'.$student['email'].'</td>
						<td>'.$student['total_horas'].'</td><
            			<td><a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="index.php?action=detallesSesion&matricula='.$student["matricula"].'"><i class="material-icons">assignment</i></a></td>
					</tr>';
			}
			echo"</tbody>
			</table>";
	    }
	    //Metodo que muestra los detalles de la sesion que realizo un alumno
	    public static function studentHoursDetailController(){
	    	$data = $_GET["matricula"];
	    	$answer = Data::studentHoursDetailModel($data,"horas_alumno","horas");
	    	foreach ($answer as $row => $student) {
				echo'
					<input type="hidden" id="inf" value="3'.$student["matricula_alumno"].'">
					<tr>
						<td>'.$student['actividad'].'</td>
						<td>'.$student['unidad'].'</td>
						<td>'.$student['fecha'].'</td>
						<td>'.$student['hora_entrada'].'</td>
						<td>'.$student['hora_salida'].'</td>
					</tr>';
			}
			echo"</tbody>
			</table>";
	    }


	    //Metodo que permite visualizar las unidades
	    public static function showUnitsController(){
	    	$answer = Data::showUnitsModel("unidad");
	    	foreach ($answer as $row => $unit) {
	    		echo '<tr>
	    				<td>'.'Unit-'.$unit['id_unidad'].'</td>
	    				<td>'.$unit['fecha_inicio'].'</td>
	    				<td>'.$unit['fecha_termino'].'</td>
	    				<td> <a class="btn-floating btn-large waves-effect waves-light teal darken-3 btn modal-trigger" href="#'.$unit['id_unidad'].'"><i class="material-icons">edit</i></a> </td>
	    		';
	    	}
	    	echo"</tbody>
	    		</table>";
	    	foreach ($answer as $row => $unit) {
				MvcController::editUnitController($unit["id_unidad"]);

			}
	    }

	    //Metodo que permite la edicion de las unidades
	    public static function editUnitController($data){
			$answer = Data::editUnitModel($data,"unidad");
			echo'
			<form method="post" enctype="multipart/form-data">
				<div id="'.$answer["id_unidad"].'" class="modal modal-fixed-footer">
					<div class="modal-content">
					<h4>Info</h4>
						<div class="row">
		                	<div class="input-field col s12">
		                    	<input type="hidden" name="id_unidad" value="'.$answer['id_unidad'].'">
		                	</div>
							<div class="input-field col s12">
								<input type="date" name="fecha_inicio" value="'.$answer['fecha_inicio'].'">
								<label for="nombre_grupo">Start Date</label>
							</div>

							<div class="input-field col s12">
								<input type="date" name="fecha_termino" value="'.$answer['fecha_termino'].'">
								<label for="apellidos_alumno">End Date</label>
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
	    //Este metodo utilizara los datos que se encuentren dentro del metodo editUnitController, ya que son lo que se utilizaran para hacer la modificacion del grupo
		public static function updateUnitController(){

			if(isset($_POST["update"])){

				$data = array("id_unidad"=>$_POST["id_unidad"],"fecha_inicio"=>$_POST["fecha_inicio"],"fecha_termino"=>$_POST["fecha_termino"]);
				$answer = Data::updateUnitModel($data, "unidad");
				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=unidades';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
			}
		}

	}
?>