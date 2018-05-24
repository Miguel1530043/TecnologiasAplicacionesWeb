<?php
	require_once("conexion.php");

	class DatosProd extends Conexion{
		public static function registroProductoM($table,$datos){
			$statement = Conexion::conectar()->prepare("INSERT INTO $table(nombreProd,descProd,BuyPrice,SalePrice,Price) VALUES (:nombre,:descripcion,:bPrice,:sPrice,:price)");
			$statement->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$statement->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
			$statement->bindParam(":bPrice",$datos["bPrice"],PDO::PARAM_INT);
			$statement->bindParam(":sPrice",$datos["sPrice"],PDO::PARAM_INT);
			$statement->bindParam(":price",$datos["price"],PDO::PARAM_INT);
			if($statement->execute()){
				return "1";
			}else{
				return "0";
			}
			$statement->close();
		}

		public static function ingresoUsuarioM($table, $datos){
			$statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :user");
			$statement->bindParam(":user", $datos["user"],PDO::PARAM_STR);
			$statement->execute();
			#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $statement->fetch();
			$statement->close();
		}
	}
?>