<?php
class MvcCont{
	
	//llamado al template
	public static function page(){		
		include "views/template.php";
	}

	//enlaces a las paginas
	public static function linkPagesC(){
		if(isset( $_GET['action'])){
			$link = $_GET['action'];
		}else{
			$link = "index";
		}
		$respuesta = Pages::linkPagesM($link);
		include $respuesta;
	}
	

	//controller para el registro de maestros
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
	//Controller para ingreso de maestros
	public static function ingresoMaestroC(){
		if(isset($_POST["ingresar"])){
			$datos = array( "nameMaestro"=>$_POST["nameMaestro"], "password"=>$_POST["password"]);
			$respuesta = Datos::ingresoMaestroM($datos, "maestro");


			if($respuesta["nombre"] == $_POST["nameMaestro"] && $respuesta["password"] == $_POST["password"]){
				session_start();
				$_SESSION["maestro"] = $respuesta["numero"];
				header("location:index.php?action=alumnosMaestro&id=$respuesta[numero]");

			}else if ($_POST["nameMaestro"] == "admin" && $_POST["password"] == "admin"){
				session_start();
				$_SESSION["validar"] = true;
				header("location:index.php?action=maestros");
			}else{
				header("location:index.php");
			}
		}	
	}

	//Funcion para ver a los maestros
	public static function vistaMaestrosC(){
		$respuesta = Datos::vistaMaestroM("maestro");
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

	//funcion para editar a los maestros
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
	
	//funcion para actualizar maestros
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
	//funcion para borrar maestros
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

	//func para ver los alumnos de un solo maestro/tutor
	public static function vistaAlumnosPorTutorC(){
		$tutor = $_GET["id"];
		$respuesta = Datos::vistaAlumnosPorTutorM("alumno",$tutor);
		foreach($respuesta as $row => $alumno){
		echo'<tr>
				<td>'.$alumno["matricula"].'</td>
				<td>'.$alumno["nombre"].'</td>
				<td>'.$alumno['carrera'].'</td>
			</tr>';
		}
	}

	//func para ver alumnos
	public static function vistaAlumnosC(){
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
//funcion para editara lumnos
	public static function editarAlumnoC(){
		$datos = $_GET["matricula"];
		$respuesta = Datos::editarAlumnoM($datos, "alumno");
		echo'<input type="hidden" value="'.$respuesta["matricula"].'" name="matricula">
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <input type="text" value="'.$respuesta["carrera"].'" name="carrera" required>
			 <input type="text" value="'.$respuesta["tutor"].'" name="tutor" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}
//funcion para actualizar alumnos
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

//funcion para borrar alumnos
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
	
	//funcion para el registro de carrerasa
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
//funcion para ver carreras
	public static function vistaCarreraC(){
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
//funcon para editar carreras
	public static function editarCarreraC(){
		$datos = $_GET["id"];
		$respuesta = Datos::editarCarreraM($datos, "carrera");
		echo'
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombre" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}
//funcion para actualizar carreras
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
	//funcion para borrar carreras
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
		foreach($respuesta as $row => $carrera) {
			echo "<option value='$carrera[id]'>".$carrera[id]."-".$carrera['nombre']."</option>";
		}
	}

	public static function selectTutor(){
		$respuesta = Datos::vistaMaestroM("maestro");
		foreach ($respuesta as $row => $tutor) {
			echo "<option value='$tutor[numero]'>".$tutor[numero]."-".$tutor['nombre']."</option>";
		}
	}

	//########################## CONTROLLER PARA LAS TUTORIAS #####################################3

	//funcion para el registro de tutorias
	public static function registrarTutoriaC(){
		if(isset($_POST["registrar"])){
			$tutoria = array( "tutor"=>$_POST["tutor"], "fecha"=>$_POST["fecha"],"hora"=>$_POST["hora"],"descripcion"=>$_POST['descripcion'],"tipo"=>$_POST['tipo']);
			$respuesta = Datos::registrarTutoriaM($tutoria, "tutoria");
			if($respuesta == "success"){
				header("location:index.php?action=tutorias");
			}else{
				header("location:index.php?action=registroTutoria");
			}
		}
	}

	//funcon para ver las tutorias
	public static function vistaTutoriaC(){
		$respuesta = Datos::vistaTutoriaM("tutoria");
		foreach($respuesta as $row => $tutoria){
		echo'<tr>
				<td>'.$tutoria["id"].'</td>
				<td>'.$tutoria['tutor'].'</td>
				<td>'.$tutoria["fecha"].'</td>
				<td>'.$tutoria['hora'].'</td>
				<td>'.$tutoria['descripcion'].'</td>
				<td>'.$tutoria['tipo'].'</td>
				<td><a href="index.php?action=editarTutoria&id='.$tutoria["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=tutorias&id='.$tutoria["id"].'"><button>Borrar</button></a></td>
			</tr>';
		}
	}


	public static function vistaTutoriaPorMaestroC($tutor){
		$respuesta = Datos::vistaTutoriaPorTutorM("tutoria",$tutor);
		foreach($respuesta as $row => $tutoria){
		echo'<tr>
				<td>'.$tutoria["id"].'</td>
				<td>'.$tutoria["tutor"].'</td>
				<td>'.$tutoria['fecha'].'</td>
				<td>'.$tutoria['hora'].'</td>
				<td>'.$tutoria['descripcion'].'</td>
				<td>'.$tutoria['tipo'].'</td>
				<td><a href="index.php?action=editarTutoria&id='.$tutoria["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=tutorias&id='.$tutoria["id"].'"><button>Borrar</button></a></td>
		
			</tr>';
		}
	}


	//funcion para editar las tutorias
	public static function editarTutoriaC(){
		$datos = $_GET["id"];
		$respuesta = Datos::editarTutoriaM($datos, "tutoria");
		echo'<input type="hidden" value="'.$respuesta["id"].'" name="id">
			 <input type="text" value="'.$respuesta["tutor"].'" name="tutor" required>
			 <input type="date" value="'.$respuesta["fecha"].'" name="fecha" required>
			 <input type="time" value="'.$respuesta["hora"].'" name="hora" required>
			 <input type="text" value="'.$respuesta["descripcion"].'" name="descripcion" required>
			 <input type="text" value="'.$respuesta["tipo"].'" name="tipo" required>
			 <input type="submit" name ="actualizar" value="Actualizar">';
	}
	//funcion para actualizar las tutorias
	public static function acutalizarTutoriaC(){
		if(isset($_POST["actualizar"])){
			$datos = array( "id"=>$_POST["id"],"tutor"=>$_POST["tutor"],"fecha"=>$_POST['fecha'],"hora"=>$_POST['hora'],"descripcion"=>$_POST['descripcion'],"tipo"=>$_POST['tipo']);
			$respuesta = Datos::actualizarTutoriaM($datos, "tutoria");
			if($respuesta == "success"){
				header("location:index.php?action=tutorias");
			}else{
				echo "error";
			}
		}
	}

	//funciion apra eliminar la tutoria
	public static function borraTutoriaC(){
		if(isset($_GET['id'])){
			$datos = $_GET['id'];
			$respuesta = Datos::borraCarreraM($datos,"tutoria");
			if($respuesta == "success"){
				header("location:index.php?action=tutorias");
			}
		}
	}

}
?>
