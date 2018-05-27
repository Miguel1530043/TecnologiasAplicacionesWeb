<?php 

class Pages{
	public static function linkPagesM($link){
		//if($link == "ingresar" || $link == "editar" || $link == "salir" || $link == "alumnos" || $link == "maestros" || $link == "tutorias" || $link == "editarAlumno" || $link == "editarMaestro" ){
		$mod =  "views/modules/".$link.".php";
		if($link == "index"){
			$mod =  "views/modules/ingresar.php";
		}
		/*	else if($link == "ok"){
			$mod =  "views/modules/registro.php";
		}else if($link == "fallo"){
			$mod =  "views/modules/ingresar.php";
		}else if($link == "cambio"){
			$mod =  "views/modules/usuarios.php";
		}else{
			$mod =  "views/modules/registro.php";
		}*/
		return $mod;
	}
}

?>