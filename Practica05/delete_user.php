<?php
	include("db/database_utilities.php");//Se incluye el archivo "database_utilities.php"
	$id=$_GET['id'];//Se cacha la variable mandada por url 'id' y se asigna a la variable $id
	delete($id);//Se ejecuta la funcion "delete()" la cual esta dentro de el database_utilities.php, la cual ejecuta la eliminacion de un registro dependiendo de su id
	header("location: index.php");//Redirecciona a la pagina priincipal index.php
?>