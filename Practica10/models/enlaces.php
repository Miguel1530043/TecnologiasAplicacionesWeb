<?php 

class Pages{
	
	public static function linkPagesM($link){


		if($link == "ingresar" || $link == "usuarios" || $link == "editar" || $link == "salir"){

			$module =  "views/modules/".$link.".php";
		
		}

		else if($link == "index"){

			$module =  "views/modules/registro.php";
		
		}

		else if($link == "ok"){

			$module =  "views/modules/registro.php";
		
		}

		else if($link == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($link == "cambio"){

			$module =  "views/modules/usuarios.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}
		return $module;

	}

}

?>