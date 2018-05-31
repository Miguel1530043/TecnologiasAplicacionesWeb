<?php

class Connection{

	public static function connect(){

		$db = new PDO("mysql:host=localhost;dbname=practica12","root","");
		return $db;

	}

}
?>
