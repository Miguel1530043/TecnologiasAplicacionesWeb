<?php

	include_once('db/connection.php');//Llamado al archivo "connection.php" el cual contiene la conexion a la base de datos
	$result;//Variable global que representara el resultado de alguan consulta sql
	$result2;
	//Funcion para agregar algun registro a la tabla sport, mediante el uso de PDO, recibiendo todos los datos como parametros

	function add_user($username,$password){
		global $pdo;
		$query = "INSERT INTO usuario(user_name,password) VALUES ('$username','$password')";
		$statement = $pdo->prepare($query);
		$statement -> execute(); 

	}
	
	function info($user,$pass){
	    global $pdo,$result;
	    $query = "SELECT * FROM usuario WHERE user_name = '$user' and password = '$pass'";
	    $statement = $pdo->prepare($query);
	    $statement->execute();
	    $result=$statement->fetchAll();
	    return $result;
	}

	//Funcion para eliminar algun resgistro de la tabla sport, mediante pdo, recibiendo el id y el deporte como parametros
	function delete_user($id){
		global $pdo;
		$query = "DELETE FROM usuario WHERE id = $id ";
		$statement = $pdo->prepare($query);
		$statement -> execute();

	}
	//Funcion para mostrar la informacion de algun registro de la tabla sport, medianto pdo, recibiendo el id y el deporte como parametros
	function data_user($id){
		global $pdo,$result;
		$query = "SELECT * FROM usuario WHERE id = $id";
		$statement = $pdo->prepare($query);
		$statement -> execute();
		$result = $statement->fetchAll();
		return $result;

    }
    
	//Funcion pra actualizar algun registro de la tabla sport, mediante pdo, recibiendo como parametros todos los datos

	function update_user($id,$name){
		global $pdo;
		$query = "UPDATE usuario SET user_name = '$name' WHERE id =$id";
		$statement = $pdo->prepare($query);
		$statement -> execute();
	}
	
	
	function add_product($id,$name,$price){
		global $pdo;
		$query = "INSERT INTO producto(id,nombre,precio) VALUES ($id,'$name',$price)";
		$statement = $pdo->prepare($query);
		$statement -> execute(); 

	}
	function product_data($id){
		global $pdo,$result;
		$query = "SELECT * FROM producto WHERE id = $id";
		$statement = $pdo->prepare($query);
		$statement -> execute();
		$result = $statement->fetchAll();
		return $result;

	}
	function update_product($id,$name,$price){
		global $pdo;
		$query = "UPDATE producto SET nombre = '$name', precio = $price WHERE id = $id";
		$statement = $pdo->prepare($query);
		$statement -> execute();
	}
	function delete_product($id){
		global $pdo;
		$query = "DELETE FROM producto WHERE id = $id";
		$statement = $pdo->prepare($query);
		$statement -> execute();

	}
	
	function sold_data($id){
		global $pdo,$result;
		$query = "SELECT * FROM venta WHERE id = $id";
		$statement = $pdo->prepare($query);
		$statement -> execute();
		$result = $statement->fetchAll();
		return $result;


	}

	function product_sold_data($id_venta){
		global $pdo,$result2;
		$query = "SELECT * FROM venta_producto WHERE id_venta = $id_venta";
		$statement = $pdo->prepare($query);
		$statement -> execute();
		$result2 = $statement->fetchAll();
		return $result2;
	}
?>

