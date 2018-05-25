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

	public static function ingresoMaestroM($data, $table){
		$query = "SELECT * FROM $table WHERE nombre = :nombre";
		$statement = Conexion::connect()->prepare($query);	
		$statement->bindParam(":nombre", $data["nameMaestro"], PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}

	public static function vistaMaestroM($table){
		$query = "SELECT * FROM $table ";
		$statement = Conexion::connect()->prepare($query);	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	public static function editarMaestroM($data, $table){

		$query ="SELECT numero, nombre, email, password, carrera FROM $table WHERE numero = :numero";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":numero", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}

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
	public static function vistaAlumnosPorTutorM($table,$idTutor){
		//"SELECT a.matricula, a.nombre, a.carrera, a.tutor, c.nombre, t.nombre FROM $table3 as t INNER JOIN $table as a INNER JOIN $table2 as c WHERE a.carrera = c.id and a.tutor = t.id"
		$statement = Conexion::connect()->prepare("SELECT matricula,nombre,carrera FROM $table WHERE tutor = $idTutor");	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	public static function vistaAlumnosM($table){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table");	
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function editarAlumnoM($data, $table){

		$query ="SELECT matricula, nombre, carrera, tutor FROM $table WHERE matricula = :matriucla";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":matriucla", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}

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

	public static function vistaCarreraM($table){
		$statement = Conexion::connect()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function editarCarreraM($data,$table){
		$query ="SELECT * FROM $table WHERE id = :id";
		$statement = Conexion::connect()->prepare($query);
		$statement->bindParam(":id", $data, PDO::PARAM_INT);	
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}

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

}

?>

