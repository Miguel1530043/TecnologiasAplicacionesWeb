<?php

require_once "connection.php";

class Data extends Connection{
	//Funcion utilizada para verificar los datos del usuario y permiitir el login.
	public static function loginModel($data, $table){

		$statement = Connection::connect() -> prepare("SELECT id,email,password FROM $table WHERE email = :email and password = :password");
		$statement -> bindParam(":email",$data['email'],PDO::PARAM_STR);
		$statement -> bindParam(":password",$data['password'],PDO::PARAM_STR);
		$statement -> execute();
		return $statement -> fetch();
		$statement -> close();
	}

	public static function productViewsModel($table){
		$statement = Connection::connect() -> prepare("SELECT * FROM $table");
		$statement -> execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function addProductModel($data, $table){
		$statement = Connection::connect() -> prepare("INSERT INTO products (id,name,description,price,stock) VALUES (:id,:name,:description,:price,:stock)");
		$statement->bindParam(":id",$data['id'],PDO::PARAM_INT);
		$statement->bindParam(":name",$data['name'],PDO::PA
			RAM_STR);
		$statement->bindParam(":description",$data['description'],PDO::PARAM_STR);
		$statement->bindParam(":price",$data['price'],PDO::PARAM_INT);
		$statement->bindParam(":stock",$data['stock'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	}

	public static function editProductModel($data, $table){
		$statement = Connection::connect()->prepare("SELECT *  FROM products WHERE id = :id");
		$statement -> bindParam(":id",$data,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		$statement->close();
	}

	public static function updateProductModel($data, $table){
		$statement = Connection::connect() -> prepare("UPDATE products SET name=:name,description=:description,price=:price,stock=:stock WHERE id = :id");
		$statement->bindParam(":id",$data['id'],PDO::PARAM_INT);
		$statement->bindParam(":name",$data['name'],PDO::PARAM_STR);
		$statement->bindParam(":description",$data['description'],PDO::PARAM_STR);
		$statement->bindParam(":price",$data['price'],PDO::PARAM_INT);
		$statement->bindParam(":stock",$data['stock'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	} 
}

?>

