<?php

require("database_credentials.php");//Peticion al archivo "database_credentials.php" para la conexion de base de datos

//Variables Globales
$mysql;
$query;

//Se asigna la conexion de la Base de datos a una variable
$connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

//Funcion que es llamada y utilizada en "index.php" para hacer la consulta de todos los usuarios y posteriormente imprimir toda su informacion en dicho archivo.
function run_query(){
	global $connection,$query;
	$query = mysqli_query($connection,"SELECT * FROM user");
	return $query;
}

//Funcion que es llamada y utilizada en el archivo "new_user.php" para hacer la inserción de un nuevo usuario a la base de datos 
function add($email,$password){
	global $connection;
	$insert = mysqli_query($connection,"INSERT INTO user(email,password) VALUES ('$email','$password')");
}

//Función que es llamada y utlizada en el archivo "delete_user.php" para eliminar el usuario seleccionado en la base de datos
function delete($id){
	global $connection;
	$delete = mysqli_query($connection,"DELETE FROM user WHERE id = $id");
}

//Funcion que es llamada y utilizada en el archivo "details.php" que se utiliza para imprimir los valores de un usuario dependiendo de su id
function data($id){
	global $connection,$query;
	$query = mysqli_query($connection,"SELECT * FROM user WHERE id = $id");
	return $query;
}

//Función que es llamada y utilizada en el archivo "details.php" para hacer la actualización/modificación de los datos de un usuario.
function update($id,$email,$password){
	global $connection;
	$update = mysqli_query($connection,"UPDATE user SET email = '$email', password = '$password' WHERE id = $id");
} 
?>