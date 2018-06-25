<?php
	class MvcController{

		//Controlador para incluir el template en el index y mostrarlo en todas las paginas
		public static function page(){
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

		//Metodo que mostrara la informacion de los pagos en una tabla, utilizando el modelo que recibira como parametros las tablas de pagos, alumnas y grupo, para mostrar adecuadamente la informacion
		public static function showPaymentsController(){
			$answer = Data::showPaymentsModel("pagos","alumnas","grupo");
			foreach ($answer as $row => $pagos) {
				echo'
					<tr align="center">
						<td>'.$pagos['id_pago'].'</td>
						<td>'.$pagos['nombre_grupo'].'</td>
						<td>'.$pagos['nombre'].' '.$pagos['apellidos'].'</td>
						<td>'.$pagos['nombreMama'].' '.$pagos['apellidoMama'].'</td>
						<td>'.$pagos['fechaEnvio'].'</td>
						<td>'.$pagos['fechaPago'].'</td>';
						if(isset($_SESSION["user"])){
							echo '
								<td><a href="'.$pagos['imagenFolio'].'">Ver</a></td>
								<td>'.$pagos['folio'].'</td>
								<td><a href="index.php?action=editarLugar&id_pago='.$pagos['id_pago'].'" class="btn btn-info">Editar Fecha de Pago</a></td>
								<td><a href="index.php?action=eliminarLugar&id_pago='.$pagos['id_pago'].'" class="btn btn-danger">Eliminar Pago</a></td>
							';
						}
				echo'</tr>';
			}
		}

		//Metodo que tomara la informacion del formulario mediante metodo Post y la agregara a un arreglo que sera mandado como parametro al modelo y poder ejecutar la insercion en la base de datos
		public static function addPaymentController(){
			if(isset($_POST["aceptar"])){

				$dir = "views/dist/img/";
				$file = $_FILES["imagenFolio"]["name"];
				$dirFile = $dir.$file;
				$tempFile = $_FILES["imagenFolio"]["tmp_name"];
				echo $dirFile;
				move_uploaded_file($tempFile,$dirFile);
				  
			// Check if image file is a actual image or fake image
				$data = array("grupo" => $_POST["grupo"], "alumna"=>$_POST["alumna"], "nombreMama"=>$_POST["nombreMama"], "apellidoMama"=>$_POST["apellidoMama"], "fechaPago" => $_POST["fechaPago"], "fechaEnvio" =>date("Y-m-d H:i:s"), "imagenFolio" =>$dirFile, "folio" =>$_POST["folio"]);
				$answer = Data::addPaymentModel($data,"pagos");

				if($answer == "success"){
					echo "<script>
						window.location = 'index.php?action=lugares'
						</script>";
				}else{
					echo "error";
				}
			}
		}

		//Metodo para poder visualizar el nombre de los grupos en un select y que en cada opcion el valor contenga el id del grupo
		public static function selectGroup(){
			$answer = Data::showGroupsModel("grupo");
			
			foreach ($answer as $row => $group) {
				echo "<option value='$group[id_grupo]'>".$group['nombre_grupo']."</option>";
			}
			
		}

		//Metodo para poder visualizar el nombre de las alumnas en un select y que en cada opcion el valor contenga el id de la alumna
		public static function selectStudent(){
			$answer = Data::showStudentsModel("alumnas","grupo");
			foreach ($answer as $row => $student) {
				echo "<option value='$student[id_alumna]'>".$student['nombre']." ".$student['apellidos']."</option>";
			}
		}

		//Funcion que permite el login de un usuario dependiendo si el email y el password que se ingresen son iguales a alguno de los registros de la base de datos
		public static function loginController(){
			if(isset($_POST["login"])){//Se condiciona si se utilizo el boton de nombre "login"

				//Se hace el llenado de un arreglo con los datos que se ingresaron en el login
				$data = array( "usuario"=>$_POST["usuario"], "password"=>$_POST["password"]);
				
				//Los datos del arreglo se mandan como parametros en el modelo del login y la table user
				$answer = Data::loginModel($data, "usuario");
				
				//Se condiciona que si los datos ingresados en el login coinciden con los de algun usuario de la base de datos se inicie la sesion
				if($answer["usuario"] == $_POST["usuario"] && $answer["password"] == $_POST["password"]){
					//session_start();
					$_SESSION["user"] = $answer["id_usuario"];//A la variable de sesion se le asigna el valor del id del usuario que ingreso

					//Al iniciar la sesion se redirecciona al dashboard
					echo"<script>
						window.location='index.php?action=dashboard';
					</script>";

				}else{
					echo "<script>
						window.location='index.php?action=login';
					</script>";//Si no se enceuntran datos que coincidan con los del login, se redirecciona al login
				}
			}
		}


		############################################################################################################################################################3
		###########3##################################################### ALUMNAS CONTROLLER !$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$#
		#############################################################################################################################################################

		//Metodo que mostrara todos  las alumnas que se encuentran dentro de la base de datos, mediante una table
		public static function showStudentsController(){
			$answer = Data::showStudentsModel("alumnas","grupo");
			foreach ($answer as $row => $student) {
				echo'
					<tr align="center">
						<td>'.$student['id_alumna'].'</td>
						<td>'.$student['nombre'].'</td>
						<td>'.$student['apellidos'].'</td>
						<td>'.$student['fecha_nacimiento'].'</td>
						<td>'.$student['nombre_grupo'].'</td>
						<td><a href="index.php?action=editarAlumna&id_alumna='.$student['id_alumna'].'" class="btn btn-info">Editar Informacion</a></td>
						<td><a href="index.php?action=eliminarAlumna&id_alumna='.$student['id_alumna'].'" class="btn btn-danger">Dar de Baja</a></td>
					</tr>
				';
			}
		}
		//Metodo del controlador para tomar los datos del formualrio de registro de alumnas y mandarlos al modelo para realizar la insercion en la base de datos
		public static function addStudentController(){
			if(isset($_POST["add"])){
				$data = array("nombre"=>$_POST["nombre"], "apellidos"=>$_POST["apellidos"],"fecha_nacimiento"=>$_POST["fecha_nacimiento"],"grupo"=>$_POST["grupo"]);
				$answer = Data::addStudentModel($data,"alumnas");
				if($answer=="success"){
					echo "<script>
						window.location='index.php?action=alumnas';
					</script>";
				}else{
					echo "Error al registrar";
				}
			}
		}

		//Metodo del controlador para tomar el id de alumna y mandarlo al modelo para realizar la eliminacion en la base de datos
		public static function deleteStudentController(){
			$data = $_GET['id_alumna'];
			$answer= Data::deleteStudentModel($data,"alumnas");
			if($answer == "success"){
				echo "<script>
					window.location='index.php?action=alumnas';
				</script>";
			}else{
				echo "Error al Eliminar";
			}
		}

		public static function editStudentController(){
			$data = $_GET["id_alumna"];
			$answer = Data::editStudentModel($data,"alumnas","grupo");
			echo'<input type="hidden" value="'.$answer["id_alumna"].'" name="id_alumna">
			
			 <label>Nombre<input type="text" value="'.$answer["nombre"].'" name="nombre" class="form-control" required></label><br>

			 <label>Apellidos<input type="text" value="'.$answer["apellidos"].'" name="apellidos" class="form-control" required></label><br>

			 <label>Fecha de Nacimiento<input type="date" value="'.$answer["fecha_nacimiento"].'" name="fecha_nacimiento" class="form-control" required></label><br>

			 <label>Grupo</h4><select name="grupo" class="form-control">
			 	<option value="$answer[id_grupo]">'.$answer['nombre_grupo'].'</option>
			 	';


		}

		public static function updateStudentController(){

			if(isset($_POST["update"])){

				$data = array("id_alumna"=>$_POST["id_alumna"],"nombre"=>$_POST["nombre"],"apellidos"=>$_POST["apellidos"],"fecha_nacimiento"=>$_POST["fecha_nacimiento"],"grupo"=>$_POST["grupo"]);
				
				$answer = Data::updateStudentModel($data, "alumnas");

				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=alumnas';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}

			}
		
		}

		############################################################################################################################################################3
		###########3##################################################### GRUPOS CONTROLLER !$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$#
		#############################################################################################################################################################

		//Metodo que mostrara todos  los grupos que se encuentran dentro de la base de datos, mediante una table
		public static function showGroupsController(){
			$answer = Data::showGroupsModel("grupo");
			foreach ($answer as $row => $group) {
				echo'
					<tr align="center">
						<td>'.$group['id_grupo'].'</td>
						<td>'.$group['nombre_grupo'].'</td>
						<td><a href="index.php?action=editarGrupo&id_grupo='.$group['id_grupo'].'" class="btn btn-info">Editar Informacion</a></td>
						<td><a href="index.php?action=eliminarGrupo&id_grupo='.$group['id_grupo'].'" class="btn btn-danger">Quitar Grupo</a></td>
					</tr>

				';
			}
		}


		public static function addGroupController(){
			if(isset($_POST["add"])){
				$data = array("nombre_grupo"=>$_POST["nombre_grupo"]);
				$answer = Data::addGroupModel($data,"grupo");
				if($answer=="success"){
					echo "<script>
						window.location='index.php?action=grupos';
					</script>";
				}else{
					echo "Error al registrar";
				}
			}
		}

		public static function editGroupController(){
			$data = $_GET["id_grupo"];
			$answer = Data::editGroupModel($data,"grupo");
			echo'<input type="hidden" value="'.$answer["id_grupo"].'" name="id_grupo">
			 <input type="text" value="'.$answer["nombre_grupo"].'" name="nombre_grupo" class="form-control" required>';
		}

		public static function updateGroupController(){
			if(isset($_POST["update"])){
				$data = array("id_grupo"=>$_POST["id_grupo"],"nombre_grupo"=>$_POST["nombre_grupo"]);
				$answer = Data::updateGroupModel($data, "grupo");
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

		public static function deleteGroupController(){
			$data = $_GET["id_grupo"];
			$answer = Data::deleteGroupModel($data,"grupo","alumnas","pagos");
			if($answer == "success"){
				echo "<script>
					window.location='index.php?action=grupos';
				</script>";
			}else{
				echo"Error al quitar el grupo";
			}
		}


		############################################################################################################################################################3
		###########3##################################################### LUHARES CONTROLLER !$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$#
		#############################################################################################################################################################

		public static function editPaymentController(){
			$data = $_GET["id_pago"];
			$answer = Data::editPaymentModel($data,"pagos");
			echo'<input type="hidden" value="'.$answer["id_pago"].'" name="id_pago">
			
			 <label>Fecha de Pago<input type="date" value="'.$answer["fechaPago"].'" name="fechaPago" class="form-control" required></label><br>

			 <label>Fecha de Envio<input type="text" value="'.$answer["fechaEnvio"].'" name="fechaEnvio" class="form-control" required></label><br>';
			 
		}
		
		public static function updatePaymentController(){
			if(isset($_POST["update"])){
				$data = array("id_pago"=>$_POST["id_pago"],"fechaEnvio"=>$_POST["fechaEnvio"],"fechaPago"=>$_POST["fechaPago"]);
				$answer = Data::updatePaymentModel($data, "pagos");
				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=pagos';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
			}
		}	

		public static function deletePaymentController(){
			$data = $_GET["id_pago"];

			$answer = Data::deletePaymentModel($data,"pagos");

			if($answer == "success"){
				echo "<script>
					window.location='index.php?action=pagos';

				</script>";
			}else{
				echo "Error al Eliminar Pago";
			}
		}	
	}
?>

