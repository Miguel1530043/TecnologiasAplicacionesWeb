<?php

class Conexion{
	public static function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=productos","root","");
		return $link;
	}
}
?>
