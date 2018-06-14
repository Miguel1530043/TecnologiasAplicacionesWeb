<?php

class Connection{

	//Metodo que conectara con la base de datos
	public static function connect(){

		//Conexion a la base datos con PDO
		$db = new PDO("mysql:host=localhost;dbname=ventas-sencillo","root","");
		return $db;

	}

}
?>
