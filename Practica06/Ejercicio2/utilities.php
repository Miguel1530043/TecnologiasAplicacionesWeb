<?php
	include_once('../db/connection.php');//Llamado al archivo "connection.php" el cual contiene la conexion a la base de datos
	$result;//Variable global que representara el resultado de alguan consulta sql

	//Funcion para agregar algun registro a la tabla sport, mediante el uso de PDO, recibiendo todos los datos como parametros

	function add($id,$name,$position,$carrier,$email,$sport){
		global $pdo;
		$query = "INSERT INTO sport(id,name,position,carrier,email,sport) VALUES ($id,'$name','$position','$carrier','$email','$sport')";
		$statement = $pdo->prepare($query);
		$statement -> execute(); 

	}

	//Funcion para eliminar algun resgistro de la tabla sport, mediante pdo, recibiendo el id y el deporte como parametros
	function delete($id,$sport){
		global $pdo;
		$query = "DELETE FROM sport WHERE id = $id and sport ='$sport'";
		$statement = $pdo->prepare($query);
		$statement -> execute();

	}
	//Funcion para mostrar la informacion de algun registro de la tabla sport, medianto pdo, recibiendo el id y el deporte como parametros
	function data($id,$sport){
		global $pdo,$result;
		$query = "SELECT * FROM sport WHERE id = $id and sport ='$sport'";
		$statement = $pdo->prepare($query);
		$statement -> execute();
		$result = $statement->fetchAll();
		return $result;

	}

	//Funcion pra actualizar algun registro de la tabla sport, mediante pdo, recibiendo como parametros todos los datos

	function update($id,$name,$position,$carrier,$email,$sport){
		global $pdo;
		$query = "UPDATE sport SET name = '$name', position = '$position', carrier ='$carrier', email = '$email' WHERE id =$id and sport ='$sport'";
		$statement = $pdo->prepare($query);
		$statement -> execute();
	}
?>

