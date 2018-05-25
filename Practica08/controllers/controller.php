<?php
class MvcCont{
	
	public static function page(){		
		include "views/template.php";
	}

	public static function linkPagesC(){
		if(isset( $_GET['action'])){
			$link = $_GET['action'];
		}else{
			$link = "index";
		}
		$respuesta = Pages::linkPagesM($link);
		include $respuesta;
	}

	public static function registroMaestroC(){

		if(isset($_POST["registrar"])){
			$maestro = array( "nombre"=>$_POST["maestro"], "password"=>$_POST["password"],"email"=>$_POST["email"],"carrera"=>$_POST['carrera']);
			$respuesta = Datos::registroMaestroM($maestro, "maestro");
			if($respuesta == "success"){
				header("location:index.php?action=maestros");
			}else{
				header("location:index.php?action=registro");
			}
		}
	}

	public static function ingresoMaestroC(){
		if(isset($_POST["ingresar"])){
			$datos = array( "nameMaestro"=>$_POST["nameMaestro"], "password"=>$_POST["password"]);
			$respuesta = Datos::ingresoMaestroM($datos, "maestro");
			if($respuesta["nombre"] == $_POST["nameMaestro"] && $respuesta["password"] == $_POST["password"]){
				session_start();
				$_SESSION["maestro"] = true;
				header("location:index.php?action=alumnos&id=$respuesta[numero]");
			}else if ($_POST["nameMaestro"] == "admin" && $_POST["password"] == "admin"){
				session_start();
				$_SESSION["validar"] = true;
				header("location:index.php?action=maestros");
			}else{
				header("location:index.php?action=fallo");
			}
		}	
	}
	public static function vistaMaestrosC(){
		$respuesta = Datos::vistaMaestroM("maestro");
		echo '<a href="index.php?action=registro"><input type="button" value="Registrar"/></a>';
		foreach($respuesta as $row => $maestros){
		echo'
			<tr>
				<td>'.$maestros["numero"].'</td>
				<td>'.$maestros["nombre"].'</td>
				<td>'.$maestros["email"].'</td>
				<td>'.$maestros["carrera"].'</td>
				<td><a href="index.php?action=editar&numero='.$maestros["numero"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=maestros&numero='.$maestros["numero"].'"><button>Borrar</button></a></td>
			</tr>';
		}
	}
	public static function editarMaestroC(){
		$datos = $_GET["numero"];
		$respuesta = Datos::editarMaestroM($datos, "maestro");
		echo'<input type="hidden" value="'.$respuesta["numero"].'" name="numero">
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <input type="email" value="'.$respuesta["email"].'" name="email" required>
			 <input type="password" value="'.$respuesta["password"].'" name="password" required>
			 <input type="carrera" value="'.$respuesta["carrera"].'" name="carrera" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}
	
	public static function actualizarMaestroC(){
		if(isset($_POST["actualizar"])){
			$datos = array( "numero"=>$_POST["numero"],"nombre"=>$_POST["nombre"],"email"=>$_POST["email"],"password"=>$_POST["password"],"carrera"=>$_POST["carrera"]);
			$respuesta = Datos::actualizarMaestroM($datos, "maestro");
			if($respuesta == "success"){
				header("location:index.php?action=maestros");
			}else{
				echo "error";
			}
		}
	}

	public static function borraMaestroC(){
		if(isset($_GET["numero"])){
			$datos = $_GET["numero"];
			$respuesta = Datos::borraMaestroM($datos, "maestro");
			if($respuesta == "success"){
				header("location:index.php?action=maestros");
			}
		}
	}

	//############################ CONTROLLER PARA LOS ALUMNOS ###################################################
	
	public static function registrarAlumnoC(){
		if(isset($_POST["registrar"])){
			$alumno = array("nombre"=>$_POST["alumno"], "carrera"=>$_POST["carrera"], "tutor"=>$_POST["tutor"]);
			$respuesta = Datos::registrarAlumnoM($alumno, "alumno");
			if($respuesta == "success"){
				header("location:index.php?action=alumnos");
			}else{
				header("location:index.php?action=registroAlumno");
			}
		}

	}
	public static function vistaAlumnosPorTutorC(){
		$idTutor = $_GET['id'];
		$respuesta = Datos::vistaAlumnosPorTutorM("alumno",$idTutor);
		foreach($respuesta as $row => $alumno){
		echo'<tr>
				<td>'.$alumno["matricula"].'</td>
				<td>'.$alumno["nombre"].'</td>
				<td>'.$alumno['carrera'].'</td>
				<td><a href="index.php?action=editarAlumno&id='.$alumno["matricula"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=alumno&idBorrar='.$alumno["matricula"].'"><button>Borrar</button></a></td>
			</tr>';
		}
	}
	public static function vistaAlumnosC(){
		echo '<a href="index.php?action=registroAlumno"><input type="button" value="Registrar"/></a>';
		$respuesta = Datos::vistaAlumnosM("alumno");
		foreach($respuesta as $row => $alumno){
		echo'<tr>
				<td>'.$alumno["matricula"].'</td>
				<td>'.$alumno["nombre"].'</td>
				<td>'.$alumno['carrera'].'</td>
				<td>'.$alumno['tutor'].'</td>
				<td><a href="index.php?action=editarAlumno&matricula='.$alumno["matricula"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=alumnos&matricula='.$alumno["matricula"].'"><button>Borrar</button></a></td>
			</tr>';
		}
	}

	public static function editarAlumnoC(){
		$datos = $_GET["matricula"];
		$respuesta = Datos::editarAlumnoM($datos, "alumno");
		echo'<input type="hidden" value="'.$respuesta["matricula"].'" name="matricula">
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <input type="text" value="'.$respuesta["carrera"].'" name="carrera" required>
			 <input type="text" value="'.$respuesta["tutor"].'" name="tutor" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}

	public static function actualizarAlumnoC(){
		if(isset($_POST["actualizar"])){
			$datos = array( "matricula"=>$_POST["matricula"],"nombre"=>$_POST["nombre"],"carrera"=>$_POST["carrera"],"tutor"=>$_POST["tutor"]);
			$respuesta = Datos::actualizarAlumnoM($datos, "alumno");
			if($respuesta == "success"){
				header("location:index.php?action=alumnos");
			}else{
				echo "error";
			}
		}
	}


	public static function borraAlumnoC(){
		if(isset($_GET['matricula'])){
			$datos = $_GET['matricula'];
			$respuesta = Datos::borraAlumnoM($datos,"alumno");
			if($respuesta == "success"){
				header("location:index.php?action=alumnos");
			}
		}
	}
	//################################# CONTROLLER PARA LAS CARRERAS #####################################################
	public static function registrarCarreraC(){
		if(isset($_POST["registrar"])){
			$carrera = array("nombre"=>$_POST["carrera"]);
			$respuesta = Datos::registrarCarreraM($carrera, "carrera");
			if($respuesta == "success"){
				header("location:index.php?action=carreras");
			}else{
				header("location:index.php?action=registroCarrera");
			}
		}

	}

	public static function vistaCarreraC(){
		echo '<a href="index.php?action=registroCarrera"><input type="button" value="Registrar"/></a>';
		$respuesta = Datos::vistaCarreraM("carrera");
		foreach($respuesta as $row => $carrera){
		echo'<tr>
				<td>'.$carrera["id"].'</td>
				<td>'.$carrera["nombre"].'</td>
				<td><a href="index.php?action=editarCarrera&id='.$carrera["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=carreras&id='.$carrera["id"].'"><button>Borrar</button></a></td>
			</tr>';
		}
	}

	public static function editarCarreraC(){
		$datos = $_GET["id"];
		$respuesta = Datos::editarCarreraM($datos, "carrera");
		echo'
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}

	public static function actualizarCarreraC(){
		if(isset($_POST["actualizar"])){
			$datos = array( "id"=>$_POST["id"],"nombre"=>$_POST["nombre"]);
			$respuesta = Datos::actualizarCarreraM($datos, "carrera");
			if($respuesta == "success"){
				header("location:index.php?action=carreras");
			}else{
				echo "error";
			}
		}
	}
	public static function borraCarreraC(){
		if(isset($_GET['id'])){
			$datos = $_GET['id'];
			$respuesta = Datos::borraCarreraM($datos,"carrera");
			if($respuesta == "success"){
				header("location:index.php?action=carreras");
			}
		}
	}




	//Este metodo permite que se puedan visualizar las carreras dentro de los formularios de registros de Alumnos y Maestros
	public static function selectCarreras(){
		$respuesta = Datos::vistaCarreraM("carrera");
		echo"<select name='carrera'>";
		foreach($respuesta as $row => $carrera) {
			echo "<option value='$carrera[id]'>".$carrera[id]."-".$carrera['nombre']."</option>";
		}
		echo "</select>";
	}

	public static function selectTutor(){
		$respuesta = Datos::vistaMaestroM("maestro");
		echo"<select name='tutor'";
		foreach ($respuesta as $row => $tutor) {
			echo "<option valud='$tutor[numero]'>".$tutor[numero]."-".$tutor['nombre']."</option>";
		}
		echo "</select>";
	}
}
?>
