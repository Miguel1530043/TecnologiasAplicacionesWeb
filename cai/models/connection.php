<?php
	class Connection{
		public static function connect(){
			$db = new PDO("mysql:host=localhost;dbname=id5890938_practica12","id5890938_miguel1106","miguel");
			return $db;
		}
	}

?>
