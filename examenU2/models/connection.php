<?php
	class Connection{
		public static function connect(){
			$db = new PDO("mysql:host=localhost;dbname=examenu2","root","");
			return $db;
		}
	}

?>
