<?php 
class Pages{
	//Metodo que direccionara las acciones del index
	public static function linkPageModel($link){
		$module =  "views/modules/".$link.".php";
		if($link == "index"){
			$module =  "views/modules/home.php";
		}
		return $module;
	}
}

?>