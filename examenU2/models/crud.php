<?php

	require_once "connection.php";
	class Data extends Connection{

		//Funcion del crud, modelo para mostrar los pagos que se hhan realizado
		public static function showPaymentsModel($table,$table2,$table3){
			$statement = Connection::connect()->prepare("SELECT * from $table as p INNER JOIN $table2 as a on p.alumna = a.id_alumna INNER JOIN $table3 as g on a.grupo = g.id_grupo ORDER BY fechaPago asc");
			$statement->execute();
			return $statement->fetchAll(); 
			$statement->close();
		}

		//Metodo para tomar los datos del arreglo posteado en el controlador y poder hacer la insercion en a base de datos, tomando dichos post como bindParam y registrarlos mediante PDO;
		public static function addPaymentModel($data,$table){


			$statement = Connection::connect()->prepare("INSERT INTO $table(grupo,alumna,nombreMama,apellidoMama,fechaPago,fechaEnvio,imagenFolio,folio) VALUES (:grupo, :alumna, :nombreMama,:apellidoMama, :fechaPago, :fechaEnvio, :imagenFolio ,:folio)");
			$statement->bindParam(":grupo",$data['grupo'],PDO::PARAM_INT);
			$statement->bindParam(":alumna",$data['alumna'],PDO::PARAM_INT);
			$statement->bindParam(":nombreMama",$data['nombreMama'],PDO::PARAM_STR);
			$statement->bindParam(":apellidoMama",$data['apellidoMama'],PDO::PARAM_STR);
			$statement->bindParam(":fechaPago",$data['fechaPago'],PDO::PARAM_STR);
			$statement->bindParam(":fechaEnvio",$data['fechaEnvio'],PDO::PARAM_STR);
			$statement->bindParam(":imagenFolio",$data["imagenFolio"],PDO::PARAM_STR);
			$statement->bindParam(":folio",$data['folio'],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
			$statement->close();
		}

		//Metodo para mostrar la informacion de todas las alumnas de la academia
		public static function showStudentsModel($table,$table2){
			$statement = Connection::connect()->prepare("SELECT * FROM $table as a INNER JOIN $table2 as g on a.grupo = g.id_grupo");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		public static function addStudentModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(nombre,apellidos,fecha_nacimiento,grupo) VALUES (:nombre,:apellidos,:fecha_nacimiento,:grupo)");
			$statement ->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$statement ->bindParam(":apellidos",$data["apellidos"],PDO::PARAM_STR);
			$statement ->bindParam(":fecha_nacimiento",$data["fecha_nacimiento"],PDO::PARAM_STR);
			$statement ->bindParam(":grupo",$data["grupo"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		public static function editStudentModel($data,$table,$table2){
			$statement = Connection::connect()->prepare("SELECT * FROM $table as a INNER JOIN $table2 as g on a.grupo = g.id_grupo WHERE id_alumna = :id_alumna");
			$statement->bindParam(":id_alumna",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
		}

		public static function updateStudentModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET nombre = :nombre, apellidos=:apellidos, fecha_nacimiento = :fecha_nacimiento,grupo = :grupo WHERE id_alumna = :id_alumna");
			$statement->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$statement->bindParam(":apellidos",$data["apellidos"],PDO::PARAM_STR);
			$statement->bindParam(":fecha_nacimiento",$data["fecha_nacimiento"],PDO::PARAM_STR);
			$statement->bindParam(":grupo",$data["grupo"],PDO::PARAM_INT);
			$statement->bindParam(":id_alumna",$data["id_alumna"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		public static function deleteStudentModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE id_alumna = :id_alumna");
			$statement->bindParam(":id_alumna",$data,PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo para mostrar la informacion de todos los grupos de la academia
		public static function showGroupsModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		public static function addGroupModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(nombre_grupo) VALUES (:nombre_grupo)");
			$statement ->bindParam(":nombre_grupo",$data["nombre_grupo"],PDO::PARAM_STR);
			
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		public static function editGroupModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_grupo = :id_grupo");
			$statement->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
		}

		public static function updateGroupModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET nombre_grupo = :nombre_grupo WHERE id_grupo = :id_grupo");
			$statement->bindParam(":nombre_grupo",$data["nombre_grupo"],PDO::PARAM_STR);
			$statement->bindParam(":id_grupo",$data["id_grupo"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		public static function deleteGroupModel($data,$table,$table2,$table3){
			
			$statement = Connection::connect()->prepare("DELETE FROM $table3 WHERE grupo = :id_grupo");
			$statement->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement->execute();

			$statement2 = Connection::connect()->prepare("DELETE FROM $table2 WHERE grupo = :id_grupo");
			$statement2->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement2->execute();
			
			$statement3 = Connection::connect()->prepare("DELETE FROM $table WHERE id_grupo = :id_grupo");
			$statement3->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement3->execute();
			return "success";
			
		}

		public static function editPaymentModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_pago = :id_pago");
			$statement->bindParam(":id_pago",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
			$statement->close();
		}

		public static function updatePaymentModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET fechaEnvio=:fechaEnvio,fechaPago=:fechaPago WHERE id_pago=:id_pago");
			$statement->bindParam(":fechaEnvio",$data["fechaEnvio"],PDO::PARAM_STR);
			$statement->bindParam(":fechaPago",$data["fechaPago"],PDO::PARAM_STR);
			$statement->bindParam(":id_pago",$data["id_pago"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		public static function loginModel($data, $table){
			$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE usuario = :usuario and password = :password");
			$statement -> bindParam(":usuario",$data['usuario'],PDO::PARAM_STR);
			$statement -> bindParam(":password",$data['password'],PDO::PARAM_STR);
			$statement -> execute();
			return $statement -> fetch();
			$statement -> close();
		}

		public static function deletePaymentModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE id_pago = :id_pago");
			$statement->bindParam(":id_pago",$data,PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

	}

?>