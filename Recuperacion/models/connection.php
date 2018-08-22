<?php
	//Clase que es llamada en los modelos para poder realizar las conusltas con la base de datos
	class Connection{
		public static function connect(){
			$db = new PDO("mysql:host=localhost;dbname=recuperacion_taw","root","");//Variable $db contendra el valor de la conexion a la base de datos medainte pdo
			return $db;//Se devolvera dicho dicho valor
		}
	}

?>
