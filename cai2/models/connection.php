<?php
	class Connection{
		public static function connect(){
			$db = new PDO("mysql:host=localhost;dbname=cai","root","");
			return $db;
		}
	}

?>
