<?php

require_once "conexion.php";

class Datos extends Conexion{

	//***************************CRUD MAESTROS******************************************
	public static function registroMaestroM($data, $table){
		$query = "INSERT INTO $table (nombre, email, password, carrera) VALUES (:nombre,:email,:password,:carrera)";
		$statement = Conexion::connect()->prepare($query);	
		$statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$statement->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$statement->bindParam(":carrera", $data["carrera"], PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	//fucion para el ingreso de maestrso
	public static function ingresoMaestroM($data, $table){
		$query = "SELECT * FROM $table WHERE nombre = :nombre";
		$statement = Conexion::connect()->prepare($query);	
		$statement->bindParam(":nombre", $data["nameMaestro"], PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}

//funcon para ver maestros
	public static function vistaMaestroM($table){
		$query = "SELECT * FROM $table ";
		$statement = Conexion::connect()->prepare($query);	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	//funcon para editar maestros
	public static function editarMaestroM($data, $table){

		$query ="SELECT numero, nombre, email, password, carrera FROM $table WHERE numero = :numero";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":numero", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}
//funcon para actualizar maestros
	public static function actualizarMaestroM($data, $table){

		$query ="UPDATE $table SET nombre = :nombre, email = :email, password = :password, carrera = :carrera WHERE numero = :numero";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$statement->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$statement->bindParam(":carrera", $data["carrera"], PDO::PARAM_INT);
		$statement->bindParam(":numero", $data["numero"], PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$statement->close();
	}
//funcon para borrar maestros
	public static function borraMaestroM($data, $table){
		$query = "DELETE FROM $table WHERE numero = :numero";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":numero", $data, PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$statement->close();
	}

	//***************CRUD ALUMNOS***********************
	//###################################################################################################
	public static function vistaAlumnosPorTutorM($table,$tutor){
		//"SELECT a.matricula, a.nombre, a.carrera, a.tutor, c.nombre, t.nombre FROM $table3 as t INNER JOIN $table as a INNER JOIN $table2 as c WHERE a.carrera = c.id and a.tutor = t.id"
		$statement = Conexion::connect()->prepare("SELECT * FROM $table WHERE tutor = :tutor");
		$statement->bindParam(":tutor",$tutor,PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	//funcon para ver alumnos
	public static function vistaAlumnosM($table){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table");	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
//funcon para editar alumno
	public static function editarAlumnoM($data, $table){

		$query ="SELECT matricula, nombre, carrera, tutor FROM $table WHERE matricula = :matriucla";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":matriucla", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}
//funcon para actualizar alumno
	public static function actualizarAlumnoM($data, $table){

		$query ="UPDATE $table SET nombre = :nombre, carrera = :carrera, tutor = :tutor WHERE matricula = :matricula";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":tutor", $data["tutor"], PDO::PARAM_STR);
		$statement->bindParam(":carrera", $data["carrera"], PDO::PARAM_INT);
		$statement->bindParam(":matricula", $data["matricula"], PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
//funcon para borrar alumno
	public static function borraAlumnoM($data, $table){
		$query = "DELETE FROM $table WHERE matricula = :matricula";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":matricula", $data, PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$statement->close();
	}
//funcon para registrar alumno
	public static function registrarAlumnoM($data,$table){
		$query = "INSERT INTO $table (nombre,carrera,tutor) values(:nombre,:carrera,:tutor)";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam("nombre",$data["nombre"],PDO::PARAM_STR);
		$statement->bindParam("carrera",$data["carrera"],PDO::PARAM_INT);
		$statement->bindParam("tutor",$data["tutor"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}
		$statement->close();
	}

	//**************************CRUD CARRERAS********************************
	//#######################################################################
	public static function registrarCarreraM($data,$table){
		$query = "INSERT INTO $table (nombre) VALUES (:nombre)";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		if($statement->execute()){
			return "success";
		}	
		$statement->close();
	}
//funcon para ver carreras
	public static function vistaCarreraM($table){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
//funcon para editar carreras
	public static function editarCarreraM($data,$table){
		$query ="SELECT * FROM $table WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":id", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}
//funcion para actualizar carreras
	public static function actualizarCarreraM($data, $table){

		$query ="UPDATE $table SET nombre = :nombre WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":id", $data["id"], PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	//funcion para borrar carreras
	public static function borraCarreraM($data, $table){
		$query = "DELETE FROM $table WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":id", $data, PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$statement->close();
	}


	//############################## CRUD TUTORIAS ####################################
	#**********************************************************************************

	//modelo para el registro de tutoris
	public static function registrarTutoriaM($data,$table){
		$query = "INSERT INTO $table (tutor, fecha, hora, descripcion, tipo) VALUES (:tutor,:fecha,:hora,:descripcion,:tipo)";
		$statement = Conexion::connect()->prepare($query);	
		$statement->bindParam(":tutor", $data["tutor"], PDO::PARAM_INT);
		$statement->bindParam(":fecha", $data["fecha"], PDO::PARAM_STR);
		$statement->bindParam(":hora", $data["hora"], PDO::PARAM_STR);
		$statement->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
		$statement->bindParam(":tipo", $data["tipo"], PDO::PARAM_STR);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
//modelo para ver las tutorias
	public static function vistaTutoriaM($table){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function vistaTutoriaPorTutorM($table,$tutor){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table WHERE tutor = :tutor");
		$statement->bindParam(":tutor",$tutor,PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

//modelo para editar las tutorias
	public static function editarTutoriaM($data,$table){
		$query ="SELECT * FROM $table WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":id", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}
//modeislo para actualizar las tutorias
	public static function actualizarTutoriaM($data,$table){
		$query ="UPDATE $table SET tutor = :tutor, fecha = :fecha, hora = :hora, descripcion = :descripcion, tipo = :tipo WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":tutor", $data["tutor"], PDO::PARAM_INT);
		$statement->bindParam(":fecha", $data["fecha"], PDO::PARAM_STR);
		$statement->bindParam(":hora", $data["hora"], PDO::PARAM_STR);
		$statement->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
		$statement->bindParam(":tipo",$data["tipo"], PDO::PARAM_STR);
		$statement->bindParam(":id",$data["id"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

//modelo para borra las tutorias
	public static function borraTutoriaM($data,$table){
		$query = "DELETE FROM $table WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":id", $data, PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "error";
		}
		$statement->close();
	}



}

?>

