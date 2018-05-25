
<?php

class Conexion{

	public static function connect(){

		$db = new PDO("mysql:host=localhost;dbname=practica08","root","");
		return $db;

	}

}
?>
